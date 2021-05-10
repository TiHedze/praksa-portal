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
                DB::$instance = new PDO("");
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