<?php 

class ProfilModel {
    private $id, $student_id, $age, $college, $grades, $email;

    private final function __construct($id, $student_id, $age, $college, $grades, $email)
    {
        $this->id = $id;
        $this->student_id = $student_id;
        $this->age = $age;
        $this->college = $college;
        $this->grades = $grades;        
        $this->email = $email;
    }

    public static function retriveProfil($id, $student_id, $age, $college, $grades, $email)
    {
        return new self($id, $student_id, $age, $college, $grades, $email);
    }

    public static function createProfil($student_id, $age, $college, $grades, $email)
    {
        return new self(0,$student_id, $age, $college, $grades, $email);
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

}
?>