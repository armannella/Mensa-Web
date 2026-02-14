<?php 
namespace App\Controllers ;

use App\Models\Reserve;
use App\Models\Food;
use App\Models\Menu;
use App\Models\Student;

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
                echo json_encode(['status' => 'failed' , 'message' => "you already reserved for this menu"]);
                return ;
            }
        else {
            $price = $this->calculateFoodsPrice($foodsID);
            $balance = $student->getBalance();
            if($balance <  $price){
                echo json_encode(['status' => 'failed' , 'message' => "your balance is $balance Euro but is lower than total price of food that is $price :( sorry charge your balance "]);
                return ;
            }


            // main part is here :

            $reserveID = Reserve::addReserve($menuID,$studentID,$price);
            foreach($foodsID as $food){
                Reserve::addFoodsToReserve($reserveID,$food);
                Menu::decreaseFoodQuantiy($menuID , $food);
            }
            $student->decreaseBalance($price);
            echo json_encode(['status' => 'success' , 'message' => 'reserved added successfully']);
        }



    }

    public function calculateFoodsPrice($foods){
        $total = 0;
        foreach($foods as $food){
            $total+= Food::calculateFoodPrice($food);
        }
        return $total ;
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

     
}



?>