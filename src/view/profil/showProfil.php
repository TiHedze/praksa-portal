<?php
$title = "Show profil";
require_once __DIR__ . "/../../model/profil/profil.service.php";
$profil = ProfilService::getInstance()->getProfilByStuudentId($_SESSION['user']->id);
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

        <div class="card" id=<?php echo $ad->id; ?>>
            <div class="card-body">
                <h5 class="card-title"><?php echo $profil->age; ?></h5>
                <h6 class="card-subtitle mb-2"><?php echo $profil->college; ?></h6>
                <p class="card-text mb-2"><?php echo $profil->grades; ?></p>
                <p class="card-text text-muted mb-2"><?php echo $profil->email; ?></p>
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