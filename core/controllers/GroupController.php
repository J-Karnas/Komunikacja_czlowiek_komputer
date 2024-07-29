<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\GroupModel;

class GroupController{
 
    public function groupView() : Void{

        require_once 'core/tools/forwarding.php';

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            $groupModel = new GroupModel();
        
            $paramTable['GroupShow'] = $groupModel->GroupShow();
            $paramTable['GroupShowEmploye'] = $groupModel->GroupShowEmploye();

            (new View())->render("group", $paramTable);
        }else{
            forwarding("/403");
        }
    }

    public function groupAdd():void{

        require_once 'core/tools/forwarding.php';
        
        $groupMod = new GroupModel();

        $data = [
            'groupName' => trim($_POST['groupName']),
            'groupDescription' => trim($_POST['groupDescription']),
            'file_path' => trim($_POST['file_path'])
        ];
        
        if (empty($data['groupName']) || empty($data['groupDescription']) ||  empty($data['file_path'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/group");
        }

        if($groupMod->GroupAdd($data)){
            $_SESSION["error"] = "Udało się";
            forwarding("/group");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/group");
        }
        
    }

    public function groupEdit() : Void{

        require_once 'core/tools/forwarding.php';
        
        $groupMod = new GroupModel();

        $data = [
            'id' => $_POST['id'],
            'groupName' => trim($_POST['groupName']),
            'groupDescription' => trim($_POST['groupDescription']),
            'file_path' => trim($_POST['file_path']),
            'employeeGroupEmploye' => trim($_POST['employeeGroupEmploye'])
        ];
        
        if (empty($data['groupName']) || empty($data['groupDescription'])) {
            $_SESSION["error"] = "Uzupełnij wymagane dane";
            forwarding("/group");
        }

        if($data['employeeGroupEmploye'] != "BRAK")
        {
            $groupMod->GroupAddEmploye($data);
        }

        if($groupMod->GroupEdit($data)){
            $_SESSION["error"] = "Udało się";
            forwarding("/group");
        }else{
            $_SESSION["error"] = "Coś poszło nie tak";
            forwarding("/group");
        }

    }

    public function groupDel() : Void{

        require_once 'core/tools/forwarding.php';
        
        $groupMod = new GroupModel();

        $data = [
            'id' => $_POST['id']
        ];

        if (empty($data['id'])) {
            $_SESSION["error"] = "Błąd przesłania ID";
            forwarding("/group");
        }

        if($groupMod->GroupDel($data)){
            $_SESSION["error"] = "Udało się usunąć";
            forwarding("/group");
        }else{
            $_SESSION["error"] = "Błąd";
            forwarding("/group");
        }

    }
}