<?php 
namespace App\Controllers ;

use App\Models\Reserve;
use App\Models\Food;
use App\Models\Menu;
use App\Models\Student;
use BcMath\Number;

class ReserveController {
    public function addReserve(){
        header('Content-Type: application/json');
        $json = file_get_contents("php://input");
        $data = json_decode($json ,  true) ;
        $studentID = $_SESSION['id'];
        $menuID = $data['menuID'];
        $foodsID = $data['foods'] ;
        $student = Student::getStudentByID($studentID);



        if(Reserve::isReserveAlreadyExist($menuID,$studentID))
            {
                echo json_encode(['status' => 'failed' , 'message' => "you already reserved for this menu" , 'redirect' => "index.php?page=show-reserve"]);
                return ;
            }
        else {
            $price = $this->calculateFoodsPrice($foodsID);
            $balance = $student->getBalance();
            if($balance <  $price){
                echo json_encode(['status' => 'failed' , 'message' => "your balance is $balance Euro but is lower than total price of food that is $price :( sorry charge your balance " , 'redirect' => 'index.php?page=payments']);
                return ;
            }


            // main part is here :

            $reserveID = Reserve::addReserve($menuID,$studentID,$price);
            foreach($foodsID as $food){
                Reserve::addFoodsToReserve($reserveID,$food);
                Menu::decreaseFoodQuantiy($menuID , $food);
            }
            $student->decreaseBalance($price);
            echo json_encode(['status' => 'success' , 'message' => 'reserved added successfully' , 'redirect' => 'index.php?page=student-dashboard']);
        }



    }

    public function calculateFoodsPrice($foods){
        $total = 0.00 ;
        foreach($foods as $food){
            $result = Food::calculateFoodPrice($food);
            $total+= $result['price'];
        }
        return $total ;
    }

    public function liveCalculateFoodsPrice(){
        header('Content-Type: application/json');
        $json = file_get_contents("php://input");
        $data = json_decode($json ,  true) ;
        $foods = $data['foods'] ;
        $total = 0.00 ;
        foreach($foods as $food){
            $result = Food::calculateFoodPrice($food);
            $total += $result['price'];
        }
        echo json_encode(['total' =>$total]);
    }

    public function getActiveReserves() {
        header('Content-Type: application/json');
        $studentID = $_SESSION['id'];
        $result = Reserve::getActiveReservesOfStudent($studentID);
        echo json_encode($result);
    }

    public function getReserveDetails(){
        header('Content-Type: application/json');
        $json = file_get_contents("php://input");
        $data = json_decode($json ,  true) ;
        $reserveID = $data['reserveID'];
        $result = Reserve::getReserveDetails($reserveID);
        echo json_encode($result);
    }

    public function showReservePage(){
        require_once __DIR__ . '/../Views/reserve1_select_mensa.php';
    }

    
     
}



?>