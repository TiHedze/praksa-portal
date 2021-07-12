<?php

require_once __DIR__ . '/../model/user/user.service.php';

    class UsersController{
        public function index(){
            $ls = new userService;

            $title = 'Popis svih studenata';
            $userList = $ls->getAllUsers();

            require_once __DIR__ . '/../view/homepage/users_index.php';
        }
        
        public function profil(){
            $title = 'Profil';
            $ls = new userService;
            if( isset( $_POST['age']) && isset( $_POST['college']) && isset( $_POST['grades'] ) && isset( $_POST['email'] )){
                    require_once __DIR__ . '/../view/add_new_product.php';
                    $check = $ls->add_profil_desc( $_POST['age'], $_POST['college'], $_POST['grades'], $_POST['email'] );
            if( !$check ){
                    $title = 'Opis već postoji!';
                    require_once __DIR__ . '/../view/profil/profil.php';
                }
                else{
                    $title = 'Uspjesno dodan profil!';
                    require_once __DIR__ . '/../view/homepage/homepage.php';
                }
    
            }
            else
                    require_once __DIR__ . '/../view/profil/profil.php';
        }
    
    }
?>
