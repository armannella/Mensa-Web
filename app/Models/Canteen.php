<?php
namespace App\Models ;
use App\core\DB ;

class Canteen {
    public $id;
    public $name ;
    public $username ;
    private $password ;
    public $address ;

    public function __construct($id,$name ,$address,$username ,$password)
    {
        $this->id = $id;
        $this->name = $name ;
        $this->username = $username ;
        $this->password = $password ;
        $this->address = $address ;
    }

    public static function getCanteenByID($id) {
        $query = "SELECT * FROM canteens WHERE id = :i " ;
        $data = DB::queryExecuter($query , ['i' => $id] , 'fetch');
        if(!$data){
            return null;
        }
        return self::mapToCanteen($data);
    }

    public static function getCanteenByUsername($username) {
        $query = "SELECT * FROM canteens WHERE username = :u " ;
        $data = DB::queryExecuter($query , ['u' => $username] , 'fetch');
        if(!$data){
            return null;
        }
        return self::mapToCanteen($data);
    }

    public static function mapToCanteen ($data) : Canteen {
        return new Canteen($data['id'], $data['name'] , $data['address'], $data['username'] , $data['password']);
    }

    public function verifyPassword($password){
        return password_verify($password , $this->password);
    }


    public static function getAllCanteens(){
        $query = "SELECT id,name,address FROM canteens WHERE 1" ;
        $data = DB::queryExecuter($query , [] , 'fetchall');
        return $data;
    }
    
}

?>