<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\EmployeeModel;

class EmployeeController{
 
    public function employeeView() : Void{

        require_once 'core/tools/forwarding.php';

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $registerModel = new EmployeeModel();
            
            $paramTable['EmployeeShow'] = $registerModel->EmployeeShow();
            $paramTable['GroupShow'] = $registerModel->GroupShow();
            (new View())->render("employee", $paramTable);
        }else{
            forwarding("/403");
        }
    }

    public function employeeAdd():void{

        require_once 'core/tools/forwarding.php';
        
        $registerMod = new EmployeeModel();

        $data = [
            'firsName' => trim($_POST['firsName']),
            'lastName' => trim($_POST['lastName']),
            'jobPosition' => trim($_POST['jobPosition']),
            'employeeGroup' => $_POST['employeeGroup'],
            'PESEL' => trim($_POST['PESEL']),
            'phone' => trim($_POST['phone']),
            'usersEmail' => trim($_POST['email']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat'])
        ];
        
        if (empty($data['firsName']) || empty($data['lastName']) || empty($data['jobPosition']) || empty($data['PESEL']) || empty($data['phone']) || empty($data['usersEmail']) || empty($data['usersPwd']) || empty($data['pwdRepeat'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/employee");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['firsName'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie użytkownika";
            forwarding("/employee");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['lastName'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie użytkownika";
            forwarding("/employee");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['jobPosition'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie stanowiska";
            forwarding("/employee");
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"] = "Niepoprawny email";
            forwarding("/employee");
        }

        if(!strlen($data['phone']) == 9){
            $_SESSION["error"] = "Niepoprawny numer telefonu";
            forwarding("/employee");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['phone'])){
            $_SESSION["error"] = "Niepoprawny numer telefonu";
            forwarding("/employee");
        }

        if(!strlen($data['PESEL']) == 11){
            $_SESSION["error"] = "Niepoprawny numer PESEL";
            forwarding("/employee");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['PESEL'])){
            $_SESSION["error"] = "Niepoprawny numer PESEL";
            forwarding("/employee");
        }

        if(strlen($data['usersPwd']) < 6){
            $_SESSION["error"] = "Niepoprawne hasło";
            forwarding("/employee");
        }else if($data['usersPwd'] !== $data['pwdRepeat']){
            $_SESSION["error"] = "Hasła nie sa takie same";
            forwarding("/employee");
        }

        if($registerMod->findEmail($data['usersEmail'])){
            $_SESSION["error"] = "Adres email jest już zajęty";
            forwarding("/employee");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        $data['role'] = $this->getUserRole();

        if($registerMod->EmployeeAdd($data)){
            $_SESSION["error"] = "Udało się";
            forwarding("/employee");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/employee");
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

    public function employeeEdit() : Void{

        require_once 'core/tools/forwarding.php';
        
        $registerMod = new EmployeeModel();

        $data = [
            'id' => $_POST['id'],
            'firsName' => trim($_POST['firsName']),
            'lastName' => trim($_POST['lastName']),
            'jobPosition' => trim($_POST['jobPosition']),
            'PESEL' => trim($_POST['PESEL']),
            'phone' => trim($_POST['phone']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersPwd' => trim($_POST['usersPwd']),
        ];
        
        if (empty($data['firsName']) || empty($data['lastName']) || empty($data['jobPosition']) || empty($data['PESEL']) || empty($data['phone']) || empty($data['usersEmail']) || empty($data['usersPwd'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/employee");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['firsName'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie użytkownika";
            forwarding("/employee");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['lastName'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie użytkownika";
            forwarding("/employee");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['jobPosition'])){
            $_SESSION["error"] = "Niedozwolone znaki w nazwie stanowiska";
            forwarding("/employee");
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"] = "Niepoprawny email";
            forwarding("/employee");
        }

        if(!strlen($data['phone']) == 9){
            $_SESSION["error"] = "Niepoprawny numer telefonu";
            forwarding("/employee");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['phone'])){
            $_SESSION["error"] = "Niepoprawny numer telefonu";
            forwarding("/employee");
        }

        if(!strlen($data['PESEL']) == 11){
            $_SESSION["error"] = "Niepoprawny numer PESEL";
            forwarding("/employee");
        }else if(!preg_match('/^[0-9]{9,15}$/', $data['PESEL'])){
            $_SESSION["error"] = "Niepoprawny numer PESEL";
            forwarding("/employee");
        }

        if(strlen($data['usersPwd']) < 6){
            $_SESSION["error"] = "Niepoprawne hasło";
            forwarding("/employee");
        }

        if($registerMod->findEmail($data['usersEmail'])){
            $_SESSION["error"] = "Adres email jest już zajęty";
            forwarding("/employee");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        if($registerMod->EmployeeEdit($data)){
            $_SESSION["error"] = "Udało się";
            forwarding("/employee");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/employee");
        }

    }

    public function employeeDel() : Void{

        require_once 'core/tools/forwarding.php';
        
        $registerMod = new EmployeeModel();

        $data = [
            'id' => $_POST['id']
        ];

        if (empty($data['id'])) {
            $_SESSION["error"] = "Błąd przesłania ID";
            forwarding("/employee");
        }

        if($registerMod->EmployeeDel($data)){
            $_SESSION["error"] = "Udało się usunąć";
            forwarding("/employee");
        }else{
            $_SESSION["error"] = "Błąd";
            forwarding("/employee");
        }

    }
}