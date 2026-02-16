<?php
namespace App\Controllers;

use App\Models\Canteen;
use App\Models\Menu;

class MenuController{

    public function showAddMenu(){
        require_once __DIR__ . "/../Views/add_menu.php";
    }

    
    public function defineNewMenu(){
        header('Content-Type: application/json');

        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        $menu_date = $data['menu_date'];
        $meal = $data['meal'];
        $canteenID = $_SESSION['id'];
        $foods = $data['foods'];

        if(Menu::checkMenuExist($menu_date , $meal , $canteenID)){
            echo json_encode(["status" => "failed" , "message" => "you defined menu for this meal before" , 'redirect' => 'index.php?page=canteen-dashboard']);
            return ;
        }
        else {
            $menuID = Menu::addMenu($menu_date , $meal , $canteenID);
            foreach($foods as $food) {
                Menu::addFoodsToMenu($menuID,$food['id'],$food['quantity']);
            }

            echo json_encode(["status" => "success" , "message" => "the menu for day $menu_date meal $meal added !" , 'redirect' => 'index.php?page=canteen-dashboard']);
        }
    }

    public function getAllCanteens(){
        echo json_encode(Canteen::getAllCanteens());
    }

    public function getMenusOfCanteen() {
        header('Content-Type: application/json');
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        $canteenID = $data['canteenID'];
        echo json_encode(Menu::getAvailableMenusOfCanteen($canteenID));
    }

    public function getMenuInfo(){
        header('Content-Type: application/json');
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        $menuID = $data['menuID'];
        $result = Menu::getMenuFoods($menuID);
        echo json_encode($result);
    }

}





?>