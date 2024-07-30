<?php

declare(strict_types=1);

namespace Core\Models;

class TaskModel{
    private DBConnect $connect;

    public function __construct(){
        $this->connect = new DBConnect();
    }

    public function TaskAdd($data){

        $this->connect->query('INSERT INTO task VALUES (NULL, :title, :description, :priority, :startData, :stopData, NULL, "not_started", :file_path);');
        $this->connect->bind(':title', $data['title']);
        $this->connect->bind(':description', $data['description']);
        $this->connect->bind(':priority', $data['priority']);
        $this->connect->bind(':startData', $data['startData']);
        $this->connect->bind(':stopData', $data['stopData']);
        $this->connect->bind(':file_path', $data['file_path']);

        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function LastTaskIdShow(){
        $this->connect->query('SELECT MAX(id_task) as task_id FROM task LIMIT 1;');
        $row = $this->connect->singleArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function GroupIdShow($id){
        $this->connect->query('SELECT id_employee FROM employees WHERE id_group = :id;');
        $this->connect->bind(':id', $id);
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }


    public function AddTaskUseEmployee($id_employee, $id_task){
        $this->connect->query('INSERT INTO task_use VALUES (NULL, :id_employee, :id_task);');
        $this->connect->bind(':id_employee', $id_employee);
        $this->connect->bind(':id_task', $id_task);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function AddTaskUseGroup($id_group, $id_task){
        
        foreach($id_group as $ids){
            $this->connect->query('INSERT INTO task_use VALUES (NULL, :id_employee, :id_task);');
            $this->connect->bind(':id_employee', $ids['id_employee']);
            $this->connect->bind(':id_task', $id_task);
            if(!$this->connect->execute()){
                return false;
            }
        }
        return true;
    }

    public function TaskEdit($data){

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

    public function TaskDel($data){
        $this->connect->query('DELETE FROM working_group WHERE working_group.id_group = :id');
        $this->connect->bind(':id', $data['id']);
        if($this->connect->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function TaskShow($status){
        $this->connect->query('SELECT * FROM task WHERE status = :status;');

        $this->connect->bind(':status', $status);
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
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

    public function EmployeShow(){
        $this->connect->query('SELECT * FROM employees;');
        $row = $this->connect->allArray();
    
        if($this->connect->Count() > 0){
            return $row;
        }else{
            return false;
        }
    }


    // public function GroupShowEmploye(){
    //     $this->connect->query('SELECT id_employee, name, last_name FROM employees WHERE id_group IS NULL;');
    //     $row = $this->connect->allArray();
    
    //     if($this->connect->Count() > 0){
    //         return $row;
    //     }else{
    //         return false;
    //     }
    // }

    // public function GroupAddEmploye($data){
    //     $this->connect->query('UPDATE employees SET id_group = :group WHERE employees.id_employee = :idEmploye;');
    //     $this->connect->bind(':idEmploye', $data['employeeGroupEmploye']);
    //     $this->connect->bind(':group', $data['id']);
    //     if($this->connect->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
}