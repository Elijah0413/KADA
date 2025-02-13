<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Loan;
use App\Models\Member;
use Exception;

class LoanController extends Controller
{
    private $loan;
    private $user;
    private $member;

    public function __construct()
    {
        $this->loan = new Loan();
        $this->member = new Member();
    }

    public function registerLoan()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            // Get existing member data
            $member = $this->member->findByUserId($_SESSION['user_id']);
            
            // Debug log
            error_log("Retrieved member data: " . print_r($member, true));

            // Map member data to loan application fields with default values
            $mappedMemberData = [
                'name' => $member['name'] ?? '',
                'no_ic' => $member['ic_no'] ?? '',
                'sex' => $member['gender'] ?? '',
                'religion' => $member['religion'] ?? '',
                'nationality' => $member['race'] ?? 'Chinese',
                'DOB' => $this->extractDOBFromIC($member['ic_no'] ?? ''),
                'add1' => $member['home_address'] ?? '',
                'postcode1' => $member['home_postcode'] ?? '',
                'state1' => $member['home_state'] ?? '',
                'add2' => $member['office_address'] ?? '',
                'postcode2' => $member['office_postcode'] ?? '',
                'state2' => $member['office_state'] ?? '',
                'memberID' => $member['member_number'] ?? '',
                'PFNo' => $member['pf_number'] ?? '',
                'position' => $member['position'] ?? '',
                'office_pNo' => $member['office_phone'] ?? '',
                'pNo' => $member['phone_number'] ?? '',
                'bankName' => $member['bank_name'] ?? '',
                'bankAcc' => $member['bank_account'] ?? ''
            ];
            
            // Debug log
            error_log("Mapped member data: " . print_r($mappedMemberData, true));

