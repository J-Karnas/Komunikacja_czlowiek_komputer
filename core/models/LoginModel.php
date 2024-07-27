<?php

declare(strict_types=1);

namespace Core\Models;

class LoginModel {
    private DBConnect $connect;


    public function __construct(){
        $this->connect = new DBConnect();
    }

    public function login(string $nameOrEmail,string $password){
       
        $row = $this->findEmail($nameOrEmail);

        if($row == false) return false;

        $hashedPassword = $row->pass;
    
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function updateLastLogin(int $userId){
        $this->connect->query('UPDATE employees SET previous_login = NOW() WHERE id_employee = :userId;');
        
        $this->connect->bind(':userId', $userId);

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