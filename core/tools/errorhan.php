<?php

function errorhand($key)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
        echo '<div>' . $_SESSION[$key] . '</div>' ;
        unset($_SESSION[$key]); 
    }
}