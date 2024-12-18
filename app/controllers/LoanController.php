<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Loan;
use App\Models\User;
use Exception;

class LoanController extends Controller
{
    private $loan;
    private $user;

    public function __construct()
    {
        $this->loan = new Loan();
        $this->user = new User();
    }

    public function registerLoan()
    {
         // Fetch all users from the database
         $loans = $this->loan->all();           

         // Pass the data to the 'users/index' view
         $this->view('loans/registerLoan', compact('loans'));
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
            // Check if user already exists (you'll need to implement this in your User model)
            if ($this->user->findByIcNumber($_POST['email'])) {
                $_SESSION['error'] = "Member with this IC number already exists.";
                header('Location: /registerLoan');
                return;
            }

            // Your existing registration logic
            $this->loan->registerLoan($_POST);
            
            $_SESSION['success'] = "Registration successful! Welcome to KADA.";
            header('Location: /');
            
        } catch (Exception $e) {
            $_SESSION['error'] = "An error occurred during registration. Please try again.";
            header('Location: /registerLoan');
        }
    }
    public function loanCalculator() {
        // Load the loan calculator view
        return $this->view('loans/loanCalculator');
    }
    

    

}
