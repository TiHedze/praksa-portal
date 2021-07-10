<?php 
class User {
    private $id, $name, $lastname, $username, $password_hash, $role;

    private final function __construct($id, $name, $lastname, $username, $password_hash, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password_hash = $password_hash;        
        $this->role = $role;
    }

    public static function loginModel($id, $name, $lastname, $username, $password, $role)
    {
        return new self($id, $name, $lastname, $username, $password, $role);
    }

    public static function registerModel($name, $lastname, $username, $password, $role)
    {
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);
        return new self(0,$name, $lastname, $username, $password_hash, $role);
    }

     public function __get($name)
    {
        return $this->$name;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password_hash);
    }
}
?>