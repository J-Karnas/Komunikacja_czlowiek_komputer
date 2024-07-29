<?php

declare(strict_types=1);

namespace Core\Models;

class GroupModel{
    private DBConnect $connect;

    public function __construct(){
        $this->connect = new DBConnect();
    }

    public function GroupAdd($data){

        $this->connect->query('INSERT INTO working_group (id_group, name_group, description, file_path) VALUES (NULL, :groupName, :groupDescription, :file_path);');
        $this->connect->bind(':groupName', $data['groupName']);
        $this->connect->bind(':groupDescription', $data['groupDescription']);
        $this->connect->bind(':file_path', $data['file_path']);
        // if($data['employeeGroup'] != "BRAK")
        // {
        //     $this->connect->bind(':group', $data['employeeGroup']);
        // }else{
        //     $this->connect->bind(':group', null);
        // }

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

    public function GroupEdit($data){

        $this->connect->query('UPDATE working_group SET name_group = :groupName, description = :groupDescription, file_path = :file_path WHERE working_group.id_group = :id;');
        $this->connect->bind(':groupName', $data['groupName']);
        $this->connect->bind(':groupDescription', $data['groupDescription']);
        $this->connect->bind(':file_path', $data['file_path']);
        $this->connect->bind(':id', $data['id']);
        
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function GroupDel($data){
        $this->connect->query('DELETE FROM working_group WHERE working_group.id_group = :id');
        $this->connect->bind(':id', $data['id']);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function GroupShow(){
        $this->connect->query('SELECT * FROM working_group');
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function GroupShowEmploye(){
        $this->connect->query('SELECT id_employee, name, last_name FROM employees WHERE id_group IS NULL;');
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function GroupAddEmploye($data){
        $this->connect->query('UPDATE employees SET id_group = :group WHERE employees.id_employee = :idEmploye;');
        $this->connect->bind(':idEmploye', $data['employeeGroupEmploye']);
        $this->connect->bind(':group', $data['id']);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }
}