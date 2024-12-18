<?php
namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        // Extract data array into variables
        extract($data);

        // Construct the full path to the view file
        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {
            require $file;
        } else {
            die("View file not found: " . $file);
        }
    }
}
