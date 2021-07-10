<?php 
require_once __DIR__ . "/user.model.php";
class UserService {
    private static $instance;
    private $db;
    
    private final function __construct($db) { 
        $this->db = $db;
     }

    private final function __clone() {  }

    public static function getInstance()
    {
        if(UserService::$instance == null)
        {
            UserService::$instance = new UserService(DB::getInstance());
        }

        return UserService::$instance;
    }

    public function getUserByUsername($username)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE username=:username');
        $query->execute(array('username' => $username));

        $row = $query->fetch();

        if($row === false)
        {
            return null;
        }

        return User::loginModel($row['id'], $row['name'], $row['lastname'], $row['username'], $row['password']);
    }

    public function createUser($user)
    {
        $query = $this->db->prepare('INSERT INTO users (name, lastname, username, password) VALUES(:name, :lastname, :username, :password)');
        $query->execute(array('name' => $user->name, 'lastname' => $user->lastname, 'username' => $user->username, 'password' => $user->password_hash));

        return $query = $this->getUserByUsername($user->username);
    }
}
