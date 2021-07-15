<?php

require_once __DIR__ . "/../model/DB.class.php";
require_once __DIR__ . '/../model/profil/profil.service.php';
require_once __DIR__ . '/../model/profil/profil.model.php';


    class ProfilController{
        private $profilService;

        public function __construct()
        {
            $this->profilService = ProfilService::getInstance();
        }

        public function search($request)
        {
            print_r($request);
        }

        public function profil()
        {
            session_start();

            $title = 'Profil';
            $ls = profilService::getInstance();
            $check = $ls->checkProfilById($_SESSION['user']->id);
            if( !$check ){
                $ls = profilService::getInstance();
                if( isset( $_POST['age']) && isset( $_POST['college']) && isset( $_POST['grades'] ) && isset( $_POST['email'] )){
                        //require_once __DIR__ . '/../view/profil/profil.php';
                        $check = $ls->createProfil( $_SESSION['user']->id, $_POST['age'], $_POST['college'], $_POST['grades'], $_POST['email'] );
                    if( !$check ){
                            $title = 'Opis već postoji!';
                            require_once __DIR__ . '/../view/profil/showProfil.php';
                        }
                        else{
                            $title = 'Uspjesno dodan profil!';
                            require_once __DIR__ . '/../view/profil/showProfil.php';
                        }
            
                    }
                else
                    require_once __DIR__ . '/../view/profil/profil.php';
            }
            else
                require_once __DIR__ . '/../view/profil/showProfil.php';
        }

        public function showProfil()
        {
            session_start();

            $title = "Show profil";
            $ls = profilService::getInstance();
            $check = $ls->checkProfilById($_SESSION['user']->id);
            if( $check ){
                $title = 'Profil';
                require_once __DIR__ . '/../view/profil/showProfil.php';
            }
            else{
                $title = 'Nemate profil!';
                require_once __DIR__ . '/../view/profil/profil.php';
            }
        }
    }
?>
