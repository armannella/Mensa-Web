<?php
require_once __DIR__ . '/../vendor/autoload.php' ;

use App\Controllers\AuthController;
use App\Controllers\FoodController;
use App\Controllers\MenuController;
use App\Controllers\ReserveController;
use App\Controllers\StudentController;

session_start();

$page = $_GET['page'] ?? 'welcome' ;


$student_pages = ['student-dashboard' , 'student-profile' , 'payments' , 'show-reserve' , 'active-reserves'];
$guest_only_pages = ['welcome','student-signup' , 'student-login' , 'canteen-login' , ];
$canteen_pages = ['canteen-dashboard' , 'foods' ,'show-addmenu' , 'active-meals' , 'deliver-foods'];

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
$student = new StudentController();
$reserve = new ReserveController();


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


    case 'student-profile' :
        $student->showEditProfilePage();
        break ; 
    
    case 'student-change-pass' :
        $student->changePassword();
        break ;
    
    case 'student-change-img' :
        $student->changeImage();
        break ;
    
    case 'student-get-info' :
        $student->getStudentProfile();
        break ;

    case 'payments' :
        $student->showPaymentsPage();
        break;
    
    case 'add-payment' :
        $student->addPayment();
        break ;
    
    case 'get-payments' :
        $student->getWalletInfo();
        break ;

    
    case 'show-reserve' :
        $reserve->showReservePage();
        break ;
    
    case 'get-canteens' :
        $menu->getAllCanteens();
        break;
    
    case 'get-available-menus' :
        $menu->getMenusOfCanteen();
        break ;
    
    case 'get-menu-details' :
        $menu->getMenuInfo();
        break;
    
    case 'get-live-price' :
        $reserve->liveCalculateFoodsPrice();
        break;
    
    case 'add-reserve' :
        $reserve->addReserve();
        break ;

    case 'active-reserves' :
        $reserve->showActiveReservesPage();
        break;
    
    case 'active-meals' :
        $reserve->showActiveMealsPage();
        break;

    
    case 'get-active-reserves':
        $reserve->getActiveReserves();
        break;
    
    case 'get-reserve-details' :
        $reserve->getReserveDetails();
        break;

    case 'deliver-foods':
         $reserve->showDeliverePage();
         break;
    
    case 'check-delivere' :
        $reserve->registerDelivery();
        break ;

    case 'get-active-meals' :
        $menu->getMenusOfCanteen();
        break;
    
    case 'get-student-reserve-info' :
        $reserve->getStudentInfoByReserveID();
        break;
    
    default :
        $auth->welcome();
        break;
}


?>