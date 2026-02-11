<?php
namespace App\core ;


use PDO;
use PDOException;

require_once __DIR__ . '/../../configs/db_config.php';


class DB {
    private static $instance = null ;
    private $conn ;

    private function __construct()
    {
        $this->conn = new PDO("mysql:host=".HOST.";dbname=".DB,USERNAME,PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(){
        if(self::$instance) {
            return self::$instance ;
        }
        else {
            self::$instance = new DB();
            return self::$instance ;
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    private function __clone() {}
    private function __wakeup() {}

    public static function queryExecuter($query,$params,$returntype){
        $db = DB::getInstance();
        $con = $db->getConnection();
        $stm = $con->prepare($query);
        $result = $stm->execute($params);
        switch($returntype){
            case 'id' :
                return $con->lastInsertId();
            case 'check' :
                return $result ;
            case 'fetch' :
                return $stm->fetch(PDO::FETCH_ASSOC);
            case 'fetchall' :
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            default :
                return false ;
        }
    }
}


?>