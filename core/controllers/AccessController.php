<?php

declare(strict_types=1);

namespace Core\Controllers;

use Core\View\View;

class AccessController{

    public function unautAccess() : Void{
        (new View())->render("unaut-access");
    }

}