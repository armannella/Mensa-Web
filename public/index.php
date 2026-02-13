<?php
require_once __DIR__ . '/../vendor/autoload.php' ;

use App\Controllers\AuthController;
session_start();

$page = $_GET['page'] ?? 'welcome' ;

$auth = new AuthController();



switch($page){
    case 'welcome' :
        $auth->welcome();
        break;
    
    case 'student-signup' :
        $auth->showStudentSignUp();
        break;

    case 'do-student-signup' :
        $auth->registerStudent();
        break;
    
    case 'student-login' :
        $auth->showStudentLogin();
        break ;
    
    case 'do-student-login' :
        $auth->loginStudent();
        break;
    
    case 'canteen-login' :
        $auth->showCanteenLogin();
        break;
    
    case 'do-canteen-login':
        $auth->loginCanteen();
        break;

    case 'logout' :
        $auth->logout();
        break;
    
    default :
        $auth->welcome();
        break;
}


?>