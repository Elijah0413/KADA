<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use Exception;
use App\Services\EmailService;

class UserController extends Controller
{
    private $user;
    private $emailService;

    public function __construct()
    {
        $this->user = new User();
        $this->emailService = new EmailService();
    }

    public function index()
    {
        // Fetch all users from the database (Admin Dashboard)
        $users = $this->user->all();

        // Pass the data to the 'users/index' view
        $this->view('users/index', compact('users'));
    }

    public function register()
    {
        $this->view('users/register');
    }

    private function validatePassword($password) {
        if (strlen($password) < 6) {
            return "Kata laluan mestilah sekurang-kurangnya 6 aksara";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return "Kata laluan mesti mengandungi huruf besar";
        }
        if (!preg_match('/[a-z]/', $password)) {
            return "Kata laluan mesti mengandungi huruf kecil";
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            return "Kata laluan mesti mengandungi simbol";
        }
        return null;
    }

    public function store()
    {
        try {
            // Validate IC number
            if (!isset($_POST['ic_no']) || 
                strlen($_POST['ic_no']) !== 12 || 
                !ctype_digit($_POST['ic_no'])) {
                $_SESSION['error'] = "Nombor IC mestilah 12 digit";
                header('Location: /register');
                return;
            }

            // Validate password
            $passwordError = $this->validatePassword($_POST['password']);
            if ($passwordError) {
                $_SESSION['error'] = $passwordError;
                header('Location: /register');
                return;
            }

            // Check if passwords match
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $_SESSION['error'] = "Kata laluan tidak sepadan";
                header('Location: /register');
                return;
            }

            // Check if user already exists
            if ($this->user->findByIcNumber($_POST['ic_no'])) {
                $_SESSION['error'] = "Ahli dengan nombor IC ini telah wujud.";
                header('Location: /register');
                return;
            }

            // Registration logic
            $this->user->register($_POST);

            $_SESSION['success'] = "Pendaftaran berjaya! Selamat datang ke KADA.";
            header('Location: /');

        } catch (Exception $e) {
            $_SESSION['error'] = "Ralat berlaku semasa pendaftaran. Sila cuba lagi.";
            header('Location: /register');
        }
    }

    public function edit($id)
    {
        // Fetch the user data using the ID
        $user = $this->user->find($id);

        // Pass the user data to the 'users/edit' view
        $this->view('users/edit', compact('user'));
    }

    public function faqList()
    {
        return $this->view('users/faqList');
    }

    public function info()
    {
        // Simply render the info view
        $this->view('users/info');
    }

    public function userlogin()
    {
        // Add cache control headers
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Wed, 11 Jan 1984 05:00:00 GMT");
        
        $this->view('users/userlogin');
    }

    public function handleLogin()
    {
        try {
            // Validate IC number
            if (!isset($_POST['ic_no']) || 
                strlen($_POST['ic_no']) !== 12 || 
                !ctype_digit($_POST['ic_no'])) {
                $_SESSION['error'] = "Nombor IC mestilah 12 digit";
                header('Location: /userlogin');
                return;
            }

            $icNo = trim($_POST['ic_no']);
            $password = trim($_POST['password']);

            if (empty($icNo) || empty($password)) {
                throw new Exception("Sila masukkan nombor IC dan kata laluan");
            }

            // Special handling for admin login
            if ($icNo === '000000000000' && $password === 'Admin@123') {
                $_SESSION['user_id'] = '000000000000';
                $_SESSION['user_role'] = 'admin';
                // Add cache control headers
                header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");
                header('Location: /admins');
                exit;
            }

            // Regular user login process
            $user = $this->user->findByIcNo($icNo);

            if (!$user) {
                $_SESSION['error'] = "Akaun ini tidak dijumpai";
                unset($_SESSION['ic_no']); 
                header('Location: /userlogin');
                return;
            }

            // Check email verification
            if ($user['role'] !== 'admin' && !$user['email_verified']) {
                throw new Exception("Sila sahkan emel anda sebelum log masuk");
            }

            if (!password_verify($password, $user['password'])) {
                $_SESSION['ic_no'] = $icNo;
                $_SESSION['error'] = isset($_SESSION['error']) ? 
                    $_SESSION['error'] . "<br>Sila masukkan semula kata laluan anda" : 
                    "Sila masukkan semula kata laluan anda";
                header('Location: /userlogin');
                return;
            }

            unset($_SESSION['ic_no']);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            
            // Add cache control headers
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            
            // Redirect based on role
            if ($user['role'] === 'admin') {
                header('Location: /admin');
            } else {
                header('Location: /members');
            }
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = "Log masuk gagal. Sila cuba lagi.";
            header('Location: /userlogin');
        }
    }

    public function userRegister()
    {
        $this->view('users/userRegister');
    }

    // Handle the registration form submission
    public function handleRegister()
    {
        try {
            // Validate input
            if (empty($_POST['ic_no']) || empty($_POST['password']) || 
                empty($_POST['email']) || empty($_POST['confirm_password'])) {
                throw new Exception("All fields are required");
            }

            // Validate password match
            if ($_POST['password'] !== $_POST['confirm_password']) {
                throw new Exception("Passwords do not match");
            }

            // Validate email format
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            // Check if email already exists
            if ($this->user->findByEmail($_POST['email'])) {
                throw new Exception("Email already registered");
            }

            // Check if IC number already exists
            if ($this->user->findByIcNo($_POST['ic_no'])) {
                throw new Exception("IC number already registered");
            }

            // Register user
            $result = $this->user->register($_POST);

            if ($result) {
                // Get user data for email
                $userData = $this->user->findByEmail($_POST['email']);
                
                // Send verification email
                $this->emailService->sendVerificationEmail(
                    $_POST['email'],
                    $userData['verification_token']
                );

                $_SESSION['success'] = "Pendaftaran berjaya! Sila semak emel anda untuk pengesahan akaun.";
                header('Location: /userlogin');
                exit;
            }

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /userRegister');
            exit;
        }
    }

    // Optional: Logout method
    public function logout()
    {
        // Clear all session data
        session_unset();
        session_destroy();
        
        // Send headers to prevent caching
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        
        // Redirect to login page
        header('Location: /userlogin');
        exit;
    }

    public function benefits()
    {
        require '../app/views/users/benefits.php';
    }

    public function memberProfile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        // Check if user has already submitted a profile
        if ($this->user->hasPendingRegistration($_SESSION['user_id'])) {
            $_SESSION['info'] = "Anda telah menghantar permohonan keahlian anda. Sila tunggu untuk kelulusan.";
            header('Location: /members');
            exit;
        }

        // Get user data including IC number
        $userData = $this->user->find($_SESSION['user_id']);
        
        // Pass the user data to the view
        $this->view('members/member_profile', compact('userData'));
    }

    public function saveMemberProfile()
    {
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new Exception("User not logged in");
            }

            // Keep submitted data in session to repopulate form
            $_SESSION['form_data'] = $_POST;

            // Separate family members data from the main form data
            $formData = $_POST;
            $familyMembers = isset($formData['family_members']) ? $formData['family_members'] : [];
            unset($formData['family_members']); // Remove from main data array

            // Validate and sanitize main form data
            $profileData = array_map(function($value) {
                return is_string($value) ? trim($value) : $value;
            }, $formData);

            // Process family members data separately
            $processedFamilyMembers = [];
            foreach ($familyMembers as $member) {
                $processedFamilyMembers[] = array_map('trim', $member);
            }

            // Add processed data back to profile data
            $profileData['family_members'] = $processedFamilyMembers;
            $profileData['user_id'] = $_SESSION['user_id'];

            // List of required fields (excluding family members)
            $requiredFields = [
                'name', 'ic_no', 'gender', 'religion', 'race', 'marital_status',
                'member_number', 'pf_number', 'position', 'grade', 'monthly_salary',
                'home_address', 'home_postcode', 'home_state', 'office_phone', 
                'home_phone'
            ];

            // Check for missing required fields
            $missingFields = [];
            foreach ($requiredFields as $field) {
                if (!isset($profileData[$field]) || trim($profileData[$field]) === '') {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                throw new Exception("Medan yang diperlukan tidak lengkap: " . implode(', ', $missingFields));
            }

            // Save to pendingregistermember table
            $result = $this->user->savePendingMemberProfile($profileData);

            if ($result) {
                $_SESSION['success'] = "Profil berjaya dihantar. Menunggu kelulusan.";
                header('Location: /members');
                exit;
            } else {
                throw new Exception("Gagal menyimpan profil");
            }

        } catch (Exception $e) {
            error_log("Error in saveMemberProfile: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /member-profile');
            exit;
        }
    }

    public function verifyEmail()
    {
        try {
            $token = $_GET['token'] ?? '';
            error_log("Processing verification token: " . $token);

            if (empty($token)) {
                throw new Exception("Invalid verification token");
            }

            $result = $this->user->verifyEmail($token);
            error_log("Verification result: " . ($result ? 'success' : 'failed'));

            if ($result) {
                $_SESSION['success'] = "Emel telah disahkan dengan berjaya! Anda boleh log masuk sekarang.";
                header('Location: http://localhost:8000/userlogin');
            } else {
                $_SESSION['error'] = "Token pengesahan tidak sah atau telah tamat tempoh.";
                header('Location: http://localhost:8000/userlogin');
            }
            exit;

        } catch (Exception $e) {
            error_log("Verification error: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: http://localhost:8000/userlogin');
            exit;
        }
    }

    public function faqList_user()
    {
        $this->view('users/faqList_user');
    }

    public function info_user()
    {
        $this->view('users/info_user');
    }

    public function benefits_user()
    {
        $this->view('users/benefits_user');
    }

    public function loan_user()
    {
        $this->view('users/loan_user');
    }

    public function mBenefit()
    {
        $this->view('users/mBenefit');
    }

    public function forgotPassword()
    {
        // Simply display the forgot password form
        $this->view('users/forgotPassword');
    }

    public function handleForgotPassword()
    {
        try {
            // Validate IC number
            if (!isset($_POST['ic_no']) || 
                strlen($_POST['ic_no']) !== 12 || 
                !ctype_digit($_POST['ic_no'])) {
                $_SESSION['error'] = "Nombor IC mestilah 12 digit";
                header('Location: /forgot-password');
                return;
            }

            $icNo = $_POST['ic_no'];
            $email = $_POST['email'];

            // Debug log
            error_log("Handling forgot password request for IC: $icNo, Email: $email");

            // Find user
            $user = $this->user->findByIcNoAndEmail($icNo, $email);
            if (!$user) {
                throw new Exception("Tiada akaun dijumpai dengan maklumat ini");
            }

            // Generate reset token
            $resetToken = bin2hex(random_bytes(32));
            
            // Save reset token
            if (!$this->user->saveResetToken($user['id'], $resetToken)) {
                throw new Exception("Error saving reset token");
            }

            // Send reset email
            $this->emailService->sendPasswordResetEmail($email, $resetToken);

            $_SESSION['success'] = "Arahan tetapan semula kata laluan telah dihantar ke emel anda";
            header('Location: /userlogin');
            exit;

        } catch (Exception $e) {
            error_log("Forgot password error: " . $e->getMessage());
            $_SESSION['error'] = "Ralat berlaku. Sila cuba lagi.";
            header('Location: /forgot-password');
            exit;
        }
    }

    public function resetPassword()
    {
        try {
            $token = $_GET['token'] ?? '';
            
            // Debug logs
            error_log("Reset password requested with token: " . $token);
            
            if (empty($token)) {
                throw new Exception("Invalid reset token");
            }

            // Get user data
            $userData = $this->user->getUserDataByToken($token);
            error_log("User data retrieved: " . print_r($userData, true));
            
            if (!$userData) {
                throw new Exception("Invalid or expired reset token");
            }

            $this->view('users/resetPassword', [
                'token' => $token,
                'userData' => $userData
            ]);

        } catch (Exception $e) {
            error_log("Reset password error: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: /userlogin');
            exit;
        }
    }

    public function handleResetPassword()
    {
        try {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validate password
            $passwordError = $this->validatePassword($password);
            if ($passwordError) {
                $_SESSION['error'] = $passwordError;
                header('Location: /reset-password?token=' . urlencode($token));
                return;
            }

            // Check if passwords match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Kata laluan tidak sepadan";
                header('Location: /reset-password?token=' . urlencode($token));
                return;
            }

            // Update password
            $success = $this->user->resetPasswordWithToken($token, $password);
            if (!$success) {
                throw new Exception("Token tetapan semula tidak sah atau telah tamat tempoh");
            }

            $_SESSION['success'] = "Kata laluan telah berjaya ditetapkan semula. Sila log masuk dengan kata laluan baharu anda.";
            header('Location: /userlogin');
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = "Ralat berlaku semasa menetapkan semula kata laluan";
            header('Location: /reset-password?token=' . urlencode($_POST['token']));
            exit;
        }
    }

    public function loanCalculator()
    {
        $this->view('users/loan_calculator');
    }

}