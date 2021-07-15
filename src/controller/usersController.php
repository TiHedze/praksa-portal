<?php

require_once __DIR__ . '/../model/user/user.service.php';

    class UsersController{
        public function index(){
            $ls = new userService;

            $title = 'Popis svih studenata';
            $userList = $ls->getAllUsers();

            require_once __DIR__ . '/../view/homepage/users_index.php';
        }
        public function homepage()
        {
            session_start();

            require_once __DIR__ . '/../view/homepage/homepage.php';
        }
    }

    
?>
