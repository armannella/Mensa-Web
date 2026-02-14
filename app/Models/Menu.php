<?php
namespace App\Models ;
use App\core\DB ;
class Menu {
    public function __construct()
    {
    }

    public static function addMenu($menu_date,$meal,$canteenID){
        $query = "INSERT INTO menus(menu_date,meal,canteenID) VALUES (:d , :m , :c)";
        $id = DB::queryExecuter($query,['d' => $menu_date , 'm' => $meal , 'c' => $canteenID],'id');
        return $id ;
    }
    public static function addFoodsToMenu($menuID,$foodID,$quantity){
        $query = "INSERT INTO menu_details(menuID,foodID,quantity) VALUES (:m,:f,:q)";
        DB::queryExecuter($query,['m' => $menuID , 'f' =>$foodID , 'q' => $quantity] , 'check');
    }

    public static function checkMenuExist($menu_date , $meal , $canteenID){
        $query = "SELECT * FROM menus WHERE menu_date = :d and meal = :m and canteenID = c ;";
        $result = DB::queryExecuter($query , ['d' => $menu_date , 'm' => $meal , 'c' => $canteenID] , 'fetch' );
        if(!$result) {
            return false ;
        }
        else {return true ;}
    }

    public static function getMenu($menu_date , $meal , $canteenID) {
        $query = "SELECT * FROM menus WHERE menu_date = :d AND  meal = :m AND canteenID = :c ;";
        $result = DB::queryExecuter($query , ['d' => $menu_date , 'm' => $meal , 'c' => $canteenID] , 'fetch' );
        return $result ;
    }

    public static function getAvailableMenusOfCanteen($canteenID){
        $query = "SELECT * FROM menus WHERE menu_date >= CURRENT_DATE AND canteenID = :c ;";
        $result = DB::queryExecuter($query , ['c' => $canteenID] , 'fetchall' );
        return $result ;
    }

    public static function getMenuFoods($menuID){
        $query = "SELECT foodID,quantity ,name,details,typeID,image FROM menus LEFT JOIN menu_details on menus.id = menu_details.menuID LEFT JOIN foods on menu_details.foodID= foods.id where menuID = :i";
        $result = DB::queryExecuter($query , ['i' => $menuID] , 'fetchall');
        return $result;
    }

    public static function decreaseFoodQuantiy($menuID , $foodID){
        $query = "UPDATE menu_details SET quantity = quantity - 1 where menuID = :m and foodID = :f" ;
        $result = DB::queryExecuter($query , ['m' => $menuID , 'f' =>$foodID ], 'check');
        return $result ;
    }

    

}

?>