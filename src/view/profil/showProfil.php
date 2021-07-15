<?php
$title = "Show profil";
require_once __DIR__ . "/../../model/profil/profil.service.php";
require_once __DIR__ . "/../../model/user/user.model.php";
//session_start();
//print_r($_SESSION['user']);
$profil = ProfilService::getInstance()->getProfilByStuudentId( $_SESSION['user']->id);
require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php";
if (($profil) !== null) {
    ?>
    <div class="container w-25">
    <div class="card mt-5 rounded-4">
        <div class="card-header bg-primary">
            <h2 class="card-title">Profil</h2>
        </div>
        <div class="card-body">

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-2"> <?php  echo $_SESSION['user']->name ?> <?php  echo $_SESSION['user']->lastname ?></h3>
                <h6 class="card-subtitle mb-2"> Dob : <?php echo $profil->age; ?></h6>
                <h6 class="card-subtitle mb-2">Fakultet : <?php echo $profil->college; ?></h6>
                <h6 class="card-subtitle mb-2">Prosjek ocjena : <?php echo $profil->grades; ?></h6>
                <h6 class="card-subtitle mb-2 text-muted">e-mail adresa : <?php echo $profil->email; ?></h6>
            </div>
        </div>
        </div>
    </div>
</div>

<?php
} else {
    $errorMessage = "No profile";
    require __DIR__ . "/../homepage/homepage.php";
}


?>

<?php require_once __DIR__ . "/../core/_footer.php"; ?>