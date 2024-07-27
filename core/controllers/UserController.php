<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;
use Core\Models\RegisterModel;

class UserController{

    public function userView() : Void{

        require_once 'core/tools/forwarding.php';

        if(isset($_SESSION['status']) && $_SESSION['status'] = "login"){
            (new View())->render("user");
        }else{
            forwarding("/403");
        }
    }

}