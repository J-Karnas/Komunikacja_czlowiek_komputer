<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\LoginModel;

class LoginController{

    public function loginView() : Void{

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $this->redirectGrant($_SESSION['userRight']);
        }else{
            (new View())->render("login");
        }
    }

    public function login():void{

        require_once 'core/tools/forwarding.php';
        
        $loginMod = new LoginModel();

        $data = [
            'email' => trim($_POST['email']),
            'userPwd' => trim($_POST['pwd'])
        ];
        

        if(empty($data['email']) || empty($data['userPwd'])){
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/");
        }

        if ($loginMod->findEmail($data['email'])) {
            $loggedInUser = $loginMod->login($data['email'], $data['userPwd']);
            if ($loggedInUser) {
                $loginMod->updateLastLogin($loggedInUser->id_employee);
                $this->createUserSession($loggedInUser);
            } else {
                $_SESSION["error"] = "Nie udało się zalogować";
                forwarding("/");
            }
            
        } else {
            $_SESSION["error"] = "Dane logowania są nieporawne";
            forwarding("/");
        }
        
    }

    private function redirectGrant(string $grant):void{
        switch ($grant) {
            case 'manager':
                forwarding("/manager");
                break;
            case 'user':
                forwarding("/user");
                break;
            default:
                forwarding("/access-denied");
                break;
        }
    }
 
    private function createUserSession($user):void{
        $_SESSION['status'] = "login";
        $_SESSION['usersId'] = $user->id_employee;
        $_SESSION['usersName'] = $user->name;
        $_SESSION['usersLastName'] = $user->last_name;
        $_SESSION['usersEmail'] = $user->email;
        $_SESSION['userRight'] = $user->employee_right;
        $_SESSION['firstLogin'] = $user->previous_login;
        $this->redirectGrant($_SESSION['userRight']);
    }

    public function logout():void{

        require_once 'core/tools/forwarding.php';

        unset($_SESSION['status']);
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersLastName']);
        unset($_SESSION['usersEmail']);
        unset( $_SESSION['userRight']);
        session_unset();
        session_destroy();
        forwarding("/");
    }
}