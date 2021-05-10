<?php

require_once __DIR__ . "/../model/DB.class.php";

class LoginController
{
    public function index() { }

    public function login() 
    {
        if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
        {

        }
    }

    public function register() { }

    public function logout() { }
} 
?>