<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;
use App\Models\Loan;
use App\Models\User;

class AdminController extends Controller
{
    private $admin;
    private $loan;
    private $user;

    public function __construct()
    {
        $this->admin = new Admin();
        $this->loan = new Loan();
        $this->user = new User();
    }

    public function login()
    {
        // Fetch all users from the database
        $admins = $this->admin->all();           

        // Pass the data to the 'users/index' view
        $this->view('admins/login', compact('admins'));
    }

    public function registerAdmin()
    {
       // Fetch all users from the database
       $admins = $this->admin->all();           

       // Pass the data to the 'users/index' view
       $this->view('admins/registerAdmin', compact('admins'));
    }


}