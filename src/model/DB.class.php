<?php
class DB
{
    private static $instance;

    private final function __construct() {  }

    private final function __clone() {  }

    public static function getInstance()
    {
        if(DB::$instance == null)
        {
            try 
            {
                DB::$instance = new PDO("mysql:host=rp2.studenti.math.hr;dbname=hedzet;charset=utf8","student", "pass.mysql");
                DB::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception)
            {
                exit($exception->getMessage());
            }
        }

        return DB::$instance;
    }
} 
?>