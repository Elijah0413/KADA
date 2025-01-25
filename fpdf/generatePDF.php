<?php
// Prevent any output before PDF generation
ob_start();

require('fpdf.php');
require_once('../app/core/Database.php');
use App\Core\Database;

class FinancialReport extends FPDF {
    private $db;
    private $selectedMonth;
    private $selectedYear;
    private $reportType;

    public function __construct($selectedMonth, $selectedYear, $reportType) {
        parent::__construct();
        $this->selectedMonth = $selectedMonth;
        $this->selectedYear = $selectedYear;
        $this->reportType = $reportType;
        
        // Initialize database connection
        $database = new Database();
        $this->db = $database->connect();
    }

    function Header() {
        // Add logo (adjusted size and position to match design)
        $this->Image('../public/images/logo.jpg', 10, 6, 40);
        
        // Create main box for all member details
        
        $this->Rect(60, 10, 135, 32); // Main outer box
        
        try {
            // Get member details from pendingregistermember table
            $stmt = $this->db->prepare("
                SELECT prm.name, prm.ic_no, prm.user_id, prm.pf_number 
                FROM pendingregistermember prm 
                WHERE prm.user_id = ?
            ");
            $stmt->execute([$_SESSION['user_id']]);
            $member = $stmt->fetch();

            if ($member) {
                // Member name
                $this->SetXY(62, 18);
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(30, 5, 'NAMA:', 0);
                $this->SetFont('Arial', '', 12);
                $this->Cell(65, 5, strtoupper($member['name']), 0);
                
                // IC number and PF number on same line
                $this->SetXY(62, 25);
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(30, 5, 'NO. K/P:', 0);
                $this->SetFont('Arial', '', 12);
                $this->Cell(40, 5, $member['ic_no'], 0);
                
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(20, 5, 'NO. PF:', 0);
                $this->SetFont('Arial', '', 12);
                $this->Cell(15, 5, $member['pf_number'], 0);
                
                $this->Rect(169, 15, 24, 19); //  inner box for NO. AHLI
                
                // NO. AHLI label and value in the smaller inner box
                $this->SetXY(171, 19);
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(25, 4, 'NO. AHLI:', 0);
                $this->SetXY(168, 26);
                $this->SetFont('Arial', '', 12);
                $this->Cell(25, 4, $member['user_id'], 0, 0, 'C');
            }
        } catch (Exception $e) {
            error_log("Error in PDF generation: " . $e->getMessage());
        }
        
        // Add space before content
        $this->Ln(25);
        
        // Title (Penyata Kewangan)
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Penyata Kewangan', 0, 1, 'C');
        
        $this->Ln(10);
    }

    function generateReport($userData) {
        // Add the PDF content
        $this->AddPage();
        
        // Title for statement
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 8, 'Tuan/Puan,', 0, 1);
        $this->Ln(5);
        
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, 'PENGESAHAN PENYATA KEWANGAN AHLI KOPERASI KAKITANGAN KADA KELANTAN BERHAD', 0, 1);
        if ($this->reportType === 'yearly') {
            $this->Cell(0, 8, 'BAGI TAHUN BERAKHIR ' . $this->selectedYear, 0, 1);
        } else {
            $this->Cell(0, 8, 'BAGI BULAN ' . date('F Y', strtotime($this->selectedMonth)), 0, 1);
        }
        $this->Ln(5);
        
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 8, 'Untuk penentuan Juruaudit, kami dengan ini menyatakan bagi akaun tuan/puan adalah sebagaimana berikut:', 0, 1);
        $this->Ln(5);
        
        // Share Information
        $this->addShareInformation($_SESSION['user_id']);
        
        $this->Ln(10);
        
        // Loan Information
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, 'MAKLUMAT PINJAMAN AHLI:', 0, 1);
        $this->Ln(2);

        // Create a table for loan information
        $this->SetFont('Arial', '', 11);
        $loanColWidth = 45;

        try {
            // Query to get loan information based on date
            $loanQuery = "
                SELECT 
                    loan_type,
                    SUM(t_amount) as total_amount
                FROM loan_applications 
                WHERE user_id = :userId 
                AND status = 'approved'
            ";

            if ($this->reportType === 'monthly') {
                $loanQuery .= " AND DATE_FORMAT(created_at, '%Y-%m') = :date_param";
                $dateParam = $this->selectedMonth;
            } elseif ($this->reportType === 'yearly') {
                $loanQuery .= " AND YEAR(created_at) = :date_param";
                $dateParam = $this->selectedYear;
            }

            $loanQuery .= " GROUP BY loan_type";

            $stmt = $this->db->prepare($loanQuery);
            $stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            
            if ($this->reportType === 'monthly' || $this->reportType === 'yearly') {
                $stmt->bindParam(':date_param', $dateParam);
            }
            
            $stmt->execute();
            $loanResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Initialize loan amounts
            $loans = [
                'Pembiayaan_Al_Bai' => 0,
                'Pembiayaan_Al_Innah' => 0,
                'Pembiayaan_Skim_Khas' => 0,
                'Pembiayaan_RoadTaxInsuran' => 0,
                'Pembiayaan_Al_Qardhul_Hasan' => 0
            ];

            // Fill in the actual loan amounts
            foreach ($loanResults as $loan) {
                $loans[$loan['loan_type']] = $loan['total_amount'];
            }

            // First row of loans
            $this->Cell($loanColWidth, 8, 'Al-Bai:', 0);
            $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_Al_Bai'], 2), 0);
            $this->Cell($loanColWidth, 8, 'B/Pulih Kenderaan:', 0);
            $this->Cell($loanColWidth, 8, 'RM 0.00', 0, 1); // Removed BALIK as it's not in the loan types

            // Second row of loans
            $this->Cell($loanColWidth, 8, 'Al-Innah:', 0);
            $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_Al_Innah'], 2), 0);
            $this->Cell($loanColWidth, 8, 'Khas:', 0);
            $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_Skim_Khas'], 2), 0, 1);

            // Third row of loans
            $this->Cell($loanColWidth, 8, 'Road Tax & Insuran:', 0);
            $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_RoadTaxInsuran'], 2), 0);
            $this->Cell($loanColWidth, 8, 'Al-Qardhul Hassan:', 0);
            $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_Al_Qardhul_Hasan'], 2), 0, 1);

        } catch (Exception $e) {
            error_log("Error in loan information query: " . $e->getMessage());
            // Handle the error gracefully in the PDF
            $this->Cell(0, 8, 'Error retrieving loan information', 0, 1);
        }

        $this->Ln(10);

        $this->Ln(10); // Optional: Add some space before the new page
        $this->AddPage(); // Start a new page for the transaction history

        // Transaction History
        if ($this->reportType === 'yearly') {
            $formattedPeriod = $this->selectedYear;
            $startDate = $this->selectedYear . '-01-01';
            $endDate = $this->selectedYear . '-12-31';
        } else {
            $formattedPeriod = date('F Y', strtotime($this->selectedMonth));
            $startDate = date('Y-m-01', strtotime($this->selectedMonth));
            $endDate = date('Y-m-t', strtotime($this->selectedMonth));
        }

        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, 'SEJARAH TRANSAKSI - ' . $formattedPeriod, 0, 1);

        $this->Ln(5);
        $this->Ln(2);

        // Table headers for transactions
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(245, 245, 245);
        
        // Column widths
        $dateWidth = 35;
        $typeWidth = 30;
        $statusWidth = 25;
        $amountWidth = 30;
        $descWidth = 73;

        // Headers with all columns center-aligned
        $this->Cell($dateWidth, 8, 'Tarikh', 1, 0, 'C', true);
        $this->Cell($typeWidth, 8, 'Jenis', 1, 0, 'C', true);
        $this->Cell($amountWidth, 8, 'Jumlah (RM)', 1, 0, 'C', true);
        $this->Cell($statusWidth, 8, 'Status', 1, 0, 'C', true);
        $this->Cell($descWidth, 8, 'Catatan', 1, 1, 'C', true);

        try {
            // Get transactions for the selected period
            $stmt = $this->db->prepare("
                SELECT 
                    st.*,
                    DATE_FORMAT(st.transaction_date, '%d/%m/%Y') as request_date
                FROM saving_transactions st
                JOIN saving_accounts sa ON st.account_id = sa.id
                JOIN pendingregistermember prm ON sa.user_ic = prm.ic_no
                WHERE prm.user_id = ?
                AND st.transaction_date BETWEEN ? AND ?
                ORDER BY st.transaction_date DESC
            ");
            
            $stmt->execute([$_SESSION['user_id'], $startDate, $endDate]);
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Table content
            $this->SetFont('Arial', '', 10);
            if (!empty($transactions)) {
                foreach ($transactions as $transaction) {
                    // Combine date and time
                    $dateTime = $transaction['transaction_date'];

                    // Date and time in one cell
                    $this->Cell($dateWidth, 8, $dateTime, 1, 0, 'C');

                    // Other cells
                    $this->Cell($typeWidth, 8, $transaction['transaction_type'] === 'deposit' ? 'Deposit' : 'Pengeluaran', 1, 0, 'C');
                    $this->Cell($amountWidth, 8, number_format($transaction['amount'], 2), 1, 0, 'R');
                    $this->Cell($statusWidth, 8, ucfirst($transaction['status']), 1, 0, 'C');
                    $this->Cell($descWidth, 8, $transaction['description'], 1, 1, 'C');
                }
            } else {
                $this->SetFont('Arial', '', 10);
                $totalWidth = $dateWidth + $typeWidth + $amountWidth + $statusWidth + $descWidth;
                if ($this->reportType === 'yearly') {
                    
                    $this->Cell($totalWidth, 8, 'Tiada rekod transaksi untuk tahun ' . $formattedPeriod, 1, 1, 'C');
                } else {
                    $this->Cell($totalWidth, 8, 'Tiada rekod transaksi untuk ' . $formattedPeriod, 1, 1, 'C');
                }
            }
        } catch (Exception $e) {
            error_log("Error in transaction query: " . $e->getMessage());
            $this->Cell(0, 8, 'Error retrieving transaction data', 1, 1, 'C');
        }

        // Add a new page for Loan Report
        $this->AddPage();

        // Format the month/year display based on report type
        if ($this->reportType === 'yearly') {
            $formattedMonth = $this->selectedYear; // This will be the year for yearly reports
            $startDate = $this->selectedYear . '-01-01';
            $endDate = $this->selectedYear . '-12-31';
        } else {
            $formattedMonth = date('F Y', strtotime($this->selectedMonth));
            $startDate = date('Y-m-01', strtotime($this->selectedMonth));
            $endDate = date('Y-m-t', strtotime($this->selectedMonth));
        }

        // Get loan applications for the selected period
        if ($this->reportType === 'monthly') {
            $startDate = date('Y-m-01', strtotime($this->selectedMonth));
            $endDate = date('Y-m-t', strtotime($this->selectedMonth));
        } else {
            $startDate = $this->selectedYear . '-01-01';
            $endDate = $this->selectedYear . '-12-31';
        }

        // Update the loan applications query with date filtering
        $stmt = $this->db->prepare("
            SELECT 
                loan_type,
                t_amount,
                period,
                mon_installment,
                status,
                created_at,
                admin_remark
            FROM loan_applications 
            WHERE user_id = ? 
            AND DATE(created_at) BETWEEN ? AND ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$_SESSION['user_id'], $startDate, $endDate]);
        $loanApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loan Report Header
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, 'LAPORAN PINJAMAN - ' . $formattedMonth, 0, 1);
        $this->Ln(5);

        // Loan Summary Table
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 8, 'Ringkasan Pinjaman', 0, 1);
        $this->Ln(2);

        // Table headers
        $this->SetFillColor(245, 245, 245);
        $this->SetFont('Arial', 'B', 9);

        // Define column widths
        $typeWidth = 50;
        $amountWidth = 35;
        $periodWidth = 25;
        $installmentWidth = 35;
        $statusWidth = 35;

        // Headers
        $this->Cell($typeWidth, 8, 'Jenis Pinjaman', 1, 0, 'C', true);
        $this->Cell($amountWidth, 8, 'Jumlah (RM)', 1, 0, 'C', true);
        $this->Cell($periodWidth, 8, 'Tempoh', 1, 0, 'C', true);
        $this->Cell($installmentWidth, 8, 'Ansuran (RM)', 1, 0, 'C', true);
        $this->Cell($statusWidth, 8, 'Status', 1, 1, 'C', true);

        // Define total width of all columns
        $totalWidth = $typeWidth + $amountWidth + $periodWidth + $installmentWidth + $statusWidth;

        // Table content
        $this->SetFont('Arial', '', 9);
        if (!empty($loanApplications)) {
            foreach ($loanApplications as $loan) {
                $this->Cell($typeWidth, 8, $loan['loan_type'], 1, 0, 'L');
                $this->Cell($amountWidth, 8, number_format($loan['t_amount'], 2), 1, 0, 'R');
                $this->Cell($periodWidth, 8, $loan['period'] . ' bulan', 1, 0, 'C');
                $this->Cell($installmentWidth, 8, number_format($loan['mon_installment'], 2), 1, 0, 'R');
                
                // Set color for status
                if ($loan['status'] === 'APPROVED') {
                    $this->SetTextColor(0, 128, 0); // Green
                } elseif ($loan['status'] === 'REJECTED') {
                    $this->SetTextColor(255, 0, 0); // Red
                } else {
                    $this->SetTextColor(255, 128, 0); // Orange
                }
                
                $this->Cell($statusWidth, 8, ucfirst(strtolower($loan['status'])), 1, 1, 'C');
                $this->SetTextColor(0, 0, 0); // Reset to black
            }
        } else {
            if ($this->reportType === 'yearly') {
                $this->Cell($totalWidth, 8, 'Tiada rekod pinjaman untuk tahun ' . $formattedMonth, 1, 1, 'C');
            } else {
                $this->Cell($totalWidth, 8, 'Tiada rekod pinjaman untuk ' . $formattedMonth, 1, 1, 'C');
            }
        }

        // Debug information
        error_log("Report Type: " . $this->reportType);
        error_log("Selected Month: " . $this->selectedMonth);
        error_log("Selected Year: " . $this->selectedYear);
        error_log("Start Date: " . $startDate);
        error_log("End Date: " . $endDate);
        error_log("User ID: " . $_SESSION['user_id']);
        error_log("Number of loans found: " . count($loanApplications));

        // Detailed Loan Information for Approved Loans
        if (!empty($loanApplications)) {
            $this->Ln(10);
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(0, 8, 'MAKLUMAT TERPERINCI PINJAMAN', 0, 1);
            $this->Ln(5);

            foreach ($loanApplications as $loan) {
                // Check for both uppercase and lowercase 'approved'
                if (strtoupper($loan['status']) === 'APPROVED' || strtolower($loan['status']) === 'approved') {
                    // Card-like container
                    $this->SetFillColor(255, 255, 255);
                    $this->Rect($this->GetX(), $this->GetY(), 180, 40, 'F');
                    
                    // Loan Type Header
                    $this->SetFont('Arial', 'B', 10);
                    $this->Cell(0, 8, htmlspecialchars($loan['loan_type']), 0, 1);
                    
                    // Left Column
                    $this->SetFont('Arial', '', 9);
                    $leftX = $this->GetX();
                    $leftY = $this->GetY();
                    
                    $this->Cell(90, 6, 'Jumlah Pinjaman: RM ' . number_format($loan['t_amount'], 2), 0, 1);
                    $this->Cell(90, 6, 'Tempoh: ' . htmlspecialchars($loan['period']) . ' bulan', 0, 1);
                    $this->Cell(90, 6, 'Ansuran Bulanan: RM ' . number_format($loan['mon_installment'], 2), 0, 1);
                    
                    // Right Column
                    $this->SetXY($leftX + 90, $leftY);
                    $this->Cell(90, 6, 'Tarikh Kelulusan: ' . date('d/m/Y', strtotime($loan['created_at'])), 0, 1);
                    $this->SetX($leftX + 90);
                    $this->Cell(90, 6, 'Status: Diluluskan', 0, 1);
                    
                    // Admin Remark (if exists)
                    if (!empty($loan['admin_remark'])) {
                        $this->SetX($leftX + 90);
                        $this->SetFont('Arial', 'B', 9);
                        $this->Write(6, 'Catatan: ');
                        $this->SetFont('Arial', '', 9);
                        $this->MultiCell(90, 6, htmlspecialchars($loan['admin_remark']), 0, 'L');
                    }
                    
                    // Add spacing between loans
                    $this->Ln(8);
                    $this->Cell(180, 0, '', 'B', 1); 
                    $this->Ln(8);
                }
            }
        }
    }

    private function addShareInformation($userId) {
        // Get member and account information based on date
        $accountQuery = "
            SELECT 
                p.*,
                sa.balance,
                p.created_at as member_created_at
            FROM pendingregistermember p
            LEFT JOIN saving_accounts sa ON sa.user_ic = p.ic_no
            WHERE p.user_id = :userId 
            AND p.status = 'approved'
            AND DATE_FORMAT(p.created_at, '%Y-%m') <= :report_date
            ORDER BY p.created_at DESC LIMIT 1";

        $stmt = $this->db->prepare($accountQuery);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($this->reportType === 'monthly') {
            // For monthly reports, compare year-month only
            $reportDate = date('Y-m', strtotime($this->selectedMonth . '-01'));
        } else {
            // For yearly reports
            $reportDate = $this->selectedYear . '-12-31';
        }

        $stmt->bindParam(':report_date', $reportDate);
        $stmt->execute();
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Share Information Header
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, 'MAKLUMAT SAHAM AHLI:', 0, 1);
        $this->Ln(2);
        
        // Create a table for share information
        $this->SetFont('Arial', '', 11);
        $col1Width = 45;
        $col2Width = 45;

        // Determine values based on date comparison
        if (!$accountData) {
            $shareValues = [
                'share_capital' => 0,
                'fee_capital' => 0,
                'fixed_deposit' => 0,
                'balance' => 0
            ];
        } else {
            $memberCreatedMonth = date('Y-m', strtotime($accountData['member_created_at']));
            
            if ($this->reportType === 'monthly') {
                $reportMonth = date('Y-m', strtotime($this->selectedMonth . '-01'));
                // Show values if report month is same as or after registration month
                if ($reportMonth >= $memberCreatedMonth) {
                    $shareValues = [
                        'share_capital' => $accountData['share_capital'] ?? 0,
                        'fee_capital' => $accountData['fee_capital'] ?? 0,
                        'fixed_deposit' => $accountData['fixed_deposit'] ?? 0,
                        'balance' => $accountData['balance'] ?? 0
                    ];
                } else {
                    $shareValues = [
                        'share_capital' => 0,
                        'fee_capital' => 0,
                        'fixed_deposit' => 0,
                        'balance' => 0
                    ];
                }
            } else {
                // Yearly report logic
                $memberCreatedYear = date('Y', strtotime($accountData['member_created_at']));
                if ($this->selectedYear >= $memberCreatedYear) {
                    $shareValues = [
                        'share_capital' => $accountData['share_capital'] ?? 0,
                        'fee_capital' => $accountData['fee_capital'] ?? 0,
                        'fixed_deposit' => $accountData['fixed_deposit'] ?? 0,
                        'balance' => $accountData['balance'] ?? 0
                    ];
                } else {
                    $shareValues = [
                        'share_capital' => 0,
                        'fee_capital' => 0,
                        'fixed_deposit' => 0,
                        'balance' => 0
                    ];
                }
            }
        }
        
        // Display the values
        $this->Cell($col1Width, 8, 'Modal Syer:', 0);
        $this->Cell($col2Width, 8, 'RM ' . number_format($shareValues['share_capital'], 2), 0);
        $this->Cell($col1Width, 8, 'Simpanan Tetap:', 0);
        $this->Cell($col2Width, 8, 'RM ' . number_format($shareValues['fixed_deposit'], 2), 0, 1);
        
        $this->Cell($col1Width, 8, 'Modal Yuran:', 0);
        $this->Cell($col2Width, 8, 'RM ' . number_format($shareValues['fee_capital'], 2), 0);
        $this->Cell($col1Width, 8, 'Tabung Anggota:', 0);
        $this->Cell($col2Width, 8, 'RM ' . number_format($shareValues['balance'], 2), 0, 1);

        $this->Cell($col1Width, 8, 'Simpanan Anggota:', 0);
        $this->Cell($col2Width, 8, 'RM ' . number_format($shareValues['balance'], 2), 0, 1);
    }
}

