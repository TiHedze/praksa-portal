<?php 
class User {
    private $id, $name, $lastname, $username, $password_hash;

    private final function __construct($id, $name, $lastname, $username, $password_hash)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password_hash = $password_hash;        
    }

    public static function loginModel($id, $name, $lastname, $username, $password)
    {
        return new self($id, $name, $lastname, $username, $password);
    }

    public static function registerModel($name, $lastname, $username, $password)
    {
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);
        return new self(0,$name, $lastname, $username, $password_hash);
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