            $this->view('loans/registerLoan', [
                'member' => $member,
                'mappedMemberData' => $mappedMemberData,
                'states' => [
                    'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
                    'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sabah',
                    'Sarawak', 'Selangor', 'Terengganu', 'WP Kuala Lumpur',
                    'WP Labuan', 'WP Putrajaya'
                ]
            ]);
            
        } catch (\Exception $e) {
            error_log("Error in registerLoan: " . $e->getMessage());
            $_SESSION['error'] = "Ralat mendapatkan data profil: " . $e->getMessage();
            header('Location: /members');
            exit;
        }
    }
    public function loantype()
    {
        $loans = $this->loan->all();           

         // Pass the data to the 'users/index' view
         $this->view('loans/loantype', compact('loans'));
    }
    public function storeLoan()
    {
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new \Exception("Sila log masuk terlebih dahulu");
            }

            // Debug logging
            error_log("POST data received: " . print_r($_POST, true));
            error_log("FILES data received: " . print_r($_FILES, true));

            // Handle file uploads
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Handle file uploads
            if (isset($_FILES['basic_s']) && $_FILES['basic_s']['error'] === UPLOAD_ERR_OK) {
                $basic_s_path = $this->handleFileUpload($_FILES['basic_s'], $uploadDir);
                $_POST['basic_s_path'] = $basic_s_path;
            }

            if (isset($_FILES['net_s']) && $_FILES['net_s']['error'] === UPLOAD_ERR_OK) {
                $net_s_path = $this->handleFileUpload($_FILES['net_s'], $uploadDir);
                $_POST['net_s_path'] = $net_s_path;
            }

            if (isset($_FILES['signature']) && $_FILES['signature']['error'] === UPLOAD_ERR_OK) {
                $signature_path = $this->handleFileUpload($_FILES['signature'], $uploadDir);
                $_POST['signature_path'] = $signature_path;
            }

            // Add user_id to the data
            $_POST['user_id'] = $_SESSION['user_id'];

            // Ensure nationality is not null before database insertion
            $_POST['nationality'] = $_POST['nationality'] ?? 'Chinese';
            
            // Validate nationality
            if (empty($_POST['nationality'])) {
                $_POST['nationality'] = 'Chinese'; // Set default value if empty
            }

            // Debug logging
            error_log("Loan application data: " . print_r($_POST, true));

            // Register the loan
            $loanId = $this->loan->registerLoan($_POST);
            
            if ($loanId) {
                $_SESSION['success'] = "Permohonan pinjaman berjaya dihantar!";
                header('Location: /members/dashboard');
                exit;
            } else {
                throw new \Exception("Gagal mendaftar pinjaman");
            }

        } catch (\Exception $e) {
            error_log("Error in storeLoan: " . $e->getMessage());
            $_SESSION['error'] = "Ralat: " . $e->getMessage();
            header('Location: /registerLoan');
            exit;
        }
    }
    private function handleFileUpload($file, $uploadDir)
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFilename = uniqid() . '.' . $extension;
        $uploadFile = $uploadDir . $newFilename;

        if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
            throw new \Exception("Gagal memuat naik fail");
        }

        return $newFilename;
    }
    public function loanCalculator() {
        // Load the loan calculator view
        return $this->view('loans/loanCalculator');
    }
    public function viewLoan()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            // Get all loans for the current user
            $loans = $this->loan->getLoansByUserId($_SESSION['user_id']);
            
            // Pass the loans data to the view
            $this->view('loans/viewloan', ['loans' => $loans]);
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Error retrieving loan data: " . $e->getMessage();
            header('Location: /members');
            exit;
        }
    }
    private function validateLoanData($data) {
        $errors = [];

        // Validate loan amount
        if (!isset($data['t_amount']) || 
            !is_numeric($data['t_amount']) || 
            $data['t_amount'] < 1000 || 
            $data['t_amount'] > 200000) {
            $errors[] = "Jumlah pinjaman tidak sah. Mestilah antara RM1,000 hingga RM200,000";
        }

        // Validate loan period
        if (!isset($data['period']) || 
            !is_numeric($data['period']) || 
            $data['period'] < 12 || 
            $data['period'] > 240) {
            $errors[] = "Tempoh pinjaman tidak sah. Mestilah antara 12 hingga 240 bulan";
        }

        // Validate IC number
        if (!isset($data['no_ic']) || 
            !preg_match('/^\d{12}$/', $data['no_ic'])) {
            $errors[] = "Format nombor kad pengenalan tidak sah";
        }

        // Validate phone numbers
        if (!isset($data['pNo']) || 
            !preg_match('/^\d{9,11}$/', $data['pNo'])) {
            $errors[] = "Nombor telefon tidak sah";
        }

        // Validate guarantor information
        if (!isset($data['guarantor_ic']) || 
            !preg_match('/^\d{12}$/', $data['guarantor_ic'])) {
            $errors[] = "Nombor kad pengenalan penjamin 1 tidak sah";
        }

        if (!isset($data['guarantor_ic2']) || 
            !preg_match('/^\d{12}$/', $data['guarantor_ic2'])) {
            $errors[] = "Nombor kad pengenalan penjamin 2 tidak sah";
        }

        return $errors;
    }

    public function confirmLoan()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }

        try {
            // Validate the data
            $errors = $this->validateLoanData($_POST);

            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors);
                header('Location: /registerLoan');
                exit;
            }

            // Show confirmation page
            $this->view('loans/confirmLoan', ['formData' => $_POST]);

        } catch (Exception $e) {
            $_SESSION['error'] = "Ralat: " . $e->getMessage();
            header('Location: /registerLoan');
            exit;
        }
    }

    private function getLoanSchedule() {
        return [
            12 => [  // months
                1000 => 86.83,
                2000 => 173.67,
                3000 => 260.50,
                4000 => 347.33,
                5000 => 434.17,
                6000 => 521.00,
                7000 => 607.83,
                8000 => 694.67,
                9000 => 781.50,
                10000 => 868.33,
                11000 => 955.17,
                12000 => 1042.00,
                13000 => 1128.83,
                14000 => 1215.67,
                15000 => 1302.50,
                16000 => 1389.33,
                17000 => 1476.17,
                18000 => 1563.00,
                19000 => 1649.83,
                20000 => 1736.67
            ],
            24 => [
                1000 => 45.17,
                2000 => 90.33,
                // ... add all values for 24 months
            ],
            36 => [
                1000 => 31.28,
                2000 => 62.56,
                // ... add all values for 36 months
            ],
            48 => [
                1000 => 24.33,
                2000 => 48.67,
                // ... add all values for 48 months
            ],
            60 => [
                1000 => 20.17,
                2000 => 40.33,
                // ... add all values for 60 months
            ],
            72 => [
                1000 => 17.39,
                2000 => 34.78,
                // ... add all values for 72 months
            ]
        ];
    }

    private function extractDOBFromIC($icNo) {
        if (strlen($icNo) != 12) {
            return '';
        }

        // Extract year, month, and day from IC
        $year = substr($icNo, 0, 2);
        $month = substr($icNo, 2, 2);
        $day = substr($icNo, 4, 2);

        // Determine century
        $year = (int)$year;
        if ($year >= 0 && $year <= 30) {  // Adjust the range as needed
            $year += 2000;
        } else {
            $year += 1900;
        }

        // Format as YYYY-MM-DD for the date input
        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }
}