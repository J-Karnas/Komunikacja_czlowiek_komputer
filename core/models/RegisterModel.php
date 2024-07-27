<?php

declare(strict_types=1);

namespace Core\Models;

class RegisterModel{
    private DBConnect $connect;

    public function __construct(){
        $this->connect = new DBConnect();
    }

    public function register($data){

        $this->connect->query('INSERT INTO employees VALUES (NULL, :name, :lastname, :pesel, :phone, :email, :password, NULL, :role, NULL);');
        $this->connect->bind(':name', $data['firsName']);
        $this->connect->bind(':lastname', $data['lastName']);
        $this->connect->bind(':pesel', $data['PESEL']);
        $this->connect->bind(':phone', $data['phone']);
        $this->connect->bind(':email', $data['usersEmail']);
        $this->connect->bind(':password', $data['usersPwd']);
        $this->connect->bind(':role', $data['role']);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findEmail($email){
        $this->connect->query('SELECT * FROM employees WHERE email = :email');
        $this->connect->bind(':email', $email);
    
        $row = $this->connect->single();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }
}