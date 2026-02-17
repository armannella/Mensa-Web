<?php
namespace App\Controllers ;

use App\Models\Payment;
use App\Models\Reserve;
use App\Models\Student ;


class StudentController {
    public function showEditProfilePage(){
        require_once __DIR__ . '/../Views/student_profile.php' ;
    }

    public function getStudentProfile() {
        header("Content-Type: application/json");
        $id = $_SESSION['id'];
        $student = Student::getStudentByID($id);
        $studentinfo = ['name' => $student->getFullName() , 'image' => $student->image , 'matricola' => $student->matricola , 'username' => $student->username];
        echo json_encode($studentinfo);
    }

    public function changePassword(){
        header("Content-Type: application/json");
        $id = $_SESSION['id'];
        $student = Student::getStudentByID($id);

        $oldpass = $_POST['oldpassword'];
        $newPassword = $_POST['newpassword'];
        if($student->verifyPassword($oldpass))
            {
                if($student->verifyPassword($newPassword)){
                    echo json_encode(['status' => 'failed' , 'message' => 'new password is same as old password']);
                    return;
                }
                else {
                    $student->changePassword(password_hash($newPassword,PASSWORD_DEFAULT));
                    echo json_encode(['status' => 'successful' , 'message' => 'new password is set for you daddy' , 'redirect' => 'index.php?page=student-profile']);
                    return ;
                }
                
            }
        else {
                echo json_encode(['status' => 'failed' , 'message' => 'old pass word is not valid']);
        }
    }

    public function changeImage(){
        header("Content-Type: application/json");
        $id = $_SESSION['id'];
        $student = Student::getStudentByID($id);
        $rawimage = $_FILES['image']; 
        $ext = strtolower(pathinfo($rawimage['name'],PATHINFO_EXTENSION));
        $targetdir = __DIR__. '/../../public/assets/uploads/profiles/' ;
        $acceptable_ext = ['png' , 'jpg' , 'jpeg'];
        if(!in_array($ext,$acceptable_ext))
        {
            echo json_encode(['status'=>'failed' , 'message'=>'file extension not acceptable']);
            return ;
        } 
        $imagename = uniqid(rand(0,1000)).'.'.$ext;
        $imagedir = $targetdir.$imagename ;
        if(move_uploaded_file($rawimage['tmp_name'],$imagedir)){
            $student->changeImage($imagename);
            $_SESSION['image'] = $imagename ;
            echo json_encode(['status'=>'success' , 'message'=>'added successfully' , 'redirect' => 'index.php?page=student-profile']);
        }
        else {
            echo json_encode(['status'=>'failed' , 'message'=>'problem to upload in server']);
    }
    }


    public function showPaymentsPage(){
        require_once __DIR__. '/../Views/payments.php';
    }

    public function addPayment(){
        header("Content-Type: application/json");
        $id = $_SESSION['id'];
        $student = Student::getStudentByID($id);
        $amount = $_POST['amount'];

        Payment::addNewPayment($id,$amount);
        $student->increaseBalance($amount);

        echo json_encode(['status' => 'success' , 'message' => "Your wallet increased $amount Euros" , 'redirect' => 'index.php?page=payments']);
    }

    public function getWalletInfo(){
        header("Content-Type: application/json");
        $id = $_SESSION['id'];
        $student = Student::getStudentByID($id);
        $transactions = Payment::getAllPayments($id);


        echo json_encode(['transactions'=>$transactions,'balance' => $student->getBalance()]);
    }



}


?>