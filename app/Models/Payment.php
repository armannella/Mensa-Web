<?php
namespace App\Models ;
use App\core\DB ;

class Payment {
    public static function addNewPayment($studentID,$amount){ 
        $query= "INSERT INTO payments(studentID,amount) Values (:s,:a)";
        $result = DB::queryExecuter($query,['s'=> $studentID , 'a' => $amount],'check');
        return $result ;
    }

    public static function getAllPayments($studentID){
        $query = "(SELECT  created_date, price as amount, 'reservation' as type 
         FROM reserves 
         WHERE studentID = :id1)
         UNION 
         (SELECT created_date, amount, 'charge' as type 
         FROM payments 
         WHERE studentID = :id2)
         ORDER BY created_date DESC";
        $result =  DB::queryExecuter($query, ['id1' => $studentID, 'id2' => $studentID], 'fetchall');
        return $result ;
    }
}
?>