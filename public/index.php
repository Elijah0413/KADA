<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Update BASEURL definition to work with HTTPS and subdirectories
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$subdirectory = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
$baseUrl = $protocol . $_SERVER['HTTP_HOST'];
if (!empty($subdirectory)) {
    $baseUrl .= '/' . $subdirectory;
}
define('BASEURL', $baseUrl);

// Add Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';


error_log("Session contents: " . print_r($_SESSION, true));

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Update URI processing to handle subdirectories
$uri = $_SERVER['REQUEST_URI'];
// Remove subdirectory from URI if it exists
if (!empty($subdirectory)) {
    $uri = str_replace('/' . $subdirectory, '', $uri);
}
$uri = trim($uri, '/');

// Debug logging
error_log("Processing URI path: " . $uri);

require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Database.php';

// Add EmailService requirement
require_once '../app/services/EmailService.php';

require_once '../app/controllers/UserController.php';
require_once '../app/models/User.php';

require_once '../app/controllers/LoanController.php';
require_once '../app/models/Loan.php';

require_once '../app/core/Autoload.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/models/Admin.php';

require_once '../app/controllers/MemberController.php';
require_once '../app/models/Member.php';

use App\controllers\UserController;
use App\controllers\AdminController;
use App\controllers\LoanController;
use App\controllers\MemberController;


// Extract the base path and query parameters
$uriParts = explode('?', $uri);
$path = $uriParts[0];

if (empty($path)) {
    $controller = new UserController();
    $controller->index();
} 
// Updated verification route with more flexible matching
elseif (strpos($path, 'kada/verify-email') !== false) {
    error_log("Matched verify-email route with token: " . ($_GET['token'] ?? 'no token')); 
    $controller = new UserController();
    $controller->verifyEmail();
}

