<?php
require_once __DIR__ . '/../vendor/autoload.php' ;

use App\Controllers\AuthController;
use App\Controllers\FoodController;
use App\Controllers\MenuController;

session_start();

$page = $_GET['page'] ?? 'welcome' ;
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


    default :
        $auth->welcome();
        break;
}


?>