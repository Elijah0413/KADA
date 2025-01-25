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
            // Get loan applications
            $applications = $this->getLoanApplications();
            
            // Get member registration application
            $memberApplication = $this->getMemberApplication();
            
            // Pass user and applications data to the view
            $this->view('members/dashboard', [
                'member' => (object)[
                    'full_name' => $memberApplication['name'] ?? 'Tetamu',
                    'last_login' => date('Y-m-d H:i:s')
                ],
                'applications' => $applications ?? [],
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
        return $this->loan->getLoansByUserId($_SESSION['user_id']);
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
                'transactions' => $transactions,
                'loan_applications' => $loan_applications,
                'total_monthly_installment' => $total_monthly_installment,
                'pending_member' => $pending_member,
                'payment_dates' => $payment_dates
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
            $pendingData = $this->member->getPendingRegistration($_SESSION['user_id']);
            
            if (!$pendingData) {
                $_SESSION['error'] = "Profile not found";
                header('Location: /members/profile');
                exit;
            }

            $this->view('members/edit_profile', ['pendingData' => $pendingData]);
        } catch (\Exception $e) {
            $_SESSION['error'] = "Error retrieving profile information: " . $e->getMessage();
            header('Location: /members/profile');
            exit;
        }
    }

    public function updateProfile()
    {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /members/profile');
            exit;
        }

        try {
            // Debug: Log the POST data
            error_log("POST data received: " . print_r($_POST, true));

            // Process family members data
            $familyMembers = isset($_POST['family_members']) ? $_POST['family_members'] : [];
            unset($_POST['family_members']); // Remove from main POST data

            $data = [
                'user_id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'ic_no' => trim($_POST['ic_no']),
                'gender' => trim($_POST['gender']),
                'religion' => trim($_POST['religion']),
                'race' => trim($_POST['race']),
                'marital_status' => trim($_POST['marital_status']),
                'member_number' => trim($_POST['member_number']),
                'pf_number' => trim($_POST['pf_number']),
                'position' => trim($_POST['position']),
                'grade' => trim($_POST['grade']),
                'monthly_salary' => floatval($_POST['monthly_salary']),
                'home_address' => trim($_POST['home_address']),
                'home_postcode' => trim($_POST['home_postcode']),
                'home_state' => trim($_POST['home_state']),
                'office_phone' => trim($_POST['office_phone']),
                'home_phone' => trim($_POST['home_phone']),
                'fax' => trim($_POST['fax'] ?? ''),
                'family_members' => $familyMembers, // Add back the family members data
                'status' => 'pending'
            ];

            // Debug: Log the processed data
            error_log("Processed data: " . print_r($data, true));

            // Update the profile in the database
            if ($this->member->updateProfile($data)) {
                $_SESSION['success'] = "Profil berjaya dikemaskini dan sedang menunggu pengesahan";
                header('Location: /members/profile');
                exit;
            } else {
                throw new \Exception("Failed to update profile");
            }

        } catch (\Exception $e) {
            error_log("Error in updateProfile: " . $e->getMessage());
            $_SESSION['error'] = "Error updating profile: " . $e->getMessage();
            header('Location: /members/edit-profile');
            exit;
        }
    }
    public function viewFinancialReport() {
        try {
            $userId = $_SESSION['user_id'] ?? null;
            $reportType = $_POST['report_type'] ?? '';
            $selectedMonth = $_POST['selected_month'] ?? '';
            $selectedYear = $_POST['selected_year'] ?? '';

            if (!$userId) {
                throw new Exception("User ID not found");
            }

            // Set display date based on report type
            $displayDate = '';
            if ($reportType === 'monthly' && $selectedMonth) {
                $displayDate = date('F Y', strtotime($selectedMonth));
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $displayDate = $selectedYear;
            }

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
                AND DATE_FORMAT(p.created_at, '%Y-%m') <= :report_date
                ORDER BY p.created_at DESC LIMIT 1";

            $stmt = $this->db->prepare($accountQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            if ($reportType === 'monthly') {
                // For monthly reports, compare year-month only
                $reportDate = date('Y-m', strtotime($selectedMonth . '-01'));
            } else {
                $accountQuery .= ":report_date";
                $reportDate = $selectedYear . '-12-31';
            }

            $stmt->bindParam(':report_date', $reportDate);
            $stmt->execute();
            $accountData = $stmt->fetch(PDO::FETCH_ASSOC);

            // If no account data found or date is before registration, return all zeros
            if (!$accountData) {
                $account = (object)[
                    'share_capital' => 0,
                    'fee_capital' => 0,
                    'fixed_deposit' => 0,
                    'balance' => 0
                ];
            } else {
                $memberCreatedMonth = date('Y-m', strtotime($accountData['member_created_at']));
                
                if ($reportType === 'monthly') {
                    $reportMonth = date('Y-m', strtotime($selectedMonth . '-01'));
                    // Show values if report month is same as or after registration month
                    if ($reportMonth >= $memberCreatedMonth) {
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
                } else {
                    // Return actual values
                    $account = (object)[
                        'share_capital' => $accountData['share_capital'] ?? 0,
                        'fee_capital' => $accountData['fee_capital'] ?? 0,
                        'fixed_deposit' => $accountData['fixed_deposit'] ?? 0,
                        'balance' => $accountData['balance'] ?? 0
                    ];
                }
            }

            // Get loan data
            $loanQuery = "
                SELECT 
                    SUM(CASE WHEN loan_type = 'Pembiayaan_Al_Bai' AND status = 'APPROVED' THEN t_amount ELSE 0 END) as Pembiayaan_Al_Bai,
                    SUM(CASE WHEN loan_type = 'Pembiayaan_Al_Innah' AND status = 'APPROVED' THEN t_amount ELSE 0 END) as Pembiayaan_Al_Innah,
                    SUM(CASE WHEN loan_type = 'Pembiayaan_Skim_Khas' AND status = 'APPROVED' THEN t_amount ELSE 0 END) as Pembiayaan_Skim_Khas,
                    SUM(CASE WHEN loan_type = 'Pembiayaan_RoadTaxInsuran' AND status = 'APPROVED' THEN t_amount ELSE 0 END) as Pembiayaan_RoadTaxInsuran,
                    SUM(CASE WHEN loan_type = 'Pembiayaan_Al_Qardhul_Hasan' AND status = 'APPROVED' THEN t_amount ELSE 0 END) as Pembiayaan_Al_Qardhul_Hasan
                FROM loan_applications 
                WHERE user_id = :userId
            ";

            // Add date filtering for loans based on report type
            if ($reportType === 'monthly' && $selectedMonth) {
                $loanQuery .= " AND DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth";
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $loanQuery .= " AND YEAR(created_at) = :selectedYear";
            }

            $stmt = $this->db->prepare($loanQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            // Bind date parameters if needed
            if ($reportType === 'monthly' && $selectedMonth) {
                $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            }

            $stmt->execute();
            $loanData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set date range based on report type
            $dateCondition = '';
            if ($reportType === 'monthly' && $selectedMonth) {
                $dateCondition = "AND DATE_FORMAT(st.transaction_date, '%Y-%m') = :selectedMonth";
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $dateCondition = "AND YEAR(st.transaction_date) = :selectedYear";
            }

            // Fetch transactions with date filtering
            $query = "
                SELECT st.*, DATE_FORMAT(st.transaction_date, '%Y-%m-%d %H:%i:%s') as request_date
                FROM saving_transactions st
                JOIN saving_accounts sa ON st.account_id = sa.id
                JOIN pendingregistermember prm ON sa.user_ic = prm.ic_no
                WHERE prm.user_id = :userId
                $dateCondition
                ORDER BY st.transaction_date DESC
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            if ($reportType === 'monthly' && $selectedMonth) {
                $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            }
            $stmt->execute();
            $transactions = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Format transactions for view
            $formattedTransactions = [];
            foreach ($transactions as $trans) {
                $formattedTransactions[] = (object)[
                    'request_date' => $trans->request_date,
                    'transaction_type' => $trans->transaction_type,
                    'amount' => $trans->amount,
                    'status' => $trans->status ?? 'approved',
                    'remarks' => $trans->description,
                    'transfer_purpose' => $trans->transfer_purpose ?? null,
                    'bank_name' => $trans->bank_name ?? null,
                    'bank_account' => $trans->bank_account ?? null
                ];
            }

            // Fetch loan applications
            $loanApplicationsQuery = "
                SELECT 
                    loan_type,
                    t_amount,
                    period,
                    mon_installment,
                    status,
                    created_at,
                    admin_remark
                FROM loan_applications 
                WHERE user_id = :userId
            ";

            if ($reportType === 'monthly' && $selectedMonth) {
                $loanApplicationsQuery .= " AND DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth";
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $loanApplicationsQuery .= " AND YEAR(created_at) = :selectedYear";
            }

            $loanApplicationsQuery .= " ORDER BY created_at DESC";

            $stmt = $this->db->prepare($loanApplicationsQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            if ($reportType === 'monthly' && $selectedMonth) {
                $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            } elseif ($reportType === 'yearly' && $selectedYear) {
                $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            }

            $stmt->execute();
            $loanApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Prepare view data
            $viewData = [
                'member' => (object)$memberInfo, // Use the stored member info
                'account' => $account,
                'loans' => (object)[
                    'Pembiayaan_Al_Bai' => $loanData['Pembiayaan_Al_Bai'] ?? 0,
                    'Pembiayaan_Al_Innah' => $loanData['Pembiayaan_Al_Innah'] ?? 0,
                    'Pembiayaan_RoadTaxInsuran' => $loanData['Pembiayaan_RoadTaxInsuran'] ?? 0,
                    'Pembiayaan_Skim_Khas' => $loanData['Pembiayaan_Skim_Khas'] ?? 0,
                    'Pembiayaan_Al_Qardhul_Hasan' => $loanData['Pembiayaan_Al_Qardhul_Hasan'] ?? 0
                ],
                'transactions' => $formattedTransactions,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
                'reportType' => $reportType,
                'displayDate' => $displayDate,
                'loanApplications' => $loanApplications
            ];

            // Pass all data to the view
            $this->view('members/financial_report', $viewData);

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /members/saving_acc');
            exit;
        }
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


}