if ($uri === 'register' && $method === 'GET') {
    $controller = new UserController();
    $controller->register();
}   elseif ($uri === 'store' && $method === 'POST') {
    $controller = new UserController();
    $controller->store();



}   elseif ($uri === 'userlogin' && $method === 'GET') {
    $controller = new UserController();
    $controller->userlogin();
}   elseif ($uri === 'handle-login' && $method === 'POST') {
    // Handle login data submission
    $controller = new UserController();
    $controller->handleLogin(); // Process the login data
}   elseif ($uri === 'userRegister' && $method === 'GET') {
    $controller = new UserController();
    $controller->userRegister();
} elseif ($uri === 'handle-register' && $method === 'POST') {
    // Handle registration data submission
    $controller = new UserController();
    $controller->handleRegister();

} elseif (preg_match('/edit\/(\d+)/', $uri, $matches) && $method === 'GET') {
    $controller = new UserController();
    $controller->edit($matches[1]);
} elseif ($uri === 'faqList' && $method === 'GET') {
    $controller = new UserController();
    $controller->faqList();
} elseif ($uri === 'members/info' && $method === 'GET') {
    $controller = new MemberController();
    $controller->info();

} elseif ($uri === 'registerLoan' && $method === 'GET') {
    $controller = new LoanController();
    $controller->registerLoan();
} elseif ($uri === 'storeLoan' && $method === 'POST') {
    $controller = new LoanController();
    $controller->storeLoan();   
} elseif ($uri === 'loantype' && $method === 'GET') {
    $controller = new LoanController();
    $controller->loantype();


    
} elseif ($uri === 'loanCalculator' && $method === 'GET') {
    $controller = new LoanController();
    $controller->loanCalculator();
} elseif ($uri === 'loanCalculator' && $method === 'POST') {
    $controller = new LoanController();
    $controller->loanCalculator(); 
} 
elseif ($uri === 'admins' && $method === 'GET') {
    // Always redirect to userlogin first if trying to access admin directly
    if (!isset($_SESSION['user_id'])) {
        header('Location: /userlogin');
        exit;
    }
    
    // Only allow access to admin page if user is logged in as admin
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        $_SESSION['error'] = "Anda tidak mempunyai kebenaran untuk mengakses halaman ini.";
        header('Location: /userlogin');
        exit;
    }
    
    $controller = new AdminController();
    $controller->index();
} elseif ($uri === 'members' && $method === 'GET') {
        $controller = new MemberController();
        $controller->index();
    
} elseif ($uri === 'users/index' && $method === 'GET') {
    $controller = new UserController();
    $controller->index();
} elseif ($uri === 'users/benefits' && $method === 'GET') {
    $controller = new UserController();
    $controller->benefits();
} elseif ($uri === 'members/benefits' && $method === 'GET') {
    $controller = new MemberController();
    $controller->benefits();
} elseif ($uri === 'members/loans' && $method === 'GET') {
    $controller = new MemberController();
    $controller->loans();
} elseif ($uri === 'logout') {
    session_start();
    session_destroy();
    header('Location: /userlogin');
    exit();
} elseif ($uri === 'members/profile' && $method === 'GET') {
    $controller = new MemberController();
    $controller->profile();
} elseif ($uri === 'viewloan' && $method === 'GET') {
    $controller = new LoanController();
    $controller->viewLoan();
} elseif ($uri === 'confirmLoan' && $method === 'POST') {
    $controller = new LoanController();
    $controller->confirmLoan();
} elseif ($uri === 'loan/store' && $method === 'POST') {
    $controller = new LoanController();
    $controller->storeLoan();
} elseif (preg_match('/^members\/dashboard/', $uri)) {
    // This will match 'members/dashboard' with or without query parameters
    $controller = new MemberController();
    $controller->dashboard();
} elseif ($uri === 'member-profile' && $method === 'GET') {
    $controller = new UserController();
    $controller->memberProfile();
} elseif ($uri === 'save-member-profile' && $method === 'POST') {
    $controller = new UserController();
    $controller->saveMemberProfile();
//admin
} elseif (preg_match('/^admins\/approve\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $controller = new AdminController();
    $controller->approve($matches[1]);
} elseif (preg_match('/^admins\/reject\/(\d+)$/', $uri, $matches)) {
    $controller = new AdminController();
    $controller->reject($matches[1]);
} elseif (preg_match('/^admins\/view\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $controller = new AdminController();
    $controller->viewMember($matches[1]);

} elseif (preg_match('/^admins\/approveLoan\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $controller = new AdminController();
    $controller->approveLoan($matches[1]);
} elseif (preg_match('/^admins\/rejectLoan\/(\d+)$/', $uri, $matches) ) {
    $controller = new AdminController();
    $controller->rejectLoan($matches[1]);
} elseif (preg_match('/^admins\/loans\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $controller = new AdminController();
    $controller->viewLoan($matches[1]);

} elseif ($uri === 'members/customerService' && $method === 'GET') {
    $controller = new MemberController();
    $controller->customerService();
} elseif ($uri === 'members/submitInquiry' && $method === 'POST') {
    $controller = new MemberController();
    $controller->submitInquiry();
} elseif ($uri === 'admins/replyInquiry' && $method === 'POST') {
    $controller = new AdminController();
    $controller->replyInquiry();

    
//member saving account
} elseif ($uri === 'members/saving_acc' && $method === 'GET') {
    $controller = new MemberController();
    $controller->saving_acc();
} elseif ($uri === 'members/updateBalance' && $method === 'POST') {
    $controller = new MemberController();
    $controller->updateBalance();
} elseif ($uri === 'members/deposit' && $method === 'POST') {
    $controller = new MemberController();
    $controller->deposit();
} elseif ($uri === 'members/request-transfer' && $method === 'POST') {
    $controller = new MemberController();
    $controller->request_transfer();
} elseif ($uri === 'admins/processTransfer' && $method === 'POST') {
    $controller = new AdminController();
    $controller->processTransfer();
} elseif (strpos($uri, 'verify-email') === 0) {
    $controller = new UserController();
    $controller->verifyEmail();
} elseif ($uri === 'members/edit-profile' && $method === 'GET') {
    $controller = new MemberController();
    $controller->editProfile();
} elseif ($uri === 'members/update-profile' && $method === 'POST') {
    $controller = new MemberController();
    $controller->updateProfile();
} elseif ($uri === 'members/confirm-deposit' && $method === 'POST') {
    $controller = new MemberController();
    $controller->confirmDeposit();
} elseif ($uri === 'members/confirm-transfer' && $method === 'POST') {
    $controller = new MemberController();
    $controller->confirmTransfer();
} elseif ($uri === 'admins/report' && $method === 'GET') {
    $controller = new AdminController();
    $controller->generateReport();
} elseif (preg_match('/^admin\/get-monthly-data\/(\d{4}-\d{2})$/', $uri, $matches)) {
    $controller = new AdminController();
    $controller->getMonthlyData($matches[1]);
} elseif ($uri === 'members/view-financial-report' && $method === 'POST') {
    $controller = new MemberController();
    $controller->viewFinancialReport();
} elseif ($uri === 'generate-pdf' && $method === 'POST') {
    $controller = new MemberController();
    $controller->generateFinancialReport();
    exit;
} elseif ($uri === 'faqList_user' && $method === 'GET') {
    $controller = new UserController();
    $controller->faqList_user();
} elseif ($uri === 'info_user' && $method === 'GET') {
    $controller = new UserController();
    $controller->info_user();
} elseif ($uri === 'benefits_user' && $method === 'GET') {
    $controller = new UserController();
    $controller->benefits_user();
} elseif ($uri === 'loan_user' && $method === 'GET') {
    $controller = new UserController();
    $controller->loan_user();
} elseif ($uri === 'mBenefit' && $method === 'GET') {
    $controller = new UserController();
    $controller->mBenefit();
} elseif ($uri === 'forgot-password' && $method === 'GET') {
    $controller = new UserController();
    $controller->forgotPassword();
} elseif ($uri === 'handle-forgot-password' && $method === 'POST') {
    $controller = new UserController();
    $controller->handleForgotPassword();
} elseif ($uri === 'reset-password' && $method === 'GET') {
    $controller = new UserController();
    $controller->resetPassword();
} elseif ($uri === 'handle-reset-password' && $method === 'POST') {
    $controller = new UserController();
    $controller->handleResetPassword();
} elseif (preg_match('/^reset-password/', $uri) && $method === 'GET') {
    $controller = new UserController();
    $controller->resetPassword();
} elseif (preg_match('/^members\/receipt\/(\d+)$/', $uri, $matches)) {
    require_once(__DIR__ . '/../app/controllers/MemberController.php');
    $controller = new MemberController();
    $controller->generateReceipt($matches[1]);
} elseif ($uri === 'loan_calculator' && $method === 'GET') {
    $controller = new UserController();
    $controller->loanCalculator();
} elseif ($uri === 'm_loanCalc' && $method === 'GET') {
    $controller = new MemberController();
    $controller->m_loanCalc();
} elseif ($uri === 'members/m_info' && $method === 'GET') {
    $controller = new MemberController();
    $controller->m_info();
} elseif ($uri === 'members/m_loanCalc' && $method === 'GET') {
    $controller = new MemberController();
    $controller->m_loanCalc();
} elseif ($uri === 'members/check-profile-status' && $method === 'GET') {
    $controller = new MemberController();
    $controller->checkProfileStatus();
} elseif ($uri === 'members/confirm_payment' && $method === 'GET') {
    $controller = new MemberController();
    $controller->confirm_payment();
} elseif ($uri === 'members/payment_success' && $method === 'GET') {
    $controller = new MemberController();
    $controller->payment_success();
} elseif ($uri === 'members/process_payment' && $method === 'POST') {
    $controller = new MemberController();
    $controller->process_payment();
} elseif ($uri === 'members/saving_acc' && $method === 'GET') {
    $controller = new MemberController();
    $controller->profile_saving_acc();
} elseif ($uri === 'members/termination' && $method === 'GET') {
    $controller = new MemberController();
    $controller->termination();
} elseif ($uri === 'members/submit-termination' && $method === 'POST') {
    $controller = new MemberController();
    $controller->submitTermination();
} elseif ($uri === 'admins/active-members' && $method === 'GET') {
    $controller = new AdminController();
    $controller->activeMembers();
} elseif ($uri === 'admins/deactivate-member' && $method === 'POST') {
    $controller = new AdminController();
    $controller->deactivateMember();
} elseif ($uri === 'admins/send-retirement-notice' && $method === 'POST') {
    $controller = new AdminController();
    $controller->sendRetirementNotice();
} elseif ($uri === 'admins/send-termination-rejection' && $method === 'POST') {
    $controller = new AdminController();
    $controller->sendTerminationRejection();
} elseif ($uri === 'members/pay_fees' && $method === 'POST') {
    $controller = new MemberController();
    $controller->pay_fees();
} elseif ($uri === 'admins/activate-member' && $method === 'POST') {
    $controller = new AdminController();
    $controller->activateMember();
} elseif (preg_match('/^admins\/lihat\/(\d+)$/', $uri, $matches)) {
    error_log("Lihat route matched. ID: " . $matches[1]);
    $controller = new AdminController();
    $controller->lihat($matches[1]);
} elseif (preg_match('/^admins\/reason\/(\d+)$/', $uri, $matches)) {
    error_log("Lihat route matched. ID: " . $matches[1]);
    $controller = new AdminController();
    $controller->reason($matches[1]);
} elseif (preg_match('/^admins\/approve-termination\/(\d+)$/', $uri, $matches)) {
    $controller = new AdminController();
    $controller->approveTermination($matches[1]);
} elseif (preg_match('/^admins\/reject-termination\/(\d+)$/', $uri, $matches)) {
    $controller = new AdminController();
    $controller->rejectTermination($matches[1]);
}