<?php 

require "./src/api/AuthMeController.php";
require "./src/api/Sha256.php";


$hash_type = new sha256();

// UserReg("TestUser", "test1234", "test1@email.com", $hash_type);

function UserReg ($username, $password, $email, AuthmeController $controller) { 
    $controller->register($username, $password, $email, $controller);
}

function login_process($username, $password, AuthmeController $controller) {

    if( $controller->isUserRegistered($username)) {
        
        if($controller->checkPassword($username, $password)) {
        
            $data['status'] = 'success';
            $data['msg'] = "เข้าสู่ระบบสำเร็จ";
            

            return $data;
        
        } else { 
            
            $data['status'] = 'error';
            $data['msg'] = "รหัสผ่านหรือผู้ใช้ไม่ถูกต้อง";
            
            return $data;

        }
    
    } else { 

        $data['status'] = 'error';
        $data['msg'] = "ไม่พบผู้ใช้งาน";
        
        return $data;

    }

}

