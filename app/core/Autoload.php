<?php

spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $path = __DIR__ . '/../../';
    $file = $path . str_replace('\\', '/', $class) . '.php';
    
    // Debug log to check the path being searched
    error_log("Attempting to load: " . $file);
    
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    
    return false;
});
