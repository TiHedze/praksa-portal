<?php

require_once __DIR__ . "/../model/DB.class.php";
require_once __DIR__ . "/../model/user/user.service.php";
require_once __DIR__ . "/../model/user/user.model.php";

class LoginController
{
    private $userService;

    public function __construct()
    {
        $this->userService = UserService::getInstance();
    }

    public function index()
    {
        
        require __DIR__ . "/../view/homepage/homepage.php";
    }

    public function login($request)
    {
        $user = $this->userService->getUserByUsername($request['username']);
        if ($user->verifyPassword($request['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['username'] = $request['username'];
            require __DIR__ . "/../view/homepage/homepage.php";

        } else {
            $error = true;
            $errorMessage = "Wrong username and/or password.";
            require __DIR__ . "/../view/login/login.php";
        }
    }

    public function register($request)
    {

        $user = User::registerModel($request['name'], $request['lastname'], $request['username'], $request['password'], $request['role']);
        try {

            $this->userService->createUser($user);
            $this->login($request);
        } catch (PDOException $e) {

            $error = true;
            $errorMessage = "Username already exists!";
            require __DIR__ . "/../view/register/register.php";
        }
    }

    public function logout()
    {
        session_start();
        
        $title = 'Uspjesno ste se odjavili!';
		session_unset();
        session_destroy();
		require_once __DIR__ . "/../view/homepage/homepage.php";
    }
}
