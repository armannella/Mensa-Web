<?php
require_once __DIR__ . '/../vendor/autoload.php' ;

use App\Controllers\AuthController;
use App\Controllers\FoodController;
use App\Controllers\MenuController;

session_start();

$page = $_GET['page'] ?? 'welcome' ;


$student_pages = ['student-dashboard'];
$guest_only_pages = ['welcome','student-signup' , 'student-login' , 'canteen-login'];
$canteen_pages = ['canteen-dashboard' , 'foods' ,'show-addmenu'];

if ((in_array($page, $student_pages) || in_array($page, $canteen_pages)) && !isset($_SESSION['id'])) {
    header("Location: index.php?page=welcome");
    exit();
}

if (in_array($page, $student_pages) && $_SESSION['user'] == 'canteen') {
    header("Location: index.php?page=canteen-dashboard");
    exit();
}

if (in_array($page, $canteen_pages) && $_SESSION['user'] == 'student') {
    header("Location: index.php?page=student-dashboard");
    exit();
}

if (in_array($page, $guest_only_pages) && isset($_SESSION['id'])) {
    if($_SESSION['user']=='student'){
        header("Location: index.php?page=student-dashboard");
        exit();
    }
    header("Location: index.php?page=canteen-dashboard");
    exit();
}



$auth = new AuthController();
$food = new FoodController();
$menu = new MenuController();


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
    

    case 'student-dashboard' :
        $auth->showStudentDashboard();
        break ;

    case 'canteen-dashboard' :
        $auth->showCanteenDashboard();
        break ;
    
    case 'foods' :
        $food->showAddFoodPage();
        break ;
    
    case 'get-types' :
        $food->getAllTypes();
        break ;

    case 'add-food' :
        $food->addFood();
        break;
 
    case 'get-foods' :
        $food->getAllFoods();
        break ;
        
    case 'delete-food':
        $food->deleteFood();
        break;
    

    case 'show-addmenu' :
        $menu->showAddMenu();
        break ;

    case 'add-menu' :
        $menu->defineNewMenu();
        break ;


    default :
        $auth->welcome();
        break;
}


?>