// Generate the report
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start();
    
    try {
        $userId = $_SESSION['user_id'] ?? null;
        $reportType = $_POST['report_type'] ?? '';
        $selectedMonth = $_POST['selected_month'] ?? '';
        $selectedYear = $_POST['selected_year'] ?? '';

        if (!$userId) {
            throw new Exception("User ID not found");
        }

        // Initialize PDF with correct parameters
        $pdf = new FinancialReport($selectedMonth, $selectedYear, $reportType);
        
        // Initialize database connection for the main script
        $database = new Database();
        $db = $database->connect();

        // Get member details with savings balance
        $stmt = $db->prepare("
            SELECT 
                prm.name,
                prm.user_id,
                prm.ic_no,
                prm.pf_number,
                prm.share_capital,
                prm.fee_capital,
                prm.fixed_deposit,
                prm.deposit_funds,
                sa.balance as member_savings
            FROM pendingregistermember prm
            LEFT JOIN saving_accounts sa ON sa.user_ic = prm.ic_no
            WHERE prm.user_id = ? 
            AND prm.status = 'approved'
        ");
        $stmt->execute([$userId]);
        $memberData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get loan information
        $stmt = $db->prepare("
            SELECT 
                SUM(CASE WHEN loan_type = 'Pembiayaan_Al_Bai' THEN t_amount ELSE 0 END) as Pembiayaan_Al_Bai,
                SUM(CASE WHEN loan_type = 'Pembiayaan_Al_Innah' THEN t_amount ELSE 0 END) as Pembiayaan_Al_Innah,
                SUM(CASE WHEN loan_type = 'BALIK' THEN t_amount ELSE 0 END) as BALIK,
                SUM(CASE WHEN loan_type = 'Pembiayaan_Skim_Khas' THEN t_amount ELSE 0 END) as Pembiayaan_Skim_Khas,
                SUM(CASE WHEN loan_type = 'Pembiayaan_RoadTaxInsuran' THEN t_amount ELSE 0 END) as Pembiayaan_RoadTaxInsuran,
                SUM(CASE WHEN loan_type = 'Pembiayaan_Al_Qardhul_Hasan' THEN t_amount ELSE 0 END) as Pembiayaan_Al_Qardhul_Hasan
            FROM loan_applications
            WHERE user_id = ? 
            AND status = 'APPROVED'
        ");
        $stmt->execute([$userId]);
        $loanData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Prepare user data for PDF
        $userData = [
            'name' => $memberData['name'] ?? '',
            'member_id' => $memberData['user_id'] ?? '',
            'ic_no' => $memberData['ic_no'] ?? '',
            'pf_no' => $memberData['pf_number'] ?? '',
            'modal_syer' => $memberData['share_capital'] ?? 0,
            'modal_yuran' => $memberData['fee_capital'] ?? 0,
            'fixed_deposit' => $memberData['fixed_deposit'] ?? 0,
            'member_savings' => $memberData['member_savings'] ?? 0,
            'loans' => [
                'Pembiayaan_Al_Bai' => $loanData['Pembiayaan_Al_Bai'] ?? 0,
                'Pembiayaan_Al_Innah' => $loanData['Pembiayaan_Al_Innah'] ?? 0,
                'BALIK' => $loanData['BALIK'] ?? 0,
                'Pembiayaan_Skim_Khas' => $loanData['Pembiayaan_Skim_Khas'] ?? 0,
                'Pembiayaan_RoadTaxInsuran' => $loanData['Pembiayaan_RoadTaxInsuran'] ?? 0,
                'Pembiayaan_Al_Qardhul_Hasan' => $loanData['Pembiayaan_Al_Qardhul_Hasan'] ?? 0
            ]
        ];

        // Generate PDF filename based on report type
        if ($reportType === 'yearly') {
            $filename = "Penyata_Kewangan_" . $selectedYear . ".pdf";
        } else {
            $filename = "Penyata_Kewangan_" . date('Y_m', strtotime($selectedMonth)) . ".pdf";
        }

        $pdf->generateReport($userData);
        
        // Clean any output buffers
        ob_end_clean();

        // Output the PDF for download
        $pdf->Output('D', $filename);
        
    } catch (Exception $e) {
        ob_end_clean();
        error_log("Error generating PDF: " . $e->getMessage());
        die("Error generating PDF: " . $e->getMessage());
    }
}