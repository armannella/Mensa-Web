<?php
namespace App\Controllers ;
use App\Models\Food;

class FoodController{
    public function showAddFoodPage(){
        require_once __DIR__ . '/../Views/foods.php' ;
    }


    public function addFood(){
        header("Content-Type: application/json");
        $name = $_POST['name'];
        $details = $_POST['details'];
        $typeID = $_POST['typeID'];

        //image part : 

        $rawimage = $_FILES['image']; 

        $ext = strtolower(pathinfo($rawimage['name'],PATHINFO_EXTENSION));
        $targetdir = __DIR__. '/../../public/assets/uploads/foods/' ;
        $acceptable_ext = ['png' , 'jpg' , 'jpeg'];
        if(!in_array($ext,$acceptable_ext))
        {
            echo json_encode(['status'=>'failed' , 'message'=>'file extension not acceptable']);
            return ;
        } 
        $imagename = uniqid(rand(0,1000)).'.'.$ext;
        $imagedir = $targetdir.$imagename ;
        if(move_uploaded_file($rawimage['tmp_name'],$imagedir)){
            Food::addNewFood($name,$details,$typeID,$imagename);
            echo json_encode(['status'=>'success' , 'message'=>'added successfully' , 'redirect' => 'index.php?page=foods']);
        }
        else {
            echo json_encode(['status'=>'failed' , 'message'=>'problem to upload in server']);
    }
}


    public function getAllFoods(){
        header("Content-Type: application/json");
        echo json_encode(Food::getAllFoods());
    }

    public function deleteFood(){
        $json = file_get_contents("php://input");
        $data = json_decode($json,1);
        $result = Food::deleteFood($data['id']);
        if($result){
            echo json_encode(['status'=>'success' , 'message'=>'deleted successfully']);
        }
        else {
            echo json_encode(['status'=>'failed' , 'message'=>'problem to delete food try again :) !']);
        }
    }

    public function getAllTypes(){
        echo json_encode(Food::getAllTypes());
    }

}

?>