<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\RegisterModel;

class ManagerController{

    public function managerView() : Void{

        require_once 'core/tools/forwarding.php';

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            (new View())->render("manager");
        }else{
            forwarding("/403");
        }
    }

}