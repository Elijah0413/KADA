<?php
// Basic Router
$uri = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Database.php';

require_once '../app/controllers/UserController.php';
require_once '../app/models/User.php';

require_once '../app/controllers/LoanController.php';
require_once '../app/models/Loan.php';

require_once '../app/core/Autoload.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/models/Admin.php';

use App\controllers\UserController;
use App\controllers\AdminController;
use App\controllers\LoanController;





if ($uri === '' && $method === 'GET') {
    $controller = new UserController();
    $controller->index();
} elseif ($uri === 'register' && $method === 'GET') {
    $controller = new UserController();
    $controller->register();
} elseif ($uri === 'store' && $method === 'POST') {
    $controller = new UserController();
    $controller->store();
} elseif (preg_match('/edit\/(\d+)/', $uri, $matches) && $method === 'GET') {
    $controller = new UserController();
    $controller->edit($matches[1]);
} elseif ($uri === 'faqList' && $method === 'GET') {
    $controller = new UserController();
    $controller->faqList();
    
} elseif ($uri === 'registerLoan' && $method === 'GET') {
    $controller = new LoanController();
    $controller->registerLoan();
} elseif ($uri === 'storeLoan' && $method === 'POST') {
    $controller = new LoanController();
    $controller->storeLoan();   
} elseif ($uri === 'loantype' && $method === 'GET') {
    $controller = new LoanController();
    $controller->loantype();
}
elseif ($uri === 'loanCalculator' && $method === 'GET') {
    $controller = new LoanController();
    $controller->loanCalculator();
} elseif ($uri === 'loanCalculator' && $method === 'POST') {
    $controller = new LoanController();
    $controller->loanCalculator(); 
} 
elseif ($uri === 'info' && $method === 'GET') {
    $controller = new UserController();
    $controller->info();
}
elseif ($uri === 'login' && $method === 'GET') {
    $controller = new AdminController();
    $controller->login();
} else {
    http_response_code(404);
    echo "Page not found.";
}
