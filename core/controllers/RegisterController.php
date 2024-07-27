<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\RegisterModel;

class RegisterController{

    public function registerView() : Void{
        (new View())->render("register");
    }

    public function register():void{

        require_once 'core/tools/forwarding.php';
        
        $registerMod = new RegisterModel();

        $data = [
            'firsName' => trim($_POST['firsName']),
            'lastName' => trim($_POST['lastName']),
            'PESEL' => trim($_POST['PESEL']),
            'phone' => trim($_POST['phone']),
            'usersEmail' => trim($_POST['email']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat'])
        ];
        
        if (empty($data['firsName']) || empty($data['lastName']) || empty($data['PESEL']) || empty($data['phone']) || empty($data['usersEmail']) || empty($data['usersPwd']) || empty($data['pwdRepeat'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/register");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['firsName'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie użytkownika";
            forwarding("/register");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['lastName'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie użytkownika";
            forwarding("/register");
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"] = "Niepoprawny email";
            forwarding("/register");
        }

        if(!strlen($data['phone']) == 9){
            $_SESSION["error"] = "Niepoprawny numer telefonu";
            forwarding("/register");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['phone'])){
            $_SESSION["error"] = "Niepoprawny numer telefonu2";
            forwarding("/register");
        }

        if(!strlen($data['PESEL']) == 11){
            $_SESSION["error"] = "Niepoprawny numer telefonu";
            forwarding("/register");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['PESEL'])){
            $_SESSION["error"] = "Niepoprawny numer telefonu2";
            forwarding("/register");
        }

        if(strlen($data['usersPwd']) < 6){
            $_SESSION["error"] = "Niepoprawne hasło";
            forwarding("/register");
        }else if($data['usersPwd'] !== $data['pwdRepeat']){
            $_SESSION["error"] = "Hasła nie sa takie same";
            forwarding("/register");
        }

        if($registerMod->findEmail($data['usersEmail'])){
            $_SESSION["error"] = "Adres email jest już zajęty";
            forwarding("/register");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        $data['role'] = $this->getUserRole();

        if($registerMod->register($data)){
            $_SESSION["error"] = "Udało się";
            forwarding("/register");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/register");
        }
        
    }



    private function getUserRole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['role']) && $_POST['role'] === 'manager') {
                return 'manager';
            } else {
                return 'user';
            }
        }
        return null;
    }
}