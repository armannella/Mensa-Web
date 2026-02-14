<?php
namespace App\Models ;
use App\core\DB ;
use PDO;

class Reserve {
    public static function isReserveAlreadyExist($menuID , $studentID) {
        $query = "SELECT meal , menu_date FROM menus WHERE id = :i ";
        $result = DB::queryExecuter($query , ['i' =>$menuID] , 'fetch');

        $query = "SELECT * FROM menus LEFT JOIN reserves on menus.id = reserves.menuID WHERE studentID = :i AND meal = :m AND menu_date = :d" ;
        $answer = DB::queryExecuter($query , ['i' => $studentID , 'm' => $result['meal'] , 'd' =>$result['menu_date']] , 'fetch');

        if(!$answer){
            return false ;
        }
        else {
            return true ;
        }
    }

    public static function addReserve($menuID , $studentID,$price){
        $query = "INSERT INTO reserves(menuID,studentID,price) VALUES (:m ,:s ,:p) ";
        $id = DB::queryExecuter($query , ['m' =>$menuID , 's' =>$studentID , 'p' =>$price] , 'id');
        return $id ;
    }

    public static function addFoodsToReserve($reserveID, $foodID){
        $query = "INSERT INTO reserve_details(reserveID,foodID) VALUES (:r,:f)";
        DB::queryExecuter($query,['r' => $reserveID , 'f' =>$foodID] , 'check');
    }

    public static function delivereReserve($reserveID){
        $query = "UPDATE reserves SET status = 'delivered' where id = :i ";
        $result = DB::queryExecuter($query,['i'=>$reserveID],'check');
        return $result ;
    }

    public static function getActiveReservesOfStudent($studentID){
        $query = "SELECT reserves.id as reserveID , canteen.name as canteen , menu_date , meal 
        FROM reserves LEFT JOIN menus on menus.id = reserves.menuID  LEFT JOIN canteens on canteens.id = menus.canteenID 
        WHERE studentID = :s and status = :t and menu_date >= CURRENT_DATE 
        Order by menu_date ASC , meal DESC ;
        ";
        $result = DB::queryExecuter($query , ['s' => $studentID , 't' => 'delivered'] , 'fetchall');
        return $result ;
    }

    public static function getReserveDetails($reserveID) {
        $query = "SELECT name,typeID,image
        FROM reserve_details LEFT JOIN foods on foods.id = reserve_details.reserveID 
        Where reserveID = :r
        ";
        $result = DB::queryExecuter($query , ['r' => $reserveID] , 'fetchall');
        return $result ;
    }




    
    
}
?>