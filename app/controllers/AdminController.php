<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;
use App\Core\Database;
use App\Services\EmailService;
use PDOException;
use PDO;
use Exception;



class AdminController extends Controller
{
    private $admin;
    protected $db;
    private $mailer;

    public function __construct() {
        parent::__construct();
        $this->admin = new Admin();
        $this->db = Database::getInstance();
        $this->mailer = new EmailService();
    }

    private function sendSuccessResponse($message) {
        return json_encode([
            'success' => true,
            'message' => $message,
            'messageType' => 'success'
        ]);
    }

    public function index()
{
    try {
        $stats = $this->admin->getStatistics();
        
        $db = new Database();
        $conn = $db->connect();
        
        // Fetch all pending register members
        $sql = "SELECT *
                FROM pendingregistermember 
                ORDER BY id DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $pendingregistermembers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add this new query for loan applications
        $sql = "SELECT *
        FROM loan_applications
        ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $loan_applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get withdrawals using the model
        $withdrawals = $this->admin->getTransferRequests();

        // Get all inquiries
        $inquiries = $this->admin->getAllInquiries();

        // Pass the data to the view
        $this->view('admins/index', [
            'pendingregistermembers' => $pendingregistermembers,
            'withdrawals' => $withdrawals,
            'loan_applications' => $loan_applications,
            'inquiries' => $inquiries,
            'stats' => $stats
        ]);
        
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error fetching data: " . $e->getMessage();
            $this->view('admins/index', [
                'pendingregistermembers' => [],
                'withdrawals' => [],
                'loan_applications' => [],
                'inquiries' => [],
                'stats' => []
            ]);
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            $this->view('admins/index', [
                'pendingregistermembers' => [],
                'withdrawals' => [],
                'loan_applications' => [],
                'inquiries' => [],
                'stats' => []
            ]);
        }
    }

    //Loan

    public function viewLoan($id)
    {
        try {
            // Get loan model instead of user model
            $loanModel = new \App\Models\Loan();
            
            // Get loan data by ID
            $data['loan'] = $loanModel->find($id);
            
            if (!$data['loan']) {
                throw new Exception('Loan application not found');
            }
            
            // Load view
            $this->view('admins/loans', $data);
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header('Location: /admins');
            exit();
        }
    }

