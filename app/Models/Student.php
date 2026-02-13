<?php
namespace App\Models ;
use App\core\DB ;

class Student {
    private static $default_avatar = "default-profile-pic.png";
    public $id;
    public $Fname ;
    public $Lname ;
    public $username ;
    public $matricola ;
    private $password ;
    public $balance = 0.00 ;
    public $image;

    private function __construct($id, $Fname , $Lname , $matricola , $username , $password , $image)
    {
        $this->id = $id ;
        $this->Fname = $Fname ;
        $this->Lname = $Lname ;
        $this->matricola = $matricola ;
        $this->username = $username ;
        $this->password = $password ;
        $this->image = $image ;
    }

    public static function addNewStudent($Fname , $Lname , $matricola , $username , $password) : Student {
        $query = "INSERT INTO students(Fname,Lname,matricola,username,password,image) VALUES (:f,:l,:m,:u,:p,:i)" ;
        $id = DB::queryExecuter($query , ['f'=>$Fname , 'l'=>$Lname , 'm' => $matricola , 'u' => $username, 'p' =>$password , 'i' => self::$default_avatar] , 'id');
        return new Student($id, $Fname , $Lname , $matricola , $username , $password , self::$default_avatar) ;
    }

    public static function usernameAlreadyExist($username) : bool {
        $query = "SELECT * FROM students WHERE username = :u ";
        $result = DB::queryExecuter($query,['u' => $username],'fetch');
        if($result) {
            return true;
        }
        return false ;  
    }

    public static function getStudentByUsername($username) {
        $query = "SELECT * FROM students WHERE username = :u " ;
        $student = DB::queryExecuter($query , ['u' => $username] , 'fetch');
        if(!$student) {
            return null ;
        }
        else {
            return self::mapToStudent($student);
        }
    }
    
    public function verifyPassword($password) : bool {
        return password_verify($password , $this->password);
    }

    public static function getStudentByID($id) {
        $query = "SELECT * FROM students WHERE id = :i " ;
        $student = DB::queryExecuter($query , ['i' => $id] , 'fetch');
        if(!$student) {
            return null ;
        }
        else {
            return self::mapToStudent($student);
        }
    }

    public static function mapToStudent ($data) : Student {
        return new Student($data['id'], $data['Fname'] , $data['Lname'] , $data['matricola'] , $data['username'] , $data['password'] , $data['image']);
    }

    public function getFullName() {
        return $this->Fname . ' ' . $this->Lname ;
    }

}

?>