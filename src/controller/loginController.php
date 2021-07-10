<?php

require_once __DIR__ . "/../model/DB.class.php";

class LoginController
{
    public function index() { 
        $data = array();
        $data["title"] = "Login";
        require __DIR__ . "/../view/login/login.php";
    }

    public function login() 
    {
        if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
        {
            echo $_REQUEST['username'] . ' ' . $_REQUEST['password'];
        }
    }

    public function register() {
        
     }

    public function logout() { }
} 
?>