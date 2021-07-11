<?php 
class Company {
    private $id, $name, $password_hash, $owner, $oib, $email, $industry, $employees;

    private final function __construct($id, $name, $password_hash, $owner, $oib, $email, $industry, $employees)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password_hash = $password_hash;  
        $this->owner = $owner;
        $this->oib = $oib;
        $this->email = $email;        
        $this->industry = $industry;
        $this->employees = $employees;
    }

    public static function loginModel($id, $name, $password, $owner, $oib, $email, $industry, $employees)
    {
        return new self($id, $name, $password, $owner, $oib, $email, $industry, $employees);
    }

    public static function registerModel($name, $password, $owner, $oib, $email, $industry, $employees)
    {
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);
        return new self(0,$name, $password_hash, $owner, $oib, $email, $industry, $employees);
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