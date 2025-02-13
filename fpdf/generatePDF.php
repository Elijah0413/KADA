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
    private $startDate;
    private $endDate;
    private $transactionType;

    public function __construct($selectedMonth, $selectedYear, $reportType, $startDate = null, $endDate = null) {
        parent::__construct();
        $this->selectedMonth = $selectedMonth;
        $this->selectedYear = $selectedYear;
        $this->reportType = $reportType;
        
        // Validate and format dates for custom date range
        if ($reportType === 'custom' && $startDate && $endDate) {
            // Ensure dates are in correct format (YYYY-MM-DD)
            $this->startDate = date('Y-m-d', strtotime($startDate));
            $this->endDate = date('Y-m-d', strtotime($endDate));
            
            // Validate dates
            if (!$this->startDate || !$this->endDate || $this->startDate > $this->endDate) {
                throw new Exception("Invalid date range provided");
            }
        }
        
        // Initialize database connection
        $database = new Database();
        $this->db = $database->connect();
    }

    function Header() {
        // Update the image path to use absolute path
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $this->Image($rootPath . '/images/logo.jpg', 10, 6, 40);
        
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

    public function generateReport($userData) {
        try {
            // Set date range based on report type
            $dateCondition = '';
            $params = [];
            
            switch ($this->reportType) {
                case 'monthly':
                    if (!empty($this->selectedMonth)) {
                        $dateCondition = "DATE_FORMAT(created_at, '%Y-%m') = ?";
                        $params[] = $this->selectedMonth;
                    }
                    break;
                    
                case 'yearly':
                    if (!empty($this->selectedYear)) {
                        $dateCondition = "YEAR(created_at) = ?";
                        $params[] = $this->selectedYear;
                    }
                    break;
                    
                case 'custom':
                    if ($this->startDate && $this->endDate) {
                        $dateCondition = "DATE(created_at) BETWEEN ? AND ?";
                        $params[] = $this->startDate;
                        $params[] = $this->endDate;
                    }
                    break;
            }

            if (empty($dateCondition)) {
                throw new Exception("Invalid report parameters");
            }

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
            } elseif ($this->reportType === 'custom') {
                $this->Cell(0, 8, 'BAGI TEMPOH ' . date('d/m/Y', strtotime($this->startDate)) . ' HINGGA ' . date('d/m/Y', strtotime($this->endDate)), 0, 1);
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
                    AND status = 'APPROVED'
                ";

                if ($this->reportType === 'monthly') {
                    $loanQuery .= " AND DATE_FORMAT(created_at, '%Y-%m') = :date_param";
                } elseif ($this->reportType === 'yearly') {
                    $loanQuery .= " AND YEAR(created_at) = :date_param";
                } elseif ($this->reportType === 'custom') {
                    $loanQuery .= " AND DATE(created_at) BETWEEN :start_date AND :end_date";
                }

                // Add loan type filter if specific type is selected
                if (isset($_POST['loan_type']) && $_POST['loan_type'] !== 'all') {
                    $loanQuery .= " AND loan_type = :loan_type";
                }

                $loanQuery .= " GROUP BY loan_type";

                $stmt = $this->db->prepare($loanQuery);
                $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
                
                if ($this->reportType === 'monthly') {
                    $stmt->bindValue(':date_param', $this->selectedMonth);
                } elseif ($this->reportType === 'yearly') {
                    $stmt->bindValue(':date_param', $this->selectedYear);
                } elseif ($this->reportType === 'custom') {
                    $stmt->bindValue(':start_date', $this->startDate);
                    $stmt->bindValue(':end_date', $this->endDate);
                }

                // Bind loan type if specific type is selected
                if (isset($_POST['loan_type']) && $_POST['loan_type'] !== 'all') {
                    $stmt->bindValue(':loan_type', $_POST['loan_type']);
                }
                
                $stmt->execute();
                $loanResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Initialize loan amounts
                $loans = [
                    'Pembiayaan_Al_Bai' => 0,
                    'Pembiayaan_Al_Innah' => 0,
                    'Pembiayaan_Skim_Khas' => 0,
                    'Pembiayaan_RoadTaxInsuran' => 0,
                    'Pembiayaan_Al_Qardhul_Hasan' => 0,
                    'Pembiayaan_Membaikpulih_Kenderaan' => 0
                ];

                // Fill in the actual loan amounts
                foreach ($loanResults as $loan) {
                    if (isset($loans[$loan['loan_type']])) {
                        $loans[$loan['loan_type']] = $loan['total_amount'];
                    }
                }

                // First row of loans
                $this->Cell($loanColWidth, 8, 'Al-Bai:', 0);
                $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_Al_Bai'], 2), 0);
                $this->Cell($loanColWidth, 8, 'B/Pulih Kenderaan:', 0);
                $this->Cell($loanColWidth, 8, 'RM ' . number_format($loans['Pembiayaan_Membaikpulih_Kenderaan'], 2), 0, 1);

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
                error_log("Error in loan information query: " . $e->getMessage() . 
                         "\nReport Type: " . $this->reportType . 
                         "\nStart Date: " . ($this->startDate ?? 'null') . 
                         "\nEnd Date: " . ($this->endDate ?? 'null') . 
                         "\nSelected Month: " . ($this->selectedMonth ?? 'null') . 
                         "\nSelected Year: " . ($this->selectedYear ?? 'null'));
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
            } elseif ($this->reportType === 'custom') {
                $formattedPeriod = date('d/m/Y', strtotime($this->startDate)) . ' - ' . date('d/m/Y', strtotime($this->endDate));
                $startDate = $this->startDate;
                $endDate = $this->endDate;
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

            // Headers with swapped columns
            $this->Cell($dateWidth, 8, 'Tarikh', 1, 0, 'C', true);
            $this->Cell($typeWidth, 8, 'Jenis', 1, 0, 'C', true);
            $this->Cell($amountWidth, 8, 'Jumlah (RM)', 1, 0, 'C', true);
            $this->Cell($statusWidth, 8, 'Status', 1, 0, 'C', true);
            $this->Cell($descWidth, 8, 'Keterangan', 1, 1, 'C', true);

            try {
                // Get transactions for the selected period
                $stmt = $this->db->prepare("
                    SELECT 
                        st.*,
                        DATE_FORMAT(st.transaction_date, '%d/%m/%Y') as formatted_date
                    FROM saving_transactions st
                    JOIN saving_accounts sa ON st.account_id = sa.id
                    JOIN pendingregistermember prm ON sa.user_ic = prm.ic_no
                    WHERE prm.user_id = :user_id
                    AND DATE(st.transaction_date) BETWEEN :start_date AND :end_date
                    ORDER BY st.transaction_date DESC
                ");

                if (isset($_POST['transaction_type']) && $_POST['transaction_type'] !== 'all') {
                    $stmt = $this->db->prepare("
                        SELECT 
                            st.*,
                            DATE_FORMAT(st.transaction_date, '%d/%m/%Y') as formatted_date
                        FROM saving_transactions st
                        JOIN saving_accounts sa ON st.account_id = sa.id
                        JOIN pendingregistermember prm ON sa.user_ic = prm.ic_no
                        WHERE prm.user_id = :user_id
                        AND DATE(st.transaction_date) BETWEEN :start_date AND :end_date
                        AND st.transaction_type = :transaction_type
                        ORDER BY st.transaction_date DESC
                    ");
                    $stmt->bindParam(':transaction_type', $_POST['transaction_type']);
                }
                
                $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                $stmt->bindParam(':start_date', $startDate);
                $stmt->bindParam(':end_date', $endDate);
                $stmt->execute();
                $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Table content
                $this->SetFont('Arial', '', 10);
                if (!empty($transactions)) {
                    foreach ($transactions as $transaction) {
                        $currentY = $this->GetY();
                        $currentX = $this->GetX();
                        
                        // Calculate the maximum height needed for description
                        $this->SetY($currentY);
                        $this->SetX($currentX + $dateWidth + $typeWidth + $amountWidth + $statusWidth);
                        $descriptionHeight = $this->NbLines($descWidth, $transaction['description']) * 8;
                        $rowHeight = max(8, $descriptionHeight);

                        // Reset position and draw cells
                        $this->SetY($currentY);
                        $this->SetX($currentX);

                        // Date column
                        $this->Cell($dateWidth, $rowHeight, $transaction['formatted_date'], 1, 0, 'C');

                        // Transaction type column
                        $transType = $transaction['transaction_type'] === 'deposit' ? 'Deposit' : 'Pemindahan';
                        $this->Cell($typeWidth, $rowHeight, $transType, 1, 0, 'C');

                        // Amount column
                        $this->Cell($amountWidth, $rowHeight, number_format($transaction['amount'], 2), 1, 0, 'R');

                        // Status column with translation
                        $status = strtoupper($transaction['status']);
                        if ($status === 'APPROVED') {
                            $displayStatus = 'DILULUSKAN';
                        } elseif ($status === 'PENDING') {
                            $displayStatus = 'MENUNGGU';
                        } elseif ($status === 'REJECTED') {
                            $displayStatus = 'DITOLAK';
                        } else {
                            $displayStatus = $status;
                        }
                        $this->Cell($statusWidth, $rowHeight, $displayStatus, 1, 0, 'C');

                        // Description column with text wrapping
                        $this->MultiCell($descWidth, 8, $transaction['description'], 1, 'L');

                        // If description wrapped to multiple lines, move back up to align with other cells
                        if ($descriptionHeight > 8) {
                            $this->SetY($currentY + $rowHeight);
                        }
                    }
                } else {
                    $this->SetFont('Arial', '', 10);
                    $totalWidth = $dateWidth + $typeWidth + $amountWidth + $statusWidth + $descWidth;
                    if ($this->reportType === 'yearly') {
                        $this->Cell($totalWidth, 8, 'Tiada rekod transaksi untuk tahun ' . $formattedPeriod, 1, 1, 'C');
                    } elseif ($this->reportType === 'custom') {
                        $this->Cell($totalWidth, 8, 'Tiada rekod transaksi untuk tempoh ' . $formattedPeriod, 1, 1, 'C');
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
                $formattedMonth = $this->selectedYear;
                $startDate = $this->selectedYear . '-01-01';
                $endDate = $this->selectedYear . '-12-31';
            } elseif ($this->reportType === 'custom') {
                $formattedMonth = date('d/m/Y', strtotime($this->startDate)) . ' - ' . date('d/m/Y', strtotime($this->endDate));
                $startDate = $this->startDate;
                $endDate = $this->endDate;
            } else {
                $formattedMonth = date('F Y', strtotime($this->selectedMonth));
                $startDate = date('Y-m-01', strtotime($this->selectedMonth));
                $endDate = date('Y-m-t', strtotime($this->selectedMonth));
            }

            // Update the loan applications query with date and loan type filtering
            $query = "
                SELECT 
                    loan_type,
                    t_amount,
                    period,
                    mon_installment,
                    status,
                    created_at,
                    admin_remark
                FROM loan_applications 
                WHERE user_id = :user_id 
                AND DATE(created_at) BETWEEN :start_date AND :end_date";

            // Add loan type filter if specific type is selected
            if (isset($_POST['loan_type']) && $_POST['loan_type'] !== 'all') {
                $query .= " AND loan_type = :loan_type";
            }
            
            $query .= " ORDER BY created_at DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':start_date', $startDate);
            $stmt->bindValue(':end_date', $endDate);
            
            // Bind loan type if specific type is selected
            if (isset($_POST['loan_type']) && $_POST['loan_type'] !== 'all') {
                $stmt->bindValue(':loan_type', $_POST['loan_type']);
            }
            
            $stmt->execute();
            $loanApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Loan Report Header
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(0, 8, 'LAPORAN PINJAMAN - ' . $formattedMonth, 0, 1);
            $this->Ln(5);

            // Add "Ringkasan Pinjaman" heading
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 8, 'Ringkasan Pinjaman', 0, 1);
            $this->Ln(2);

            // Table headers
            $this->SetFillColor(245, 245, 245);
            $this->SetFont('Arial', 'B', 9);

            // Define column widths
            $typeWidth = 60;
            $amountWidth = 35;
            $periodWidth = 25;
            $installmentWidth = 35;
            $statusWidth = 25;

            // Headers
            $this->Cell($typeWidth, 8, 'Jenis Pinjaman', 1, 0, 'C', true);
            $this->Cell($amountWidth, 8, 'Jumlah Pinjaman (RM)', 1, 0, 'C', true);
            $this->Cell($periodWidth, 8, 'Tempoh(Bulan)', 1, 0, 'C', true);
            $this->Cell($installmentWidth, 8, 'Ansuran Bulanan (RM)', 1, 0, 'C', true);
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
                    
                    // Translate and set color for status
                    $status = strtoupper($loan['status']);
                    if ($status === 'APPROVED') {
                        $this->SetTextColor(0, 128, 0); // Green
                        $displayStatus = 'DILULUSKAN';
                    } elseif ($status === 'REJECTED') {
                        $this->SetTextColor(255, 0, 0); // Red
                        $displayStatus = 'DITOLAK';
                    } else {
                        $this->SetTextColor(255, 128, 0); // Orange
                        $displayStatus = 'PENDING';
                    }
                    
                    $this->Cell($statusWidth, 8, $displayStatus, 1, 1, 'C');
                    $this->SetTextColor(0, 0, 0); // Reset to black
                }
            } else {
                if ($this->reportType === 'yearly') {
                    $this->Cell($totalWidth, 8, 'Tiada rekod pinjaman untuk tahun ' . $formattedMonth, 1, 1, 'C');
                } elseif ($this->reportType === 'custom') {
                    $this->Cell($totalWidth, 8, 'Tiada rekod pinjaman untuk tempoh ' . $formattedPeriod, 1, 1, 'C');
                } else {
                    $this->Cell($totalWidth, 8, 'Tiada rekod pinjaman untuk ' . $formattedMonth, 1, 1, 'C');
                }
            }

            // Add spacing before detailed information
            $this->Ln(10);

            // Add "Maklumat Terperinci Pinjaman" heading
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 8, 'Maklumat Terperinci Pinjaman', 0, 1);
            $this->Ln(5);

            // Detailed loan information for each approved loan
            if (!empty($loanApplications)) {
                foreach ($loanApplications as $loan) {
                    if (strtoupper($loan['status']) === 'APPROVED') {
                        // Card-like container for each loan
                        $this->SetFillColor(255, 255, 255);
                        $this->Rect($this->GetX(), $this->GetY(), 180, 40, 'F');
                        
                        // Loan Type Header
                        $this->SetFont('Arial', 'B', 10);
                        $this->Cell(0, 8, $loan['loan_type'], 0, 1);
                        
                        // Left Column
                        $this->SetFont('Arial', '', 9);
                        $leftX = $this->GetX();
                        $leftY = $this->GetY();
                        
                        $this->Cell(90, 6, 'Jumlah Pinjaman: RM ' . number_format($loan['t_amount'], 2), 0, 1);
                        $this->Cell(90, 6, 'Tempoh: ' . $loan['period'] . ' bulan', 0, 1);
                        $this->Cell(90, 6, 'Ansuran Bulanan: RM ' . number_format($loan['mon_installment'], 2), 0, 1);
                        
                        // Right Column
                        $this->SetXY($leftX + 90, $leftY);
                        $this->Cell(90, 6, 'Tarikh Kelulusan: ' . date('d/m/Y', strtotime($loan['created_at'])), 0, 1);
                        $this->SetX($leftX + 90);
                        $this->Cell(90, 6, 'Status: Diluluskan', 0, 1);
                        
                        // Add spacing between loans
                        $this->Ln(8);
                        $this->Cell(180, 0, '', 'B', 1); 
                        $this->Ln(8);
                    }
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

        } catch (Exception $e) {
            error_log("Error generating PDF report: " . $e->getMessage());
            throw $e;
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
            AND p.status = 'approved'";

        // Add date condition based on report type
        if ($this->reportType === 'custom') {
            $accountQuery .= " AND DATE(p.created_at) <= :report_date";
            $reportDate = $this->endDate;
        } elseif ($this->reportType === 'monthly') {
            $accountQuery .= " AND DATE_FORMAT(p.created_at, '%Y-%m') <= :report_date";
            $reportDate = date('Y-m', strtotime($this->selectedMonth . '-01'));
        } else {
            // For yearly reports
            $accountQuery .= " AND YEAR(p.created_at) <= :report_date";
            $reportDate = $this->selectedYear;
        }

        $accountQuery .= " ORDER BY p.created_at DESC LIMIT 1";

        try {
            $stmt = $this->db->prepare($accountQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
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

            // Display the values
            $shareValues = [
                'share_capital' => $accountData['share_capital'] ?? 0,
                'fee_capital' => $accountData['fee_capital'] ?? 0,
                'fixed_deposit' => $accountData['fixed_deposit'] ?? 0,
                'balance' => $accountData['balance'] ?? 0
            ];
            
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

        } catch (Exception $e) {
            error_log("Error retrieving share information: " . $e->getMessage());
            throw $e;
        }
    }

    // Update the loan information query
    private function getLoanInformation($userId) {
        try {
            $query = "
                SELECT 
                    loan_type,
                    t_amount,
                    period,
                    mon_installment,
                    status,
                    created_at,
                    admin_remark
                FROM loan_applications 
                WHERE user_id = :userId";

            // Add date conditions based on report type
            if ($this->reportType === 'custom') {
                $query .= " AND DATE(created_at) BETWEEN :start_date AND :end_date";
            } elseif ($this->reportType === 'monthly') {
                $query .= " AND DATE_FORMAT(created_at, '%Y-%m') = :date_param";
            } else {
                $query .= " AND YEAR(created_at) = :date_param";
            }

            $query .= " ORDER BY created_at DESC";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            if ($this->reportType === 'custom') {
                $stmt->bindParam(':start_date', $this->startDate);
                $stmt->bindParam(':end_date', $this->endDate);
            } else {
                $dateParam = $this->reportType === 'monthly' 
                    ? date('Y-m', strtotime($this->selectedMonth))
                    : $this->selectedYear;
                $stmt->bindParam(':date_param', $dateParam);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            error_log("Error retrieving loan information: " . $e->getMessage());
            throw new Exception("Error retrieving loan information");
        }
    }

    // Add this helper function to your class
    private function NbLines($w, $txt) {
        // Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb) {
            $c = $s[$i];
            if($c=="\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l>$wmax) {
                if($sep==-1) {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}

// Main PDF generation code
try {
    // Get and validate input parameters
    $reportType = $_POST['report_type'] ?? 'monthly';
    $selectedMonth = $_POST['selected_month'] ?? '';
    $selectedYear = $_POST['selected_year'] ?? '';
    $startDate = $_POST['start_date'] ?? '';
    $endDate = $_POST['end_date'] ?? '';
    $transactionType = $_POST['transaction_type'] ?? 'all';
    $loanType = $_POST['loan_type'] ?? 'all';
    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        throw new Exception("User ID not found");
    }

    // Initialize database connection
    $db = new Database();
    $pdo = $db->connect();

    // Format dates based on report type
    switch($reportType) {
        case 'custom':
            if (empty($startDate) || empty($endDate)) {
                throw new Exception("Start and end dates are required for custom reports");
            }
            $reportDate = date('Y-m-d'); // Current date for custom reports
            break;
            
        case 'monthly':
            if (empty($selectedMonth)) {
                $selectedMonth = date('Y-m');
            }
            $startDate = date('Y-m-01', strtotime($selectedMonth));
            $endDate = date('Y-m-t', strtotime($selectedMonth));
            $reportDate = date('Y-m-d', strtotime($selectedMonth));
            break;
            
        case 'yearly':
            if (empty($selectedYear)) {
                $selectedYear = date('Y');
            }
            $startDate = $selectedYear . '-01-01';
            $endDate = $selectedYear . '-12-31';
            $reportDate = $selectedYear . '-12-31';
            break;
            
        default:
            throw new Exception("Invalid report type");
    }

    // Get user's financial data - Modified query to remove total_loans
    $query = "SELECT 
        p.share_capital,
        p.fee_capital,
        p.fixed_deposit,
        sa.balance as savings_balance
    FROM pendingregistermember p
    LEFT JOIN saving_accounts sa ON sa.user_ic = p.ic_no
    WHERE p.user_id = ? AND p.status = 'approved'";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $financialData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get loan data for the specific date range with proper filtering
    $loanQuery = "SELECT 
        loan_type,
        SUM(t_amount) as loan_amount
    FROM loan_applications 
    WHERE user_id = ? 
    AND status = 'APPROVED'";

    // Add date range conditions based on report type
    if ($reportType === 'custom') {
        $loanQuery .= " AND DATE(created_at) BETWEEN ? AND ?";
        $loanParams = [$userId, $startDate, $endDate];
    } elseif ($reportType === 'monthly') {
        $loanQuery .= " AND DATE_FORMAT(created_at, '%Y-%m') = ?";
        $loanParams = [$userId, date('Y-m', strtotime($selectedMonth))];
    } else { // yearly
        $loanQuery .= " AND YEAR(created_at) = ?";
        $loanParams = [$userId, $selectedYear];
    }

    // Add loan type filter if specific type is selected
    if ($loanType !== 'all') {
        $loanQuery .= " AND loan_type = ?";
        $loanParams[] = $loanType;
    }

    $loanQuery .= " GROUP BY loan_type";

    $stmt = $pdo->prepare($loanQuery);
    $stmt->execute($loanParams);
    $loanData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Delete existing records for this report before inserting new ones
    $deleteQuery = "DELETE FROM financial_report 
                   WHERE user_id = :userId 
                   AND report_type = :reportType 
                   AND start_date = :startDate 
                   AND end_date = :endDate";
    
    $stmt = $pdo->prepare($deleteQuery);
    $stmt->execute([
        ':userId' => $userId,
        ':reportType' => $reportType,
        ':startDate' => $startDate,
        ':endDate' => $endDate
    ]);

    // Insert a record for each loan type
    foreach ($loanData as $loan) {
        $insertQuery = "INSERT INTO financial_report (
            user_id, report_type, report_date, start_date, end_date,
            share_capital, fee_capital, fixed_deposit, savings_balance,
            loan_type, loan_amount
        ) VALUES (
            :userId, :reportType, :reportDate, :startDate, :endDate,
            :shareCapital, :feeCapital, :fixedDeposit, :savingsBalance,
            :loanType, :loanAmount
        )";

        $stmt = $pdo->prepare($insertQuery);
        $stmt->execute([
            ':userId' => $userId,
            ':reportType' => $reportType,
            ':reportDate' => $reportDate,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':shareCapital' => $financialData['share_capital'] ?? 0,
            ':feeCapital' => $financialData['fee_capital'] ?? 0,
            ':fixedDeposit' => $financialData['fixed_deposit'] ?? 0,
            ':savingsBalance' => $financialData['savings_balance'] ?? 0,
            ':loanType' => $loan['loan_type'],
            ':loanAmount' => $loan['loan_amount']
        ]);
    }

    // Create PDF instance with the data
    $pdf = new FinancialReport($selectedMonth, $selectedYear, $reportType, $startDate, $endDate);

    // Generate filename based on report type
    switch ($reportType) {
        case 'yearly':
            $filename = "Penyata_Kewangan_" . $selectedYear . ".pdf";
            break;
        case 'custom':
            $filename = "Penyata_Kewangan_" . date('Y_m_d', strtotime($startDate)) . 
                       "_hingga_" . date('Y_m_d', strtotime($endDate)) . ".pdf";
            break;
        default: // monthly
            $filename = "Penyata_Kewangan_" . date('Y_m', strtotime($selectedMonth)) . ".pdf";
    }

    // Generate the PDF
    $pdf->generateReport([
        'userData' => $financialData,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'reportType' => $reportType
    ]);

    // Clean output buffer and output PDF
    ob_end_clean();
    $pdf->Output('D', $filename);

} catch (Exception $e) {
    ob_end_clean();
    error_log("Error generating PDF report: " . $e->getMessage());
    die("Error generating report: " . $e->getMessage());
}