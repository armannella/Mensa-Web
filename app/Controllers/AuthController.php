<?php
namespace App\Controllers ;
use App\Models\Student ;
use App\Models\Canteen;

class AuthController {
    public function welcome() {
        require_once __DIR__ . '/../Views/welcome.php' ;
    }

    public function showStudentSignUp(){
        require_once __DIR__ . '/../Views/student_signup.php' ;
    }

    public function registerStudent(){
        header('Content-Type: application/json');
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $matricola = $_POST['matricola'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);

        if(Student::usernameAlreadyExist($username)){
            echo json_encode(['status'=>'failed' , 'message' => 'username is already taken']);
        }
        else {
            $student = Student::addNewStudent($Fname , $Lname , $matricola , $username , $password) ;   
            echo json_encode(['status'=>'success' , 'message' => 'you registered succesfully ! ']);
        }

    }

    public function showStudentLogin() {
        require_once __DIR__ . '/../Views/student_login.php' ;
    }

    public function loginStudent(){
        header('Content-Type: application/json');
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!Student::usernameAlreadyExist($username)){
            echo json_encode(['status'=>'failed' , 'message' => 'username is not found']);
        }
        else {
            $student = Student::getStudentByUsername($username) ;
            if($student->verifyPassword($password)){
                $_SESSION['id'] = $student->id;
                $_SESSION['user'] = "student";   
                echo json_encode(['status'=>'success' , 'message' => "Welcome dear ".$student->getFullName() ." ! "]);
            }
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        echo json_encode(['status'=>'success' , 'message' => "Good bye !"]);
    }


    public function showCanteenLogin() {
        require_once __DIR__ . '/../Views/canteen_login.php' ;
    }

    public function loginCanteen(){
        header('Content-Type: application/json');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $canteen = Canteen::getCanteenByUsername($username) ;
        if(!$canteen){
            echo json_encode(['status'=>'failed' , 'message' => 'username is not found']);
        }
        else { 
            if($canteen->verifyPassword($password)){
                $_SESSION['id'] = $canteen->id;
                $_SESSION['user'] = "canteen";   
                echo json_encode(['status'=>'success' , 'message' => "Welcome ".$canteen->name ." ! "]);
            }
        }
    }
}


?>