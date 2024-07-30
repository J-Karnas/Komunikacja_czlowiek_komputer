<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\TaskModel;

class TaskController{
 
    public function taskView() : Void{

        require_once 'core/tools/forwarding.php';

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $taskModel = new TaskModel();
        
            $paramTable['TaskShowEnded'] = $taskModel->TaskShow("ended");
            $paramTable['TaskShowDuring'] = $taskModel->TaskShow("during");
            $paramTable['TaskShowNotStarted'] = $taskModel->TaskShow("not_started");

            $paramTable['GroupShow'] = $taskModel->GroupShow();

            $paramTable['EmployeShow'] = $taskModel->EmployeShow();

            (new View())->render("task", $paramTable);
        }else{
            forwarding("/403");
        }
    }

    public function taskAdd():void{

        require_once 'core/tools/forwarding.php';
        
        $taskMod = new TaskModel();

        $data = [
            'title' => trim($_POST['title']),
            'description' => trim($_POST['description']),
            'priority' => trim($_POST['priority']),
            'employeeGroup' => trim($_POST['employeeGroup']),
            'employee' => trim($_POST['employee']),
            'startData' => trim($_POST['startData']),
            'stopData' => trim($_POST['stopData']),
            'file_path' => trim($_POST['file_path'])
        ];
        
        if (empty($data['title']) || empty($data['description']) ||  empty($data['priority']) ||  empty($data['employeeGroup']) ||  empty($data['employee']) ||  empty($data['startData']) ||  empty($data['stopData'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/task");
        }

        if($taskMod->TaskAdd($data)){

            $id_task = $taskMod->LastTaskIdShow($data);

            if($data['employeeGroup'] != "BRAK")
            {
                $id_employee = $taskMod->GroupIdShow($data['employeeGroup']);

                $taskMod->AddTaskUseGroup($id_employee, $id_task['task_id']);
            }

            if($data['employee'] != "BRAK")
            {
                $taskMod->AddTaskUseEmployee($data['employee'], $id_task['task_id']);
            }
            $_SESSION["error"] = "Udało się";
            forwarding("/task");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/task");
        }
        
    }

    public function taskEdit() : Void{

        require_once 'core/tools/forwarding.php';
        
        $taskMod = new TaskModel();

        $data = [
            'id' => $_POST['id'],
            'taskTitle' => trim($_POST['taskTitle']),
            'taskDescription' => trim($_POST['taskDescription']),
            'priority' => trim($_POST['priority']),
            'status' => trim($_POST['status']),
            'startDate' => trim($_POST['start_date']),
            'stopDate' => trim($_POST['stop_date'])
        ];
        
        if (empty($data['id']) || empty($data['taskTitle']) || empty($data['taskDescription']) || empty($data['priority']) || empty($data['status']) || empty($data['startDate']) || empty($data['stopDate'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/task");
        }

        if($taskMod->TaskEdit($data)){
            $_SESSION["error"] = "Udało się";
            forwarding("/task");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/task");
        }

    }

    public function taskDel() : Void{

        require_once 'core/tools/forwarding.php';
        
        $taskMod = new TaskModel();

        $data = [
            'id' => $_POST['id']
        ];

        if (empty($data['id'])) {
            $_SESSION["error"] = "Błąd przesłania ID";
            forwarding("/task");
        }

        if($taskMod->TaskDel($data)){
            $_SESSION["error"] = "Udało się usunąć";
            forwarding("/task");
        }else{
            $_SESSION["error"] = "Błąd";
            forwarding("/task");
        }

    }
}