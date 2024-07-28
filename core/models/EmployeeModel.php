<?php

declare(strict_types=1);

namespace Core\Models;

class EmployeeModel{
    private DBConnect $connect;

    public function __construct(){
        $this->connect = new DBConnect();
    }

    public function EmployeeAdd($data){

        $this->connect->query('INSERT INTO employees VALUES (NULL, :name, :lastname, :jobposition, :pesel, :phone, :email, :password, NULL, :role, :group);');
        $this->connect->bind(':name', $data['firsName']);
        $this->connect->bind(':lastname', $data['lastName']);
        $this->connect->bind(':jobposition', $data['jobPosition']);
        $this->connect->bind(':pesel', $data['PESEL']);
        $this->connect->bind(':phone', $data['phone']);
        $this->connect->bind(':email', $data['usersEmail']);
        $this->connect->bind(':password', $data['usersPwd']);
        $this->connect->bind(':role', $data['role']);
        if($data['employeeGroup'] != "BRAK")
        {
            $this->connect->bind(':group', $data['employeeGroup']);
        }else{
            $this->connect->bind(':group', null);
        }

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

    public function EmployeeShow(){
        $this->connect->query('SELECT * , COUNT(task_use.id_task_use) AS count_task FROM employees INNER JOIN working_group ON working_group.id_group = employees.id_group INNER JOIN task_use ON task_use.id_employee = employees.id_employee GROUP BY employees.name, employees.id_employee;');
    
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function EmployeeEdit($data){

        $this->connect->query('UPDATE employees SET name = :name, last_name = :lastname, job_position = :jobposition, pesel = :pesel, phone = :phone, email = :email, pass = :password WHERE employees.id_employee = :id ;');
        $this->connect->bind(':name', $data['firsName']);
        $this->connect->bind(':lastname', $data['lastName']);
        $this->connect->bind(':jobposition', $data['jobPosition']);
        $this->connect->bind(':pesel', $data['PESEL']);
        $this->connect->bind(':phone', $data['phone']);
        $this->connect->bind(':email', $data['usersEmail']);
        $this->connect->bind(':password', $data['usersPwd']);
        $this->connect->bind(':id', $data['id']);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function EmployeeDel($data){
        $this->connect->query('DELETE FROM employees WHERE employees.id_employee = :id');
        $this->connect->bind(':id', $data['id']);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function GroupShow(){
        $this->connect->query('SELECT id_group, name_group FROM working_group');
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }
}