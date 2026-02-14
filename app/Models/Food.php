<?php
namespace App\Models ;
use App\core\DB ;

class Food {
    public static function addNewFood($name , $details, $typeID , $image){
        $query = "INSERT INTO foods (name,details,typeID ,image) VALUES (:n,:d,:t,:i)" ;
        $id = DB::queryExecuter($query , ['n' => $name , 'd' => $details , 't'=>$typeID , 'i'=> $image] , 'id');
    }
    public static function getAllFoods(){
        $query = "SELECT id,name,details,image,types.name as type , price FROM foods LEFT JOIN types on types.id = foods.typeID";
        return $result = DB::queryExecuter($query,[],'fetchall');
    }

    public static function deleteFood($id){
        $query = "DELETE FROM foods WHERE id = :i";
        return DB::queryExecuter($query,['i'=>$id],'check');
    }

    public static function getTypePrice($typeID){
        $query = "SELECT price FROM types WHERE id = :i " ;
        $result = DB::queryExecuter($query ,['i' => $typeID ],'fetch');
        return $result ;
    }


    public static function calculateFoodPrice($foodID) {
        $query = "SELECT typeID FROM foods where id =:i";
        $food = DB::queryExecuter($query,['i' => $foodID],'fetch');
        return self::getTypePrice($food['typeID']);
    }
}

?>