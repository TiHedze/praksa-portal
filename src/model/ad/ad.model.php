<?php

class AdModel {
    private $id, $title, $companyId, $text, $companyName, $salary;

    private final function __construct($id, $title, $companyId, $text, $companyName, $salary)
    {
        $this->id = $id;
        $this->title = $title;
        $this->companyId = $companyId;
        $this->text = $text;
        $this->companyName = $companyName;
        $this->salary = $salary;
    }

    public static function createAd($title, $companyId, $text, $companyName, $salary)
    {
        return new self(0, $title, $companyId, $text, $companyName, $salary);
    }

    public static function retrieveAd($id, $title, $companyId, $text, $companyName, $salary)
    {
        return new self($id, $title, $companyId, $text, $companyName, $salary);
    }

    public function __get($name)
    {
        return $this->$name;
    }
}

?>