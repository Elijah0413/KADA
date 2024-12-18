<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
         // Fetch all users from the database
         $users = $this->user->all();

         // Pass the data to the 'users/index' view
         $this->view('users/index', compact('users'));
    }

    public function register()
    {
        $this->view('users/register');
    }

    public function store()
    {
        try {
            // Check if user already exists (you'll need to implement this in your User model)
            if ($this->user->findByIcNumber($_POST['email'])) {
                $_SESSION['error'] = "Member with this IC number already exists.";
                header('Location: /register');
                return;
            }

            // Your existing registration logic
            $this->user->register($_POST);
            
            $_SESSION['success'] = "Registration successful! Welcome to KADA.";
            header('Location: /');
            
        } catch (Exception $e) {
            $_SESSION['error'] = "An error occurred during registration. Please try again.";
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
    public function faqList() {
      
        return $this->view('users/faqList');
    }
    public function info()
    {
        // Simply render the info view
        $this->view('users/info');
    }

  

}
