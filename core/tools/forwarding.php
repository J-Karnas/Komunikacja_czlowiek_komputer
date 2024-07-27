<?php

    function forwarding(string $url): void{
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url);
        exit;
    }