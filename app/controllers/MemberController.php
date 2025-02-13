<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Member;
use App\Models\Loan;
use PDOException;
use App\Core\Database;

use PDO;
use Exception;
use DateTime;
use ReceiptPDF;
use FPDF;

class MemberController extends Controller
    {
    
        private $member;
        private $loan;
        protected $db;
    
    
    public function __construct(){
        $this->member = new Member();
        $this->loan = new Loan();
        $this->db = new Database();
        $this->db = $this->db->connect();
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            error_log("Index method - User ID: " . $_SESSION['user_id']); // Debug log
            
            // Get pending registration data
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            error_log("Pending data found: " . ($pendingData ? "Yes" : "No")); // Debug log
            
            // Get the user's status
            $memberStatus = $pendingData ? $pendingData['status'] : null;
            error_log("Member status: " . ($memberStatus ?? "None")); // Debug log

            // Prepare view data
            $viewData = [
                'pendingData' => $pendingData,
                'memberStatus' => $memberStatus,
                'user' => [
                    'profile_picture' => '/images/default-avatar.png' // You can modify this if you have user profile pictures
                ]
            ];

            // Add error message if exists
            if (isset($_SESSION['error_message'])) {
                $viewData['error_message'] = $_SESSION['error_message'];
                unset($_SESSION['error_message']); // Clear after use
            }

            $this->view('members/index', $viewData);
            
        } catch (\Exception $e) {
            error_log("Error in index method: " . $e->getMessage());
            $this->view('members/index', [
                'error_message' => "Error retrieving member information: " . $e->getMessage()
            ]);
        }
    }

    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            // Get current user's member application
            $memberApplication = $this->member->getMemberApplication($_SESSION['user_id']);
            
            $viewData = [
                'pendingData' => $pendingData,
                'memberApplication' => $memberApplication
            ];

            // Add error message if exists
            if (isset($_SESSION['error_message'])) {
                $viewData['error_message'] = $_SESSION['error_message'];
                unset($_SESSION['error_message']);
            }

            $this->view('members/profile', $viewData);
        } catch (\Exception $e) {
            $_SESSION['error'] = "Error retrieving profile information: " . $e->getMessage();
            $this->view('members/profile', ['error' => $_SESSION['error']]);
        }
    }



    public function benefits() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            // Get pending registration data
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            $viewData = [
                'pendingData' => $pendingData  // Only pass pendingData for username
            ];
            
            $this->view('members/benefits', $viewData);
        } catch (Exception $e) {
            error_log("Error in benefits: " . $e->getMessage());
            $_SESSION['error'] = "Error retrieving information";
            header('Location: /members');
            exit;
        }
    }

    public function loans() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            // Get pending registration data
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            $viewData = [
                'user' => [
                    'profile_picture' => '/images/default-avatar.png'
                ],
                'pendingData' => $pendingData  // Add this to show username
            ];
            
            $this->view('members/loans', $viewData);
        } catch (Exception $e) {
            error_log("Error in loans: " . $e->getMessage());
            $_SESSION['error'] = "Error retrieving information";
            header('Location: /members');
            exit;
        }
    }


    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Sila log masuk terlebih dahulu";
            header('Location: /userlogin');
            exit;
        }

        try {
            // Get all loan applications
            $applications = $this->getLoanApplications();
            
            // Get member registration application
            $memberApplication = $this->getMemberApplication();

            $this->view('members/dashboard', [
                'member' => (object)[
                    'full_name' => $memberApplication['name'] ?? 'Tetamu',
                    'last_login' => date('Y-m-d H:i:s')
                ],
                'applications' => $applications,
                'memberApplication' => $memberApplication
            ]);
            
        } catch (\Exception $e) {
            error_log("Dashboard error: " . $e->getMessage());
            $_SESSION['error'] = "Ralat mendapatkan maklumat pengguna: " . $e->getMessage();
            header('Location: /members');
            exit;
        }
    }

    private function getLoanApplications() {
        $sql = "SELECT * FROM loan_applications WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetchAll();
    }

    private function filterMemberApplication($memberApplication, $dateFrom, $dateTo) {
        if (!$memberApplication) {
            return null;
        }

        $applicationDate = date('Y-m-d', strtotime($memberApplication['created_at']));
        
        if ($dateFrom && $applicationDate < $dateFrom) {
            return null;
        }
        
        if ($dateTo && $applicationDate > $dateTo) {
            return null;
        }
        
        return $memberApplication;
    }

    private function getMemberApplication() {
        $stmt = $this->db->prepare("
            SELECT * FROM pendingregistermember 
            WHERE user_id = ? 
            ORDER BY created_at DESC 
            LIMIT 1
        ");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    }

    public function customerService() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }
        
        try {
            // Get inquiries directly in the controller
            $inquiries = $this->member->getInquiriesByUserId($_SESSION['user_id']);
            
            // Pass the inquiries to the view
            $data = [
                'inquiries' => $inquiries
            ];
            
            require '../app/views/members/customerService.php';
        } catch (Exception $e) {
            $_SESSION['error'] = "Error retrieving inquiries: " . $e->getMessage();
            header('Location: /members');
            exit;
        }
    }

    public function submitInquiry() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: /members/customerService');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        $data = [
            'user_id' => $_SESSION['user_id'],
            'subject' => trim($_POST['subject']),
            'message' => trim($_POST['message'])
        ];

        // Validate
        if (empty($data['subject']) || empty($data['message'])) {
            $_SESSION['error'] = 'Please fill in all fields';
            header('Location: /members/customerService');
            exit;
        }

        // Save inquiry to database
        if ($this->member->submitInquiry($data)) {
            $_SESSION['success'] = 'Your inquiry has been submitted successfully';
        } else {
            $_SESSION['error'] = 'Something went wrong. Please try again.';
        }

        header('Location: /members/customerService');
        exit;
    }

    public function saving_acc() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }
    
        try {
            // Get pending registration data
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            // Check if user is an approved member
            if (!$pendingData || $pendingData['status'] !== 'approved') {
                $_SESSION['error_message'] = "Access denied. The saving account feature is only available for approved members.";
                header('Location: /members/profile');
                exit;
            }
    
            // Get saving account details
            $account = $this->member->getSavingAccount($pendingData['ic_no']);
            
            // Get transaction history
            $transactions = [];
            if ($account) {
                $transactions = $this->member->getTransactionHistory($account['id']);
            }
    
            // Get ALL approved loan applications
            $loan_applications = $this->loan->getAllApprovedLoans($_SESSION['user_id']);
            
            // Calculate total monthly installment
            $total_monthly_installment = 0;
            foreach ($loan_applications as $loan) {
                $total_monthly_installment += $loan['mon_installment'];
            }
    
            // Get saving account with potongan_gaji status
            $sql = "SELECT * FROM saving_accounts WHERE user_ic = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$pendingData['ic_no']]);
            $saving_account = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Format data for view
            $savings_account = (object)[
                'total_balance' => $account['balance'] ?? 0,
                'updated_at' => $account['updated_at'] ?? date('Y-m-d H:i:s'),
                'account_number' => $account['account_number'] ?? '-'
            ];
    
            // Format transactions for view
            $formattedTransactions = [];
            foreach ($transactions as $trans) {
                $formattedTransactions[] = (object)[
                    'request_date' => $trans['transaction_date'],
                    'transaction_type' => $trans['transaction_type'],
                    'amount' => $trans['amount'],
                    'status' => $trans['status'] ?? 'approved',
                    'remarks' => $trans['description'],
                    'transfer_purpose' => $trans['transfer_purpose'] ?? null,
                    'bank_name' => $trans['bank_name'] ?? null,
                    'bank_account' => $trans['bank_account'] ?? null
                ];
            }

            
            // Get transactions
            $sql = "SELECT 
                    t.id,
                    t.transaction_type,
                    t.amount,
                    t.payment_method,
                    t.bank_name,
                    t.bank_account,
                    t.transfer_purpose,
                    t.description,
                    t.status,
                    DATE_FORMAT(t.transaction_date, '%Y-%m-%d %H:%i:%s') as transaction_date,
                    t.admin_remark
                    FROM saving_transactions t 
                    WHERE t.account_id = ?
                    ORDER BY t.transaction_date DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$account['id']]);
            $transactions = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Format transactions
            foreach ($transactions as &$trans) {
                $trans->transaction_date = $trans->transaction_date ?? date('Y-m-d H:i:s');
                $trans->description = $trans->description ?? '';
                $trans->status = $trans->status ?? 'pending';
            }

            error_log("Formatted transactions: " . print_r($transactions, true));

            // Fetch pending member data with specific fields
            $pending_member = $this->member->getPendingRegisterMember($_SESSION['user_id']);
            
            // Debug to check values
            error_log('Pending Member Data: ' . print_r($pending_member, true));
            
            // Get payment dates
            $payment_dates = $this->member->getPaymentDates($_SESSION['user_id']);

            $viewData = [
                'savings_account' => $savings_account,
                'saving_account' => $saving_account,
                'transactions' => $transactions,
                'loan_applications' => $loan_applications,
                'total_monthly_installment' => $total_monthly_installment,
                'pending_member' => $pending_member,
                'payment_dates' => $payment_dates,
                'current_balance' => $account['balance'] ?? 0  // Add this line
            ];
            
            $this->view('members/saving_acc', $viewData);
    
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /dashboard');
            exit;
        }
    }
    // Add these methods for handling deposits and withdrawals
    public function deposit() {
        if (!isset($_SESSION['user_id']) || !isset($_POST['amount'])) {
            $_SESSION['error'] = "Invalid request";
            header('Location: /members/saving_acc');
            exit;
        }

        try {
            // Set timezone
            date_default_timezone_set('Asia/Kuala_Lumpur');

            // Debug log
            error_log("POST data received: " . print_r($_POST, true));

            // Get user's saving account
            $userIc = $this->member->getUserIc($_SESSION['user_id']);
            $savingAccount = $this->member->getSavingAccount($userIc);
            
            if (!$savingAccount) {
                throw new Exception("Saving account not found");
            }

            // Debug log
            error_log("Saving account found: " . print_r($savingAccount, true));

            // Store transaction details in session
            $_SESSION['pending_deposit'] = [
                'account_id' => $savingAccount['id'],
                'transaction_type' => 'deposit',
                'amount' => floatval($_POST['amount']),
                'payment_method' => $_POST['payment_method'],
                'description' => $_POST['remarks'] ?? '',
                'transaction_id' => 'TRX' . date('Ymd') . rand(1000, 9999),
                'timestamp' => (new DateTime())->format('Y-m-d H:i:s'),
                'current_balance' => $savingAccount['balance']
            ];

            // Debug log
            error_log("Session data set: " . print_r($_SESSION['pending_deposit'], true));

            // Get member details
            $memberData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            // Prepare view data
            $viewData = array_merge($_SESSION['pending_deposit'], [
                'member_name' => $memberData['name'],
                'member_number' => $memberData['member_number']
            ]);

            // Load confirmation page
            $this->view('members/confirm_deposit', $viewData);

        } catch (Exception $e) {
            error_log("Error in deposit: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }

    public function request_transfer() {
        // Debug log at the start
        error_log("POST data in request_transfer: " . print_r($_POST, true));

        if (!isset($_SESSION['user_id']) || !isset($_POST['amount'])) {
            $_SESSION['error'] = "Invalid request";
            header('Location: /members/saving_acc');
            exit;
        }

        try {
            // Set timezone
            date_default_timezone_set('Asia/Kuala_Lumpur');

            // Get user's saving account
            $userIc = $this->member->getUserIc($_SESSION['user_id']);
            $savingAccount = $this->member->getSavingAccount($userIc);
            
            if (!$savingAccount) {
                throw new Exception("Saving account not found");
            }

            // Store transaction details in session
            $_SESSION['pending_transfer'] = [
                'account_id' => $savingAccount['id'],
                'transaction_type' => 'transfer',
                'amount' => floatval($_POST['amount']),
                'bank_name' => $_POST['bank_name'],
                'bank_account' => $_POST['bank_account'],
                'transfer_purpose' => $_POST['purpose'],
                'description' => $_POST['remarks'] ?? '',
                'transaction_id' => 'TRF' . date('Ymd') . rand(1000, 9999),
                'timestamp' => (new DateTime())->format('Y-m-d H:i:s'),
                'current_balance' => $savingAccount['balance'],
                'status' => 'pending'
            ];

            // Debug log stored data
            error_log("Stored transfer data: " . print_r($_SESSION['pending_transfer'], true));

            // Get member details
            $memberData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            // Prepare view data
            $viewData = array_merge($_SESSION['pending_transfer'], [
                'member_name' => $memberData['name'],
                'member_number' => $memberData['member_number']
            ]);

            // Load confirmation page
            $this->view('members/confirm_transfer', $viewData);

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }

    /**
     * Handle balance update (deposit/withdrawal)
     */
    public function updateBalance() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        // Only accept POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = "Invalid request method";
            header('Location: /members/saving_acc');
            exit;
        }

        try {
            // Get user's IC number
            $userIc = $this->member->getUserIc($_SESSION['user_id']);
            
            if (!$userIc) {
                $_SESSION['error'] = "Access denied. This feature is only available for approved members.";
                header('Location: /members/saving_acc');
                exit;
            }

            // Validate input
            $accountId = filter_input(INPUT_POST, 'account_id', FILTER_VALIDATE_INT);
            $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            if (!$accountId || !$amount || !$type || !$description) {
                $_SESSION['error'] = "Please fill in all required fields correctly";
                header('Location: /members/saving_acc');
                exit;
            }

            // Validate amount
            if ($amount <= 0) {
                $_SESSION['error'] = "Amount must be greater than zero";
                header('Location: /members/saving_acc');
                exit;
            }

            // Validate transaction type
            if (!in_array($type, ['deposit', 'withdrawal'])) {
                $_SESSION['error'] = "Invalid transaction type";
                header('Location: /members/saving_acc');
                exit;
            }

            // Verify account ownership
            $account = $this->member->getSavingAccount($userIc);
            if (!$account || $account['id'] != $accountId) {
                $_SESSION['error'] = "Invalid account access";
                header('Location: /members/saving_acc');
                exit;
            }

            // For withdrawals, check if sufficient balance
            if ($type === 'withdrawal') {
                if (!$this->member->validateTransaction($accountId, $amount, $type)) {
                    $_SESSION['error'] = "Insufficient funds for withdrawal";
                    header('Location: /members/saving_acc');
                    exit;
                }
            }

            // Process the transaction
            $success = $this->member->processTransaction(
                $accountId,
                $type,
                $amount,
                $description
            );

            if ($success) {
                $_SESSION['success'] = ucfirst($type) . " processed successfully";
            } else {
                $_SESSION['error'] = "Failed to process " . $type;
            }

        } catch (Exception $e) {
            error_log("Error in updateBalance: " . $e->getMessage());
            $_SESSION['error'] = "An error occurred while processing your request";
        }

        header('Location: /members/saving_acc');
        exit;
    }

    public function editProfile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            // Get pending registration data
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            if ($pendingData) {
                // Get family members
                $pendingData['family_members'] = $this->member->getFamilyMembers($pendingData['ic_no']);
            }

            $this->view('members/edit_profile', [
                'pendingData' => $pendingData
            ]);
        } catch (\Exception $e) {
            error_log("Error in editProfile: " . $e->getMessage());
            $_SESSION['error'] = 'Error loading profile data';
            header('Location: /members/profile');
            exit;
        }
    }

    public function updateProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit();
        }

        try {
            // Debug log the incoming data
            error_log("Updating profile with data: " . print_r($_POST, true));

            $result = $this->member->updateProfile($_POST, $_SESSION['user_id']);

            if ($result) {
                $_SESSION['success'] = 'Profile updated successfully';
                echo json_encode(['status' => 'success']);
            } else {
                throw new \Exception("Failed to update profile");
            }

        } catch (\Exception $e) {
            error_log("Error in updateProfile: " . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function viewFinancialReport() {
        try {
            $userId = $_SESSION['user_id'] ?? null;
            $reportType = $_POST['report_type'] ?? '';
            $selectedMonth = $_POST['selected_month'] ?? '';
            $selectedYear = $_POST['selected_year'] ?? '';
            $startDate = $_POST['start_date'] ?? '';
            $endDate = $_POST['end_date'] ?? '';
            $transactionType = $_POST['transaction_type'] ?? 'all';
            $loanType = $_POST['loan_type'] ?? 'all';

            if (!$userId) {
                throw new Exception("User ID not found");
            }

            // Debug incoming data
            error_log("Incoming data - Report Type: $reportType");
            error_log("Incoming data - Start Date: $startDate");
            error_log("Incoming data - End Date: $endDate");
            error_log("Incoming data - Selected Month: $selectedMonth");
            error_log("Incoming data - Selected Year: $selectedYear");

            // Validate and format dates based on report type
            switch($reportType) {
                case 'custom':
                    if (empty($startDate) || empty($endDate)) {
                        // Set default date range to current month if not provided
                        $startDate = date('Y-m-01');
                        $endDate = date('Y-m-t');
                    } else {
                        // Ensure dates are in correct format
                        $startDate = date('Y-m-d', strtotime($startDate));
                        $endDate = date('Y-m-d', strtotime($endDate));
                    }
                    
                    // Validate date range
                    if (strtotime($endDate) < strtotime($startDate)) {
                        throw new Exception("End date must be after start date");
                    }
                    break;

                case 'monthly':
                    if (empty($selectedMonth)) {
                        $selectedMonth = date('Y-m');
                    }
                    $startDate = date('Y-m-01', strtotime($selectedMonth));
                    $endDate = date('Y-m-t', strtotime($selectedMonth));
                    break;

                case 'yearly':
                    if (empty($selectedYear)) {
                        $selectedYear = date('Y');
                    }
                    $startDate = $selectedYear . '-01-01';
                    $endDate = $selectedYear . '-12-31';
                    break;

                default:
                    // Default to current month if no valid report type
                    $startDate = date('Y-m-01');
                    $endDate = date('Y-m-t');
                    $reportType = 'monthly';
                    $selectedMonth = date('Y-m');
            }

            // Debug formatted dates
            error_log("Formatted dates - Start: $startDate, End: $endDate");

            // Get member data
            $memberQuery = "SELECT * FROM pendingregistermember WHERE user_id = ? AND status = 'approved'";
            $stmt = $this->db->prepare($memberQuery);
            $stmt->execute([$userId]);
            $memberData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$memberData) {
                throw new Exception("Member data not found");
            }

            // Store member info separately
            $memberInfo = [
                'user_id' => $memberData['member_number'], // Changed from userId to member_number
                'name' => $memberData['name'],
                'ic_no' => $memberData['ic_no'],
                'pf_number' => $memberData['pf_number']
            ];

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
                ORDER BY p.created_at DESC LIMIT 1";

            $stmt = $this->db->prepare($accountQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $accountData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$accountData) {
                $account = (object)[
                    'share_capital' => 0,
                    'fee_capital' => 0,
                    'fixed_deposit' => 0,
                    'balance' => 0
                ];
            } else {
                $memberCreatedDate = date('Y-m-d', strtotime($accountData['member_created_at']));
                
                // Determine the end date of the report period
                $reportEndDate = '';
                if ($reportType === 'monthly' && $selectedMonth) {
                    $reportEndDate = date('Y-m-t', strtotime($selectedMonth . '-01'));
                } elseif ($reportType === 'yearly' && $selectedYear) {
                    $reportEndDate = $selectedYear . '-12-31';
                } elseif ($reportType === 'custom') {
                    $reportEndDate = $endDate;
                }

                // Check if the report period includes or comes after member registration
                if ($reportEndDate >= $memberCreatedDate) {
                    $account = (object)[
                        'share_capital' => $accountData['share_capital'] ?? 0,
                        'fee_capital' => $accountData['fee_capital'] ?? 0,
                        'fixed_deposit' => $accountData['fixed_deposit'] ?? 0,
                        'balance' => $accountData['balance'] ?? 0
                    ];
                } else {
                    $account = (object)[
                        'share_capital' => 0,
                        'fee_capital' => 0,
                        'fixed_deposit' => 0,
                        'balance' => 0
                    ];
                }
            }

            // Update the loan applications query
            $loanApplicationsQuery = "
                SELECT 
                    id,
                    loan_type,
                    t_amount,
                    period,
                    mon_installment,
                    status,
                    created_at,
                    admin_remark
                FROM loan_applications 
                WHERE user_id = :userId
                AND (UPPER(status) = 'APPROVED' OR LOWER(status) = 'approved')
            ";

            // Add date filtering conditions
            if ($reportType === 'monthly' && $selectedMonth) {
                $loanApplicationsQuery .= " AND DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth";
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $loanApplicationsQuery .= " AND YEAR(created_at) = :selectedYear";
            } elseif ($reportType === 'custom' && $startDate && $endDate) {
                $loanApplicationsQuery .= " AND DATE(created_at) BETWEEN :startDate AND :endDate";
            }

            // Add loan type filter if specified
            if ($loanType !== 'all') {
                $loanApplicationsQuery .= " AND loan_type = :loanType";
            }

            $loanApplicationsQuery .= " ORDER BY created_at DESC";

            // Debug logging
            error_log("Loan Query: " . $loanApplicationsQuery);
            error_log("User ID: " . $userId);
            error_log("Selected Month: " . $selectedMonth);
            error_log("Loan Type: " . $loanType);

            $stmt = $this->db->prepare($loanApplicationsQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            if ($reportType === 'monthly' && $selectedMonth) {
                $stmt->bindParam(':selectedMonth', $selectedMonth);
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $stmt->bindParam(':selectedYear', $selectedYear);
            } elseif ($reportType === 'custom' && $startDate && $endDate) {
                $stmt->bindParam(':startDate', $startDate);
                $stmt->bindParam(':endDate', $endDate);
            }

            if ($loanType !== 'all') {
                $stmt->bindParam(':loanType', $loanType);
            }

            $stmt->execute();
            $loanApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Debug the results
            error_log("Found loans: " . json_encode($loanApplications));

            // Calculate loan totals for each type
            $loanData = [
                'Pembiayaan_Al_Bai' => 0,
                'Pembiayaan_Al_Innah' => 0,
                'Pembiayaan_RoadTaxInsuran' => 0,
                'Pembiayaan_Skim_Khas' => 0,
                'Pembiayaan_Membaikpulih_Kenderaan' => 0,
                'Pembiayaan_Al_Qardhul_Hasan' => 0
            ];

            foreach ($loanApplications as $loan) {
                if (isset($loanData[$loan['loan_type']])) {
                    $loanData[$loan['loan_type']] += $loan['t_amount'];
                }
            }

            // Get transaction history
            $transactionQuery = "
                SELECT 
                    st.*,
                    sa.account_number
                FROM saving_transactions st
                JOIN saving_accounts sa ON st.account_id = sa.id
                JOIN pendingregistermember p ON sa.user_ic = p.ic_no
                WHERE p.user_id = :userId
            ";

            // Add date filtering conditions for transactions
            if ($reportType === 'monthly' && $selectedMonth) {
                $transactionQuery .= " AND DATE_FORMAT(st.transaction_date, '%Y-%m') = :selectedMonth";
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $transactionQuery .= " AND YEAR(st.transaction_date) = :selectedYear";
            } elseif ($reportType === 'custom' && $startDate && $endDate) {
                $transactionQuery .= " AND DATE(st.transaction_date) BETWEEN :startDate AND :endDate";
            }

            // Add transaction type filter if specified
            if ($transactionType !== 'all') {
                $transactionQuery .= " AND st.transaction_type = :transactionType";
            }

            $transactionQuery .= " ORDER BY st.transaction_date DESC";

            $stmt = $this->db->prepare($transactionQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            if ($reportType === 'monthly' && $selectedMonth) {
                $stmt->bindParam(':selectedMonth', $selectedMonth);
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $stmt->bindParam(':selectedYear', $selectedYear);
            } elseif ($reportType === 'custom' && $startDate && $endDate) {
                $stmt->bindParam(':startDate', $startDate);
                $stmt->bindParam(':endDate', $endDate);
            }

            if ($transactionType !== 'all') {
                $stmt->bindParam(':transactionType', $transactionType);
            }

            $stmt->execute();
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Format transactions for display
            $formattedTransactions = array_map(function($transaction) {
                return [
                    'date' => date('d/m/Y', strtotime($transaction['transaction_date'])),
                    'type' => $this->translateTransactionType($transaction['transaction_type']),
                    'amount' => number_format($transaction['amount'], 2),
                    'description' => $transaction['description'],
                    'status' => $this->translateStatus($transaction['status']),
                    'payment_method' => $transaction['payment_method'],
                    'account_number' => $transaction['account_number']
                ];
            }, $transactions);

            // Enhanced view data with loan information
            $viewData = [
                'member' => (object)$memberInfo,
                'account' => $account,
                'loans' => (object)[
                    'Pembiayaan_Al_Bai' => $loanData['Pembiayaan_Al_Bai'],
                    'Pembiayaan_Al_Innah' => $loanData['Pembiayaan_Al_Innah'],
                    'Pembiayaan_RoadTaxInsuran' => $loanData['Pembiayaan_RoadTaxInsuran'],
                    'Pembiayaan_Skim_Khas' => $loanData['Pembiayaan_Skim_Khas'],
                    'Pembiayaan_Al_Qardhul_Hasan' => $loanData['Pembiayaan_Al_Qardhul_Hasan'],
                    'Pembiayaan_Membaikpulih_Kenderaan' => $loanData['Pembiayaan_Membaikpulih_Kenderaan']
                ],
                'transactions' => $formattedTransactions,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
                'reportType' => $reportType,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'displayDate' => $this->formatDate($startDate, $endDate),
                'loanApplications' => $loanApplications,
                'transactionType' => $transactionType,
                'loanType' => $loanType
            ];

            // Debug log
            error_log("View Data - Start Date: " . ($startDate ?? 'null') . ", End Date: " . ($endDate ?? 'null'));
            error_log("View Data - Report Type: " . ($reportType ?? 'null'));

            // Pass all data to the view
            $this->view('members/financial_report', $viewData);

        } catch (Exception $e) {
            error_log("Error in viewFinancialReport: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }
    // Helper functions for translation
    private function translateTransactionType($type) {
        $translations = [
            'deposit' => 'Deposit',
            'withdrawal' => 'Pengeluaran',
            'transfer' => 'Pemindahan'
        ];
        return $translations[$type] ?? $type;
    }

    private function translateStatus($status) {
        $translations = [
            'pending' => 'Menunggu',
            'approved' => 'Diluluskan',
            'rejected' => 'Ditolak'
        ];
        return $translations[$status] ?? $status;
    }

    public function confirmDeposit() {
        if (!isset($_SESSION['pending_deposit'])) {
            $_SESSION['error'] = "No pending deposit found";
            header('Location: /members/saving_acc');
            exit;
        }

        try {
            $depositData = $_SESSION['pending_deposit'];
            
            // Debug log
            error_log("Confirming deposit with session data: " . print_r($depositData, true));
            
            // Verify required fields
            $requiredFields = ['account_id', 'amount', 'payment_method', 'description'];
            foreach ($requiredFields as $field) {
                if (!isset($depositData[$field])) {
                    throw new Exception("Missing required field: " . $field);
                }
            }

            // Process the deposit
            $result = $this->processDeposit($depositData);

            if ($result) {
                $_SESSION['success'] = "Deposit telah berjaya diproses";
                unset($_SESSION['pending_deposit']); // Clear the pending deposit
            } else {
                throw new Exception("Failed to process deposit");
            }

            header('Location: /members/saving_acc');
            exit;

        } catch (Exception $e) {
            error_log("Error in confirmDeposit: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }

    public function confirmTransfer() {
        if (!isset($_SESSION['pending_transfer'])) {
            $_SESSION['error'] = "No pending transfer found";
            header('Location: /members/saving_acc');
            exit;
        }

        try {
            $transferData = $_SESSION['pending_transfer'];
            
            // Process the transfer
            $result = $this->processTransfer($transferData);

            if ($result) {
                $_SESSION['success'] = "Permohonan pindahan telah berjaya dihantar";
                unset($_SESSION['pending_transfer']); // Clear the pending transfer
            } else {
                throw new Exception("Failed to process transfer request");
            }

            header('Location: /members/saving_acc');
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }

    private function processDeposit($data) {
        try {
            $this->db->beginTransaction();

            // Insert transaction record
            $sql = "INSERT INTO saving_transactions (
                account_id, 
                transaction_type,
                amount,
                payment_method,
                deposit_bank,
                card_type,
                description,
                status,
                transaction_date
            ) VALUES (
                :account_id,
                'deposit',
                :amount,
                :payment_method,
                :deposit_bank,
                :card_type,
                :description,
                'approved',
                NOW()
            )";

            $params = [
                ':account_id' => $data['account_id'],
                ':amount' => $data['amount'],
                ':payment_method' => $data['payment_method'],
                ':deposit_bank' => $data['deposit_bank'] ?? null,
                ':card_type' => $data['card_type'] ?? null,
                ':description' => $data['description'] ?? ''
            ];

            $stmt = $this->db->prepare($sql);
            $insertResult = $stmt->execute($params);

            // Update account balance
            if ($insertResult) {
                $updateSql = "UPDATE saving_accounts 
                             SET balance = balance + :amount,
                                 updated_at = NOW()
                             WHERE id = :account_id";
                
                $updateStmt = $this->db->prepare($updateSql);
                $updateResult = $updateStmt->execute([
                    ':amount' => $data['amount'],
                    ':account_id' => $data['account_id']
                ]);

                if ($updateResult) {
                    $this->db->commit();
                    return true;
                }
            }

            $this->db->rollBack();
            return false;

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new Exception("Database error while processing deposit");
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    private function processTransfer($data) {
        try {
            $sql = "INSERT INTO saving_transactions (
                account_id, 
                transaction_type,
                amount,
                bank_name,
                bank_account,
                transfer_purpose,
                description,
                status,
                transaction_date
            ) VALUES (
                :account_id,
                'transfer',
                :amount,
                :bank_name,
                :bank_account,
                :transfer_purpose,
                :description,
                'pending',
                NOW()
            )";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':account_id' => $data['account_id'],
                ':amount' => $data['amount'],
                ':bank_name' => $data['bank_name'],
                ':bank_account' => $data['bank_account'],
                ':transfer_purpose' => $data['transfer_purpose'],
                ':description' => $data['description'] ?? ''
            ]);

        } catch (PDOException $e) {
            throw new Exception("Database error while processing transfer request");
        }
    }

    public function info() {
        $this->view('users/info');
    }

    public function generateReceipt($transaction_id) {
        try {
            // Set timezone to Malaysia
            date_default_timezone_set('Asia/Kuala_Lumpur');
            
            // Get transaction details
            $sql = "SELECT 
                    t.*,
                    m.name as member_name,
                    m.member_number
                    FROM saving_transactions t 
                    JOIN saving_accounts sa ON t.account_id = sa.id
                    JOIN pendingregistermember m ON sa.user_ic = m.ic_no
                    WHERE t.id = ? AND t.status = 'approved'";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$transaction_id]);
            $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$transaction) {
                throw new Exception("Transaction not found or not approved");
            }

            // Format receipt number: RES/YEAR/MONTH/ID (e.g., RES/2024/03/001)
            $receiptNo = sprintf(
                "RES/%s/%s/%03d",
                date('Y'),
                date('m'),
                $transaction['id']
            );

            // Create PDF
            require_once(__DIR__ . '/../../fpdf/fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();

            // Header
            // Get the logo path relative to the script
            $logoPath = __DIR__ . '/../../public/images/logo.jpg';
            if (file_exists($logoPath)) {
                $pdf->Image($logoPath, 10, 10, 30);
            }

            // Company details (adjusted position)
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'KOPERASI KADA', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 6, 'Lembaga Kemajuan Pertanian Kemubu', 0, 1, 'C');
            $pdf->Cell(0, 6, 'Peti Surat 127, Bandar Kota Bharu,', 0, 1, 'C');
            $pdf->Cell(0, 6, '15710 Kota Bharu,Kelantan', 0, 1, 'C');
            $pdf->Cell(0, 6, 'Tel: +60 97455388', 0, 1, 'C');
            $pdf->Ln(10);

            // Receipt Title
            $pdf->SetFont('Arial', 'B', 14);
            $title = $transaction['transaction_type'] == 'deposit' ? 'RESIT DEPOSIT' : 'RESIT PINDAHAN WANG';
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(5);

            // Transaction Details
            $pdf->SetFont('Arial', '', 10);
            
            // Common details
            $details = [
                'No. Resit' => $receiptNo,
                'Tarikh' => date('d/m/Y h:i A', strtotime($transaction['transaction_date'])),
                'Nama Ahli' => $transaction['member_name'],
                'No. Ahli' => $transaction['member_number'],
                'Jumlah' => 'RM ' . number_format($transaction['amount'], 2)
            ];

            // Add specific details based on transaction type
            if ($transaction['transaction_type'] == 'deposit') {
                // Format payment method display
                $paymentMethod = $transaction['payment_method'] === 'fpx' ? 'FPX Online Banking' : 
                               ($transaction['payment_method'] === 'card' ? 'Kredit/Debit Kad' : 
                               $transaction['payment_method']);
                
                $details['Kaedah Pembayaran'] = $paymentMethod;
    
                // Add bank details only for FPX
                if ($transaction['payment_method'] === 'fpx' && !empty($transaction['deposit_bank'])) {
                    $details['Bank'] = $transaction['deposit_bank'];
                }
                
                // Add card type only for card payments
                if ($transaction['payment_method'] === 'card' && !empty($transaction['card_type'])) {
                    $details['Jenis Kad'] = $transaction['card_type'];
                }

            } else {
                $details['Bank'] = $transaction['bank_name'];
                $details['No. Akaun Bank'] = $transaction['bank_account'];
                $details['Tujuan Pindahan'] = $transaction['transfer_purpose'];
            }

            if ($transaction['description']) {
                $details['Catatan'] = $transaction['description'];
            }

            // Print details
            foreach ($details as $label => $value) {
                $pdf->Cell(50, 8, $label . ':', 0);
                $pdf->Cell(0, 8, $value, 0);
                $pdf->Ln();
            }

            // Footer
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'I', 8);
            $pdf->Cell(0, 5, 'Terima kasih atas transaksi anda.', 0, 1, 'C');
            $pdf->Cell(0, 5, 'Resit ini dijana secara komputer dan tidak memerlukan tandatangan.', 0, 1, 'C');
            $pdf->Cell(0, 5, 'Dicetak pada: ' . date('d/m/Y h:i:s A'), 0, 1, 'C');

            // Output PDF
            $pdf->Output('D', 'Receipt_' . $transaction['id'] . '.pdf');

        } catch (Exception $e) {
            error_log("Error generating receipt: " . $e->getMessage());
            $_SESSION['error'] = "Error generating receipt: " . $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }

    public function m_info() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /users/info');
            exit;
        }

        try {
            // Get pending registration data for the user
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            $viewData = [
                'pendingData' => $pendingData  // This is what was missing
            ];
            
            $this->view('members/m_info', $viewData);
        } catch (Exception $e) {
            error_log("Error in m_info: " . $e->getMessage());
            $_SESSION['error'] = "Error retrieving information";
            header('Location: /members');
            exit;
        }
    }

    public function m_loanCalc() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /users/loan_calculator');
            exit;
        }

        try {
            // Get pending registration data for the user
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            $viewData = [
                'pendingData' => $pendingData  // Add this to show username
            ];
            
            $this->view('members/m_loanCalc', $viewData);
        } catch (Exception $e) {
            error_log("Error in m_loanCalc: " . $e->getMessage());
            $_SESSION['error'] = "Error retrieving information";
            header('Location: /members');
            exit;
        }
    }

    public function checkProfileStatus() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'not_logged_in']);
            exit;
        }

        try {
            // Get pending registration data
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            if (!$pendingData) {
                echo json_encode(['status' => 'not_registered']);
            } else {
                echo json_encode(['status' => $pendingData['status']]);
            }
        } catch (\Exception $e) {
            error_log("Error checking profile status: " . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function confirm_payment() {
        try {
            // Get pending member data
            $pending_member = $this->member->getPendingRegisterMember($_SESSION['user_id']);
            
            // Get user's IC
            $userIc = $this->member->getUserIc($_SESSION['user_id']);
            
            if (!$userIc) {
                throw new Exception("User IC not found");
            }

            // Get saving account details
            $savings_account = $this->member->getSavingAccount($userIc);
            
            if (!$savings_account) {
                throw new Exception("Saving account not found");
            }
            
            // Calculate total amount based on account status
            if ($savings_account['status'] === 'complete') {
                // Only monthly fees for completed accounts
                $total_amount = ($pending_member['fee_capital'] ?? 50) +
                              ($pending_member['welfare_fund'] ?? 5) +
                              ($pending_member['fixed_deposit'] ?? 50);
            } else {
                // All fees for new registration
                $total_amount = ($pending_member['registration_fee'] ?? 35) +
                              ($pending_member['share_capital'] ?? 300) +
                              ($pending_member['deposit_funds'] ?? 20) +
                              ($pending_member['fee_capital'] ?? 50) +
                              ($pending_member['welfare_fund'] ?? 5) +
                              ($pending_member['fixed_deposit'] ?? 50);
            }

            $data = [
                'pending_member' => $pending_member,
                'total_amount' => $total_amount,
                'savings_account' => $savings_account
            ];

            $this->view('members/confirm_payment', $data);
            
        } catch (Exception $e) {
            error_log("Error in confirm_payment: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }

    public function process_payment() {
        try {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                throw new Exception('Invalid CSRF token');
            }

            $userId = $_SESSION['user_id'];
            $paymentMethod = $_POST['paymentMethod'];

            // Get additional payment details based on payment method
            $depositBank = null;
            $cardType = null;
            
            if ($paymentMethod === 'fpx') {
                $depositBank = $_POST['bank_name'] ?? null;
                if (empty($depositBank)) {
                    throw new Exception('Sila pilih bank untuk pembayaran FPX');
                }
            } elseif ($paymentMethod === 'card') {
                $cardType = $_POST['card_type'] ?? null;
                if (empty($cardType)) {
                    throw new Exception('Sila pilih jenis kad');
                }
            }

            // Get user's IC
            $stmt = $this->db->prepare("SELECT ic_no FROM pendingregistermember WHERE user_id = ?");
            $stmt->execute([$userId]);
            $userIc = $stmt->fetchColumn();

            if (!$userIc) {
                throw new Exception('User not found');
            }

            // Get saving account status
            $stmt = $this->db->prepare("SELECT id, status FROM saving_accounts WHERE user_ic = ?");
            $stmt->execute([$userIc]);
            $savingAccount = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$savingAccount) {
                throw new Exception('Saving account not found');
            }

            // Get pending member data
            $stmt = $this->db->prepare("SELECT * FROM pendingregistermember WHERE user_id = ?");
            $stmt->execute([$userId]);
            $memberData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Start transaction
            $this->db->beginTransaction();

            // Calculate amounts and create transactions based on account status
            if ($savingAccount['status'] === 'pending') {
                // First-time payment: Create separate transactions for each fee
                $transactions = [
                    [
                        'type' => 'registration',
                        'amount' => $memberData['registration_fee'] ?? 35,
                        'description' => 'Yuran Pendaftaran'
                    ],
                    [
                        'type' => 'share',
                        'amount' => $memberData['share_capital'] ?? 300,
                        'description' => 'Modal Saham'
                    ],
                    [
                        'type' => 'deposit',
                        'amount' => $memberData['deposit_funds'] ?? 20,
                        'description' => 'Modal Deposit'
                    ],
                    [
                        'type' => 'fee',
                        'amount' => $memberData['fee_capital'] ?? 50,
                        'description' => 'Modal Yuran'
                    ],
                    [
                        'type' => 'welfare',
                        'amount' => $memberData['welfare_fund'] ?? 5,
                        'description' => 'Tabung Kebajikan'
                    ],
                    [
                        'type' => 'deposit',
                        'amount' => $memberData['fixed_deposit'] ?? 50,
                        'description' => 'Simpanan Tetap'
                    ]
                ];

                // Only deposit_funds and fixed_deposit go into saving account balance
                $deposit_amount = ($memberData['deposit_funds'] ?? 20) + 
                                ($memberData['fixed_deposit'] ?? 50);
            } else {
                // Monthly payments: Create transactions for monthly fees
                $transactions = [
                    [
                        'type' => 'fee',
                        'amount' => $memberData['fee_capital'] ?? 50,
                        'description' => 'Modal Yuran Bulanan'
                    ],
                    [
                        'type' => 'welfare',
                        'amount' => $memberData['welfare_fund'] ?? 5,
                        'description' => 'Tabung Kebajikan Bulanan'
                    ],
                    [
                        'type' => 'deposit',
                        'amount' => $memberData['fixed_deposit'] ?? 50,
                        'description' => 'Simpanan Tetap Bulanan'
                    ]
                ];

                // For monthly payments, only Simpanan Tetap goes into the account balance
                $deposit_amount = $memberData['fixed_deposit'] ?? 50;
            }

            // Update saving account balance and status
            $stmt = $this->db->prepare("UPDATE saving_accounts 
                                       SET balance = balance + ?,
                                           status = 'complete'
                                       WHERE user_ic = ?");
            $success = $stmt->execute([$deposit_amount, $userIc]);

            if (!$success) {
                throw new Exception('Failed to update account balance');
            }

            // Insert all transactions
            $stmt = $this->db->prepare("INSERT INTO saving_transactions (
                account_id, 
                transaction_type, 
                amount, 
                payment_method, 
                deposit_bank,
                card_type, 
                description,
                status, 
                transaction_date
            ) VALUES (?, ?, ?, ?, ?, ?, ?, 'approved', NOW())");

            foreach ($transactions as $transaction) {
                $success = $stmt->execute([
                    $savingAccount['id'],
                    $transaction['type'],
                    $transaction['amount'],
                    $paymentMethod,
                    $depositBank,
                    $cardType,
                    $transaction['description']
                ]);

                if (!$success) {
                    throw new Exception('Failed to record transaction: ' . $transaction['description']);
                }
            }

            $this->db->commit();

            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
    public function generateFinancialReport() {
        try {
            // Debug incoming data
            error_log("POST data: " . print_r($_POST, true));
            
            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                throw new Exception("User not logged in");
            }

            // Validate report_type
            $reportType = $_POST['report_type'] ?? '';
            if (!in_array($reportType, ['monthly', 'yearly', 'custom'])) {
                error_log("Invalid report type: " . $reportType . ". Defaulting to monthly.");
                $reportType = 'monthly';
            }

            $selectedMonth = $_POST['selected_month'] ?? '';
            $selectedYear = $_POST['selected_year'] ?? '';
            $selectedLoanType = $_POST['loan_type'] ?? 'all';

            // Get member data
            $memberQuery = "SELECT p.*, u.id as user_id 
                           FROM pendingregistermember p 
                           JOIN users u ON p.user_id = u.id 
                           WHERE p.user_id = ? AND p.status = 'approved'";
            $stmt = $this->db->prepare($memberQuery);
            $stmt->execute([$userId]);
            $member = $stmt->fetch(PDO::FETCH_OBJ);

            error_log("Member data: " . print_r($member, true));

            if (!$member) {
                throw new Exception("Member record not found");
            }

            // Set date range
            $reportDate = date('Y-m-d');
            $startDate = null;
            $endDate = null;

            switch ($reportType) {
                case 'monthly':
                    $startDate = $selectedMonth ? $selectedMonth . '-01' : date('Y-m-01');
                    $endDate = date('Y-m-t', strtotime($startDate));
                    break;
                case 'yearly':
                    $startDate = $selectedYear ? $selectedYear . '-01-01' : date('Y-01-01');
                    $endDate = $selectedYear ? $selectedYear . '-12-31' : date('Y-12-31');
                    break;
                case 'custom':
                    $startDate = $_POST['start_date'] ?? date('Y-m-01');
                    $endDate = $_POST['end_date'] ?? date('Y-m-t');
                    break;
            }

            // Get loan details with type filter
            $loanQuery = "SELECT 
                            loan_type,
                            SUM(t_amount) as loan_amount
                         FROM loan_applications 
                         WHERE user_id = ? 
                         AND status = 'APPROVED'
                         AND DATE(created_at) BETWEEN ? AND ?";
            
            $params = [$userId, $startDate, $endDate];
            
            if ($selectedLoanType !== 'all') {
                $loanQuery .= " AND loan_type = ?";
                $params[] = $selectedLoanType;
            }
            
            $loanQuery .= " GROUP BY loan_type";
            
            $stmt = $this->db->prepare($loanQuery);
            $stmt->execute($params);
            $loanDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

            $savingsBalance = $this->getCurrentSavingsBalance($userId);

            // Insert financial report record
            if (!empty($loanDetails)) {
                foreach ($loanDetails as $loan) {
                    $insertQuery = "INSERT INTO financial_report (
                        user_id, report_type, report_date, start_date, end_date,
                        share_capital, fee_capital, fixed_deposit, savings_balance,
                        loan_type, loan_amount
                    ) VALUES (
                        :userId, :reportType, :reportDate, :startDate, :endDate,
                        :shareCapital, :feeCapital, :fixedDeposit, :savingsBalance,
                        :loanType, :loanAmount
                    )";

                    $stmt = $this->db->prepare($insertQuery);
                    $result = $stmt->execute([
                        'userId' => $userId,
                        'reportType' => $reportType,
                        'reportDate' => $reportDate,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'shareCapital' => $member->share_capital ?? 0,
                        'feeCapital' => $member->fee_capital ?? 0,
                        'fixedDeposit' => $member->fixed_deposit ?? 0,
                        'savingsBalance' => $savingsBalance,
                        'loanType' => $loan->loan_type,
                        'loanAmount' => $loan->loan_amount
                    ]);

                    if (!$result) {
                        error_log("Database error: " . print_r($stmt->errorInfo(), true));
                        throw new Exception("Failed to save report");
                    }
                }
            } else {
                // Insert a record even if no loans found
                $insertQuery = "INSERT INTO financial_report (
                    user_id, report_type, report_date, start_date, end_date,
                    share_capital, fee_capital, fixed_deposit, savings_balance,
                    loan_type, loan_amount
                ) VALUES (
                    :userId, :reportType, :reportDate, :startDate, :endDate,
                    :shareCapital, :feeCapital, :fixedDeposit, :savingsBalance,
                    :loanType, :loanAmount
                )";

                $stmt = $this->db->prepare($insertQuery);
                $result = $stmt->execute([
                    'userId' => $userId,
                    'reportType' => $reportType,
                    'reportDate' => $reportDate,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'shareCapital' => $member->share_capital ?? 0,
                    'feeCapital' => $member->fee_capital ?? 0,
                    'fixedDeposit' => $member->fixed_deposit ?? 0,
                    'savingsBalance' => $savingsBalance,
                    'loanType' => $selectedLoanType,
                    'loanAmount' => 0
                ]);
            }

            // Generate and output PDF
            require_once '../fpdf/generatePDF.php';

        } catch (Exception $e) {
            error_log("Error generating financial report: " . $e->getMessage());
            $_SESSION['error'] = "Error generating report: " . $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
    }
    private function getLoanDetails($userId, $selectedMonth, $selectedYear) {
        $query = "SELECT 
                    loan_type,
                    SUM(t_amount) as loan_amount
                  FROM loan_applications 
                  WHERE user_id = ? 
                  AND status = 'APPROVED'";
        $params = [$userId];

        if ($selectedMonth) {
            $query .= " AND DATE_FORMAT(created_at, '%Y-%m') = ?";
            $params[] = $selectedMonth;
        } elseif ($selectedYear) {
            $query .= " AND YEAR(created_at) = ?";
            $params[] = $selectedYear;
        }

        $query .= " GROUP BY loan_type";

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function getCurrentSavingsBalance($userId) {
        $query = "SELECT balance FROM saving_accounts 
                  WHERE user_ic = (SELECT ic_no FROM pendingregistermember WHERE user_id = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_OBJ)->balance ?? 0;
    }

    private function formatDate($startDate, $endDate) {
        if (empty($startDate) || empty($endDate)) {
            return date('F Y');
        }
        
        if ($startDate === $endDate) {
            return date('d F Y', strtotime($startDate));
        }
        
        return date('d/m/Y', strtotime($startDate)) . ' - ' . date('d/m/Y', strtotime($endDate));
    }

    private function validateCardPayment($data) {
        if (empty($data['cardType']) || empty($data['cardNumber']) || 
            empty($data['expiryDate']) || empty($data['cvv']) || 
            empty($data['cardHolder'])) {
            throw new Exception('Sila lengkapkan semua maklumat kad');
        }
        // Add more card validation if needed
    }

    private function validateBankingPayment($data) {
        if (empty($data['bankType']) || empty($data['accountNumber'])) {
            throw new Exception('Sila lengkapkan semua maklumat bank');
        }
        // Add more bank validation if needed
    }

    public function payment_success() {
        $this->view('members/payment_success');
    }

    public function profile_saving_acc() {
        $this->view('members/saving_acc');
    }

    public function termination()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $memberModel = new Member();
        $member = $memberModel->findByUserId($_SESSION['user_id']);

        if (!$member) {
            $_SESSION['error'] = 'Member not found';
            header('Location: /members/profile');
            exit();
        }

        $existingRequest = $memberModel->getTerminationRequest($member['ic_no']);
        if ($existingRequest && $existingRequest['status'] === 'pending') {
            $_SESSION['error'] = 'Anda telah mempunyai permohonan penamatan yang masih dalam proses.';
            header('Location: /members/profile');
            exit();
        }

        $this->view('members/termination_form', ['member' => $member]);
    }

    public function submitTermination()
    {
        try {
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                throw new Exception('Sila log masuk untuk meneruskan.');
            }

            // Validate request method
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Kaedah permintaan tidak sah.');
            }

            // Validate required fields
            if (empty($_POST['ic_no']) || empty($_POST['reason'])) {
                throw new Exception('Sila isi semua maklumat yang diperlukan.');
            }

            // Get member data
            $memberModel = new Member();
            $member = $memberModel->findByUserId($_SESSION['user_id']);

            if (!$member) {
                throw new Exception('Maklumat ahli tidak dijumpai.');
            }

            // Verify IC number matches
            if ($member['ic_no'] !== $_POST['ic_no']) {
                throw new Exception('Nombor IC tidak sepadan.');
            }

            // Check for existing pending request
            $existingRequest = $memberModel->getTerminationRequest($_POST['ic_no']);
            if ($existingRequest && $existingRequest['status'] === 'pending') {
                throw new Exception('Anda telah mempunyai permohonan penamatan yang masih dalam proses.');
            }

            // Prepare data for submission
            $terminationData = [
                'ic_no' => $_POST['ic_no'],
                'reason' => $_POST['reason'],
                'reason_details' => $_POST['reason_details'] ?? null,
                'declaration' => isset($_POST['declaration']) ? 1 : 0
            ];

            // Submit termination request
            $memberModel->submitTerminationRequest($terminationData);

            // Return success response for AJAX request
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode(['success' => true]);
                exit;
            }

            // Set success message for regular form submission
            $_SESSION['success'] = 'Permohonan penamatan keahlian anda telah berjaya dihantar.';
            header('Location: /members/profile');
            exit;

        } catch (Exception $e) {
            error_log("Error in submitTermination: " . $e->getMessage());
            
            // Return error response for AJAX request
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }

            // Set error message for regular form submission
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/termination');
            exit;
        }
    }

    public function pay_fees() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            if (!isset($_POST['payroll_agreement'])) {
                $_SESSION['error'] = 'Sila tandakan kotak persetujuan untuk potongan gaji';
                header('Location: /members/saving_acc');
                exit;
            }

            // Debug log
            error_log("Starting pay_fees for user_id: " . $_SESSION['user_id']);

            // Get user's IC and account details
            $userId = $_SESSION['user_id'];
            $memberData = $this->member->getPendingRegistration($userId);
            
            // Debug log
            error_log("Member data retrieved: " . print_r($memberData, true));

            if (!$memberData) {
                throw new Exception("Member data not found");
            }

            $userIc = $memberData['ic_no'];
            if (!$userIc) {
                throw new Exception("IC number not found");
            }

            // Get the account_id from saving_accounts table
            $stmt = $this->db->prepare("SELECT id, balance FROM saving_accounts WHERE user_ic = ?");
            $stmt->execute([$userIc]);
            $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Debug log
            error_log("Account data retrieved: " . print_r($accountData, true));

            if (!$accountData) {
                // If account doesn't exist, create it
                $createAccountStmt = $this->db->prepare("
                    INSERT INTO saving_accounts (user_ic, balance) 
                    VALUES (?, 0)
                ");
                $createAccountStmt->execute([$userIc]);
                $accountId = $this->db->lastInsertId();
                $currentBalance = 0;
                
                error_log("Created new saving account with ID: " . $accountId);
            } else {
                $accountId = $accountData['id'];
                $currentBalance = $accountData['balance'];
            }

            // Start transaction
            $this->db->beginTransaction();
            error_log("Started database transaction");

            try {
                // Insert Modal Deposit transaction
                $depositAmount = $memberData['deposit_funds'] ?? 20;
                $depositStmt = $this->db->prepare("
                    INSERT INTO saving_transactions 
                    (account_id, transaction_type, amount, description, status, transaction_date) 
                    VALUES (?, 'deposit', ?, 'Yuran Modal Deposit', 'approved', NOW())
                ");
                $depositStmt->execute([$accountId, $depositAmount]);
                error_log("Inserted Modal Deposit transaction: RM" . $depositAmount);

                // Insert Fixed Deposit transaction if exists
                $fixedDepositAmount = $memberData['fixed_deposit'] ?? 0;
                if ($fixedDepositAmount > 0) {
                    $depositStmt = $this->db->prepare("
                        INSERT INTO saving_transactions 
                        (account_id, transaction_type, amount, description, status, transaction_date) 
                        VALUES (?, 'deposit', ?, 'Simpanan Tetap Bulanan', 'approved', NOW())
                    ");
                    $depositStmt->execute([$accountId, $fixedDepositAmount]);
                    error_log("Inserted Fixed Deposit transaction: RM" . $fixedDepositAmount);
                }

                // Update account balance
                $newBalance = $currentBalance + $depositAmount + $fixedDepositAmount;
                $updateBalanceStmt = $this->db->prepare("
                    UPDATE saving_accounts 
                    SET balance = ?, potongan_gaji = 1 
                    WHERE id = ?
                ");
                $updateBalanceStmt->execute([$newBalance, $accountId]);
                error_log("Updated account balance to: RM" . $newBalance);

                // Commit transaction
                $this->db->commit();
                error_log("Transaction committed successfully");

                $_SESSION['success'] = 'Pembayaran yuran telah berjaya didaftarkan';
                header('Location: /members/saving_acc');
                exit;

            } catch (Exception $e) {
                // Rollback transaction on error
                $this->db->rollBack();
                error_log("Transaction rolled back due to error: " . $e->getMessage());
                throw $e;
            }

        } catch (Exception $e) {
            error_log("Error in pay_fees: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $_SESSION['error'] = 'Ralat telah berlaku. Sila cuba lagi.';
            header('Location: /members/saving_acc');
            exit;
        }
    }

} 