    public function approveLoan($loanId) {
        try {
            // First, let's just get the basic loan information
            $sql = "SELECT * FROM loan_applications WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$loanId]);
            $loanData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$loanData) {
                throw new Exception('Loan application not found');
            }

            // Now get the user information and savings account
            $sql = "SELECT u.*, sa.id as savings_account_id, sa.balance 
                   FROM users u 
                   LEFT JOIN pendingregistermember p ON u.id = p.user_id 
                   LEFT JOIN saving_accounts sa ON p.ic_no = sa.user_ic 
                   WHERE u.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$loanData['user_id']]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData['savings_account_id']) {
                throw new Exception('Savings account not found for this user');
            }

            // Start transaction
            $this->db->beginTransaction();

            try {
                // 1. Update loan status
                $stmt = $this->db->prepare("UPDATE loan_applications SET status = 'approved' WHERE id = ?");
                $stmt->execute([$loanId]);

                // 2. Add loan amount to savings account
                $updateBalanceSql = "UPDATE saving_accounts SET balance = balance + ? WHERE id = ?";
                $stmt = $this->db->prepare($updateBalanceSql);
                $stmt->execute([$loanData['t_amount'], $userData['savings_account_id']]);

                // 3. Record the transaction
                $transactionSql = "INSERT INTO saving_transactions (
                    account_id,
                    transaction_type,
                    amount,
                    description,
                    status,
                    transaction_date
                ) VALUES (?, 'deposit', ?, ?, 'approved', NOW())";
                
                $stmt = $this->db->prepare($transactionSql);
                $stmt->execute([
                    $userData['savings_account_id'],
                    $loanData['t_amount'],
                    'Loan Disbursement - ' . $loanData['loan_type']
                ]);

                // Combine the data for email
                $loanData['email'] = $userData['email'];
                $loanData['name'] = $userData['name'] ?? $userData['fullname'] ?? $userData['username'] ?? '';

                // Send approval email
                $this->mailer->sendLoanApprovalEmail($loanData['email'], $loanData);
                
                $this->db->commit();
                $_SESSION['success'] = "Permohonan pinjaman telah diluluskan dan wang telah dikreditkan ke akaun simpanan";

            } catch (Exception $e) {
                $this->db->rollBack();
                throw $e;
            }

            header('Location: /admins');
            exit;
            
        } catch (Exception $e) {
            error_log("Error in approveLoan: " . $e->getMessage());
            $_SESSION['error'] = "Ralat semasa meluluskan pinjaman: " . $e->getMessage();
            header('Location: /admins');
            exit;
        }
    }


    public function rejectLoan($id) {
        try {
            if (empty($_POST['admin_remark'])) {
                throw new Exception('Sila masukkan catatan penolakan.');
            }

            // First, get the loan information
            $sql = "SELECT * FROM loan_applications WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $loanData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$loanData) {
                throw new Exception('Loan application not found');
            }

            // Get the user information
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$loanData['user_id']]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Combine the data
            $loanData['email'] = $userData['email'];

            // Update status
            $stmt = $this->db->prepare("UPDATE loan_applications SET status = 'rejected', admin_remark = ? WHERE id = ?");
            if ($stmt->execute([$_POST['admin_remark'], $id])) {
                // Send rejection email
                $this->mailer->sendLoanRejectionEmail($loanData['email'], $loanData, $_POST['admin_remark']);
                echo json_encode(['success' => true, 'message' => 'Permohonan pinjaman telah berjaya ditolak.']);
            }
        } catch (Exception $e) {
            error_log("Error in rejectLoan: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function processTransfer() {
        // Prevent PHP errors from being displayed
        ini_set('display_errors', 0);
        error_reporting(E_ALL);
        
        // Ensure we're sending JSON response
        header('Content-Type: application/json');
        
        try {
            error_log("Starting processTransfer");
            
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            if (!isset($_POST['transaction_id']) || !isset($_POST['status'])) {
                throw new Exception('Missing required parameters');
            }

            // Validate transaction_id is numeric
            if (!is_numeric($_POST['transaction_id'])) {
                throw new Exception('Invalid transaction ID');
            }

            // Get transfer details with user email
            $sql = "SELECT st.*, u.email, p.name 
                    FROM saving_transactions st
                    JOIN saving_accounts sa ON st.account_id = sa.id
                    JOIN pendingregistermember p ON sa.user_ic = p.ic_no
                    JOIN users u ON p.user_id = u.id
                    WHERE st.id = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$_POST['transaction_id']]);
            $transferData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$transferData) {
                throw new Exception('Transfer request not found');
            }

            $this->db->beginTransaction();

            try {
                // Update transfer status
                $updateSql = "UPDATE saving_transactions 
                             SET status = ?, 
                                 admin_remark = ?,
                                 processed_by = ?,
                                 processed_at = NOW()
                             WHERE id = ?";
                
                $params = [
                    $_POST['status'],
                    $_POST['admin_remark'] ?? null,
                    $_SESSION['admin_id'] ?? null,
                    $_POST['transaction_id']
                ];
                
                $stmt = $this->db->prepare($updateSql);
                $result = $stmt->execute($params);

                if ($result) {
                    if ($_POST['status'] === 'approved') {
                        $updateBalanceSql = "UPDATE saving_accounts 
                                           SET balance = balance - ? 
                                           WHERE id = ?";
                        $stmt = $this->db->prepare($updateBalanceSql);
                        $stmt->execute([
                            $transferData['amount'],
                            $transferData['account_id']
                        ]);

                        try {
                            $this->mailer->sendTransferApprovalEmail($transferData['email'], $transferData);
                        } catch (Exception $e) {
                            error_log("Email sending failed: " . $e->getMessage());
                        }
                    } else {
                        try {
                            $this->mailer->sendTransferRejectionEmail(
                                $transferData['email'],
                                $transferData,
                                $_POST['admin_remark'] ?? 'No remarks provided'
                            );
                        } catch (Exception $e) {
                            error_log("Email sending failed: " . $e->getMessage());
                        }
                    }

                    $this->db->commit();
                    
                    echo json_encode([
                        'success' => true,
                        'message' => $_POST['status'] === 'approved' ? 
                            'Permohonan pindahan wang telah berjaya diluluskan.' : 
                            'Permohonan pindahan wang telah berjaya ditolak.'
                    ]);
                    exit;
                } else {
                    throw new Exception('Failed to update transfer status');
                }
            } catch (Exception $e) {
                $this->db->rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Error in processTransfer: " . $e->getMessage());
            
            echo json_encode([
                'success' => false,
                'message' => 'Ralat: ' . $e->getMessage()
            ]);
            exit;
        }
    }

    public function approve($id)
    {
        try {
            // Get user details before updating status
            $sql = "SELECT u.email, p.* 
                    FROM pendingregistermember p 
                    JOIN users u ON p.user_id = u.id 
                    WHERE p.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $memberData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$memberData) {
                throw new Exception('Member not found');
            }

            $this->db->beginTransaction();

            try {
                // Update status
                $userModel = new Admin();
                $result = $userModel->updateStatus($id, 'approved');

                if (!$result) {
                    throw new Exception('Failed to update member status');
                }

                // Send approval email
                try {
                    $this->mailer->sendMemberApprovalEmail($memberData['email'], $memberData);
                } catch (Exception $e) {
                    error_log("Failed to send approval email: " . $e->getMessage());
                }

                $this->db->commit();
                
                // Return success without redirecting
                echo json_encode(['success' => true]);
                exit;

            } catch (Exception $e) {
                $this->db->rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Error in approve: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            exit;
        }
    }

    public function reject($id)
    {
        header('Content-Type: application/json');

        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            if (empty($_POST['admin_remark'])) {
                throw new Exception('Sila masukkan catatan penolakan.');
            }

            // Get member details before updating
            $sql = "SELECT u.email, p.* 
                    FROM pendingregistermember p 
                    JOIN users u ON p.user_id = u.id 
                    WHERE p.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $memberData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Update status
            $stmt = $this->db->prepare("UPDATE pendingregistermember SET status = 'rejected', admin_remark = ? WHERE id = ?");
            if ($stmt->execute([$_POST['admin_remark'], $id])) {
                // Send rejection email
                $this->mailer->sendMemberRejectionEmail($memberData['email'], $memberData, $_POST['admin_remark']);
                echo json_encode(['success' => true, 'message' => 'Permohonan keahlian telah berjaya ditolak.']);
            }
        } catch (Exception $e) {
            error_log("Error in reject: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => "Ralat: " . $e->getMessage()
            ]);
        }
        exit;
    }

    public function viewMember($id)
    {
        try {
            // Get member data using the getMemberById method
            $member = $this->admin->getMemberById($id);
            
            if (!$member) {
                throw new Exception('Member not found');
            }

            // Debug log to check the data
            error_log("Member data: " . print_r($member, true));
            
            // Pass the data to the view
            $this->view('admins/view', ['member' => $member]);
            
        } catch (Exception $e) {
            error_log("Error in viewMember: " . $e->getMessage());
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header('Location: /admins');
            exit();
        }
    }

    public function replyInquiry() {
        header('Content-Type: application/json');

        try {
            if (!isset($_POST['inquiry_id']) || !isset($_POST['admin_response'])) {
                throw new Exception('Maklumat yang diperlukan tidak lengkap');
            }

            // Get inquiry details including user email
            $sql = "SELECT i.*, u.email 
                    FROM inquiries i
                    JOIN users u ON i.user_id = u.id
                    WHERE i.id = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$_POST['inquiry_id']]);
            $inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$inquiry) {
                throw new Exception('Pertanyaan tidak dijumpai');
            }

            $data = [
                'inquiry_id' => $_POST['inquiry_id'],
                'admin_response' => trim($_POST['admin_response']),
                'admin_id' => $_SESSION['admin_id'] ?? $_SESSION['user_id'] // Fallback to user_id if admin_id not set
            ];

            // Update inquiry
            if ($this->admin->replyInquiry($data)) {
                // Send email notification
                try {
                    $inquiryDetails = [
                        'mesej' => $inquiry['message'],
                        'admin_reply' => $data['admin_response'],
                        'reply_date' => date('d/m/Y h:i A')
                    ];
                    
                    $this->mailer->sendInquiryResponseNotification(
                        $inquiry['email'],
                        $inquiryDetails
                    );
                } catch (Exception $e) {
                    error_log("Email sending failed: " . $e->getMessage());
                    // Continue execution even if email fails
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'Maklum balas telah berjaya dihantar.'
                ]);
            } else {
                throw new Exception('Gagal mengemaskini pertanyaan');
            }

        } catch (Exception $e) {
            error_log("Error in replyInquiry: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Ralat: ' . $e->getMessage()
            ]);
        }
    }

    public function processLoan()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            if (!isset($_SESSION['user_id'])) {
                throw new Exception('Admin not logged in');
            }

            if (!isset($_POST['loan_id']) || !isset($_POST['status']) || !isset($_POST['admin_remark'])) {
                throw new Exception('Missing required fields');
            }

            $loanId = $_POST['loan_id'];
            $status = $_POST['status'];
            $adminRemark = $_POST['admin_remark'];
            $adminId = $_SESSION['user_id'];

            // Update loan status and remark
            $stmt = $this->db->prepare("
                UPDATE loan_applications 
                SET status = ?,
                    admin_remark = ?,
                    updated_at = NOW()
                WHERE id = ?
            ");

            if ($stmt->execute([$status, $adminRemark, $loanId])) {
                $_SESSION['success'] = "Permohonan pinjaman telah " . 
                    ($status === 'approved' ? 'diluluskan' : 'ditolak');
            } else {
                throw new Exception('Gagal mengemaskini status pinjaman');
            }

        } catch (Exception $e) {
            $_SESSION['error'] = "Ralat: " . $e->getMessage();
        }

        header('Location: /admins');
        exit;
    }
    
    public function generateReport()
    {
        try {
            $admin = new Admin();
            
            // Get loan summary statistics
            $sql = "SELECT 
                    COALESCE(COUNT(*), 0) as total,
                    COALESCE(SUM(t_amount), 0) as total_amount,
                    COALESCE(SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END), 0) as approved,
                    COALESCE(SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END), 0) as rejected,
                    COALESCE(SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END), 0) as pending
                    FROM loan_applications";
            $loanStats = $admin->getConnection()->query($sql)->fetch(PDO::FETCH_ASSOC);

            // Get withdrawal summary statistics
            $sql = "SELECT 
                    COALESCE(COUNT(*), 0) as total,
                    COALESCE(SUM(amount), 0) as total_amount,
                    COALESCE(SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END), 0) as approved,
                    COALESCE(SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END), 0) as rejected,
                    COALESCE(SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END), 0) as pending
                    FROM saving_transactions
                    WHERE transaction_type = 'transfer'";
            $withdrawalStats = $admin->getConnection()->query($sql)->fetch(PDO::FETCH_ASSOC);

            // Get member summary statistics
            $sql = "SELECT 
                    (SELECT COUNT(*) FROM pendingregistermember) as total_applications,
                    (SELECT COUNT(*) FROM pendingregistermember WHERE status = 'approved') as approved_members,
                    (SELECT COUNT(*) FROM pendingregistermember WHERE status = 'pending') as pending_members
                    FROM dual";
            $memberStats = $admin->getConnection()->query($sql)->fetch(PDO::FETCH_ASSOC);

            // Debug output
            error_log("Loan Stats: " . print_r($loanStats, true));
            error_log("Withdrawal Stats: " . print_r($withdrawalStats, true));
            error_log("Member Stats: " . print_r($memberStats, true));

            // Verify table names and structure
            $sql = "SHOW TABLES";
            $tables = $admin->getConnection()->query($sql)->fetchAll(PDO::FETCH_COLUMN);
            error_log("Available tables: " . print_r($tables, true));

            // Check if tables exist and have data
            $sql = "SELECT COUNT(*) as count FROM loan_applications";
            $loanCount = $admin->getConnection()->query($sql)->fetch(PDO::FETCH_ASSOC);
            error_log("Loan applications count: " . $loanCount['count']);

            $sql = "SELECT COUNT(*) as count FROM saving_transactions";
            $withdrawalCount = $admin->getConnection()->query($sql)->fetch(PDO::FETCH_ASSOC);
            error_log("Saving transactions count: " . $withdrawalCount['count']);

            $sql = "SELECT COUNT(*) as count FROM pendingregistermember";
            $memberCount = $admin->getConnection()->query($sql)->fetch(PDO::FETCH_ASSOC);
            error_log("Member count: " . $memberCount['count']);

            // ... rest of your existing code ...

            // Make sure values are at least 0
            $loanStats['total'] = max(0, $loanStats['total']);
            $loanStats['total_amount'] = max(0, $loanStats['total_amount']);
            $withdrawalStats['total'] = max(0, $withdrawalStats['total']);
            $withdrawalStats['total_amount'] = max(0, $withdrawalStats['total_amount']);
            $memberStats['total'] = max(0, $memberStats['total_applications']);
            $memberStats['approved'] = max(0, $memberStats['approved_members']);

            // Get available months for dropdown
            $sql = "SELECT DISTINCT 
                    DATE_FORMAT(created_at, '%Y-%m') as month_year,
                    DATE_FORMAT(created_at, '%M %Y') as month_name
                    FROM loan_applications
                    ORDER BY month_year DESC";
            $availableMonths = $admin->getConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // Get current year and month
            $currentYear = date('Y');
            $currentMonth = date('m');
            $daysInMonth = date('t');

            // Generate array of all days in current month
            $allDays = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                $allDays[$date] = [
                    'date' => $date,
                    'total' => 0,
                    'amount' => 0
                ];
            }

            // Get daily loan data
            $sql = "SELECT 
                    DATE(created_at) as date,
                    COUNT(*) as total,
                    COALESCE(SUM(t_amount), 0) as amount
                    FROM loan_applications
                    WHERE MONTH(created_at) = :month
                    AND YEAR(created_at) = :year
                    GROUP BY DATE(created_at)";
            $stmt = $admin->getConnection()->prepare($sql);
            $stmt->execute([':month' => $currentMonth, ':year' => $currentYear]);
            $loanData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($loanData as $data) {
                if (isset($allDays[$data['date']])) {
                    $allDays[$data['date']] = $data;
                }
            }
            $loanStats['daily_data'] = array_values($allDays);

            // Reset allDays for withdrawal data
            foreach ($allDays as &$day) {
                $day['total'] = 0;
                $day['amount'] = 0;
            }

            // Get daily withdrawal data
            $sql = "SELECT 
                    DATE(transaction_date) as date,
                    COUNT(*) as total,
                    COALESCE(SUM(amount), 0) as amount
                    FROM saving_transactions
                    WHERE transaction_type = 'transfer'
                    AND MONTH(transaction_date) = :month
                    AND YEAR(transaction_date) = :year
                    GROUP BY DATE(transaction_date)";
            $stmt = $admin->getConnection()->prepare($sql);
            $stmt->execute([':month' => $currentMonth, ':year' => $currentYear]);
            $withdrawalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($withdrawalData as $data) {
                if (isset($allDays[$data['date']])) {
                    $allDays[$data['date']] = $data;
                }
            }
            $withdrawalStats['daily_data'] = array_values($allDays);

            // Get gender distribution
            $genderSql = "SELECT 
                    CASE WHEN LOWER(gender) IN ('male', 'lelaki') THEN 'Lelaki'
                         WHEN LOWER(gender) IN ('female', 'perempuan') THEN 'Perempuan'
                         ELSE gender END as gender,
                    COUNT(*) as total
                    FROM pendingregistermember
                    WHERE status = 'approved'
                    AND gender IS NOT NULL
                    GROUP BY gender";
            $memberStats['gender_distribution'] = $admin->getConnection()->query($genderSql)->fetchAll(PDO::FETCH_ASSOC);

            // Pass data to view
            $this->view('admins/report', [
                'loanStats' => $loanStats,
                'withdrawalStats' => $withdrawalStats,
                'memberStats' => $memberStats,
                'availableMonths' => $availableMonths
            ]);
            
        } catch (Exception $e) {
            error_log("Error in generateReport: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $_SESSION['error'] = "Error generating report: " . $e->getMessage();
            header('Location: /admins');
            exit();
        }
    }

    public function getMonthlyData($monthYear) {
        try {
            $admin = new Admin();
            list($year, $month) = explode('-', $monthYear);
            
            // Get days in selected month
            $daysInMonth = date('t', strtotime($monthYear . '-01'));
            
            // Generate array of all days in selected month
            $allDays = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $allDays[$date] = [
                    'date' => $date,
                    'total' => 0,
                    'amount' => 0
                ];
            }

            // Get loan data
            $sql = "SELECT 
                    DATE(created_at) as date,
                    COUNT(*) as total,
                    SUM(t_amount) as amount
                    FROM loan_applications
                    WHERE MONTH(created_at) = :month
                    AND YEAR(created_at) = :year
                    GROUP BY DATE(created_at)";
            
            $stmt = $admin->getConnection()->prepare($sql);
            $stmt->execute([':month' => $month, ':year' => $year]);
            $loanData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Merge loan data with all days
            foreach ($loanData as $data) {
                if (isset($allDays[$data['date']])) {
                    $allDays[$data['date']] = $data;
                }
            }
            $loanDataComplete = array_values($allDays);

            // Reset allDays for withdrawal data
            foreach ($allDays as &$day) {
                $day['total'] = 0;
                $day['amount'] = 0;
            }

            // Get withdrawal data
            $sql = "SELECT 
                    DATE(transaction_date) as date,
                    COUNT(*) as total,
                    SUM(amount) as amount
                    FROM saving_transactions
                    WHERE transaction_type = 'transfer'
                    AND MONTH(transaction_date) = :month
                    AND YEAR(transaction_date) = :year
                    GROUP BY DATE(transaction_date)";
            
            $stmt = $admin->getConnection()->prepare($sql);
            $stmt->execute([':month' => $month, ':year' => $year]);
            $withdrawalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Merge withdrawal data with all days
            foreach ($withdrawalData as $data) {
                if (isset($allDays[$data['date']])) {
                    $allDays[$data['date']] = $data;
                }
            }
            $withdrawalDataComplete = array_values($allDays);

            header('Content-Type: application/json');
            echo json_encode([
                'loanData' => $loanDataComplete,
                'withdrawalData' => $withdrawalDataComplete
            ]);
            exit;
            
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }

    private function sendLoanApprovalEmail($userEmail, $loanDetails) {
        $subject = "Status Permohonan Pinjaman KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pinjaman KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Dengan sukacitanya kami ingin memaklumkan bahawa permohonan pinjaman anda telah <strong style='color: #4CAF50;'>DILULUSKAN</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Butiran Pinjaman:</strong></p>
                    <p>Jenis Pinjaman: {$loanDetails['loan_type']}</p>
                    <p>Jumlah Pinjaman: RM" . number_format($loanDetails['t_amount'], 2) . "</p>
                    <p>Tempoh: {$loanDetails['period']} bulan</p>
                    <p>Ansuran Bulanan: RM" . number_format($loanDetails['mon_installment'], 2) . "</p>
                </div>
                <p>Sila pastikan pembayaran ansuran dibuat sebelum tarikh yang ditetapkan setiap bulan.</p>
                <p>Sekiranya terdapat sebarang pertanyaan, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    private function sendLoanRejectionEmail($userEmail, $loanDetails, $remark) {
        $subject = "Status Permohonan Pinjaman KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pinjaman KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Kami mohon maaf untuk memaklumkan bahawa permohonan pinjaman anda telah <strong style='color: #f44336;'>DITOLAK</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Sebab Penolakan:</strong><br>{$remark}</p>
                </div>
                <p>Anda boleh mengemukakan permohonan baharu.</p>
                <p>Untuk sebarang pertanyaan lanjut, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    private function sendTransferApprovalEmail($userEmail, $transferDetails) {
        $subject = "Status Permohonan Pindahan Wang KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pindahan Wang KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Dengan sukacitanya kami memaklumkan bahawa permohonan pindahan wang anda telah <strong style='color: #4CAF50;'>DILULUSKAN</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Butiran Pindahan:</strong></p>
                    <p>Jumlah: RM" . number_format($transferDetails['amount'], 2) . "</p>
                    <p>Tarikh Permohonan: " . date('d/m/Y', strtotime($transferDetails['transaction_date'])) . "</p>
                </div>
                <p>Wang akan dipindahkan ke akaun anda dalam masa 3 hari bekerja.</p>
                <p>Sekiranya terdapat sebarang pertanyaan, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    private function sendTransferRejectionEmail($userEmail, $transferDetails, $remark) {
        $subject = "Status Permohonan Pindahan Wang KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pindahan Wang KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Kami mohon maaf untuk memaklumkan bahawa permohonan pindahan wang anda telah <strong style='color: #f44336;'>DITOLAK</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Sebab Penolakan:</strong><br>{$remark}</p>
                    <p>Jumlah Dipohon: RM" . number_format($transferDetails['amount'], 2) . "</p>
                </div>
                <p>Sila semak semula baki akaun dan had pengeluaran anda sebelum membuat permohonan baharu.</p>
                <p>Untuk sebarang pertanyaan lanjut, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    private function sendMemberApprovalEmail($userEmail, $memberDetails) {
        $subject = "Status Permohonan Keahlian KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Keahlian KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Tahniah! Permohonan keahlian anda telah <strong style='color: #4CAF50;'>DILULUSKAN</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Butiran Keahlian:</strong></p>
                    <p>Nama: {$memberDetails['name']}</p>
                    <p>No. Ahli: {$memberDetails['member_number']}</p>
                </div>
                <p>Anda kini boleh:</p>
                <ul>
                    <li>Mengakses semua kemudahan ahli KADA</li>
                    <li>Memohon pinjaman</li>
                    <li>Membuat simpanan</li>
                    <li>Menikmati faedah-faedah keahlian</li>
                </ul>
                <p>Selamat datang ke keluarga besar KADA!</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    private function sendMemberRejectionEmail($userEmail, $memberDetails, $remark) {
        $subject = "Status Permohonan Keahlian KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Keahlian KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Kami mohon maaf untuk memaklumkan bahawa permohonan keahlian anda telah <strong style='color: #f44336;'>DITOLAK</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Sebab Penolakan:</strong><br>{$remark}</p>
                </div>
                <p>Anda boleh mengemukakan permohonan baharu dengan memastikan semua dokumen dan maklumat yang diperlukan lengkap.</p>
                <p>Untuk sebarang pertanyaan lanjut, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    private function sendInquiryResponseEmail($userEmail, $inquiryDetails, $response) {
        $subject = "Maklum Balas Pertanyaan KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Maklum Balas Pertanyaan KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Pihak kami telah menjawab pertanyaan anda. Sila log masuk ke sistem KADA untuk melihat maklum balas penuh.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Pertanyaan Asal:</strong><br>{$inquiryDetails['mesej']}</p>
                </div>
                <p>Untuk melihat maklum balas penuh, sila:</p>
                <ol>
                    <li>Log masuk ke akaun KADA anda</li>
                    <li>Pergi ke bahagian 'Pertanyaan Saya'</li>
                    <li>Klik pada pertanyaan untuk melihat maklum balas</li>
                </ol>
                <p>Terima kasih kerana menghubungi kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->mailer->sendVerificationEmail($userEmail, null, $subject, $body);
    }

    public function getLoanApplications() {
        try {
            // Get all pending loan applications with user information
            $sql = "SELECT l.*, u.email 
                    FROM loan_applications l 
                    JOIN users u ON l.user_id = u.id 
                    WHERE l.status = 'pending'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in getLoanApplications: " . $e->getMessage());
            return [];
        }
    }

    public function processInquiry() {
        try {
            if (!isset($_POST['inquiry_id']) || !isset($_POST['admin_reply'])) {
                throw new Exception('Maklumat yang diperlukan tidak lengkap');
            }

            // Get inquiry details including user email
            $sql = "SELECT i.*, u.email, p.name 
                    FROM inquiries i
                    JOIN users u ON i.user_id = u.id
                    JOIN pendingregistermember p ON u.id = p.user_id
                    WHERE i.id = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$_POST['inquiry_id']]);
            $inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

            // Debug log the inquiry data
            error_log("Full inquiry data: " . print_r($inquiry, true));

            if (!$inquiry) {
                throw new Exception('Pertanyaan tidak dijumpai');
            }

            // Update inquiry with admin reply
            $updateSql = "UPDATE inquiries 
                         SET admin_reply = ?,
                             reply_date = NOW(),
                             status = 'dijawab',
                             admin_id = ?
                         WHERE id = ?";
            
            $stmt = $this->db->prepare($updateSql);
            $result = $stmt->execute([
                $_POST['admin_reply'],
                $_SESSION['admin_id'],
                $_POST['inquiry_id']
            ]);

            if ($result) {
                // Prepare data for email notification
                $inquiryDetails = [
                    'mesej' => $inquiry['mesej'],  // Make sure this matches your database column name
                    'admin_reply' => $_POST['admin_reply'],
                    'reply_date' => date('d/m/Y h:i A')
                ];

                // Debug log the data being sent to email
                error_log("Data being sent to email service: " . print_r($inquiryDetails, true));

                try {
                    $this->mailer->sendInquiryResponseNotification(
                        $inquiry['email'],
                        $inquiryDetails
                    );
                    error_log("Email sent successfully to: " . $inquiry['email']);
                } catch (Exception $e) {
                    error_log("Failed to send email: " . $e->getMessage());
                }
                
                $_SESSION['success'] = "Maklum balas telah berjaya dihantar";
            } else {
                throw new Exception('Gagal mengemaskini pertanyaan');
            }

            header('Location: /admins/inquiries');
            exit;

        } catch (Exception $e) {
            error_log("Ralat dalam processInquiry: " . $e->getMessage());
            $_SESSION['error'] = "Ralat semasa memproses pertanyaan: " . $e->getMessage();
            header('Location: /admins/inquiries');
            exit;
        }
    }
}