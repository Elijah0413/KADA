<?php
namespace App\Core;

use Exception;

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function view($view, $data = [])
    {
        // Debug log
        error_log("Loading view: " . $view);
        error_log("With data: " . print_r($data, true));

        // Extract data to make it available in the view
        extract($data);

        // Include the view file
        $viewFile = "../app/views/$view.php";
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            error_log("View file not found: " . $viewFile);
            throw new Exception("View not found: " . $view);
        }
    }

    protected function checkAuth()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /userlogin');
            exit;
        }
    }

    protected function debugSession($message = '')
    {
        error_log("Session Debug - $message: " . print_r($_SESSION, true));
    }
}
