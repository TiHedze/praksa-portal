<?php
$title = "Show company data";
require_once __DIR__ . "/../../model/company/company.service.php";
require_once __DIR__ . "/../../model/company/company.model.php";
//session_start();
//print_r($_SESSION['company']);
//$company = CompanyService::getInstance()->getProfilByStuudentId( $_SESSION['user']->id);
require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php";
if (($title) !== null) {
    ?>
    <div class="container w-25">
    <div class="card mt-5 rounded-4">
        <div class="card-header bg-primary">
            <h2 class="card-title">Podaci o tvrtci</h2>
        </div>
        <div class="card-body">

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-2"> <?php  echo $_SESSION['company']->name ?> </h3>
                <h6 class="card-subtitle mb-2"> Vlasnik : <?php echo $_SESSION['company']->owner; ?></h6>
                <h6 class="card-subtitle mb-2"> OIB : <?php echo $_SESSION['company']->oib; ?></h6>
                <h6 class="card-subtitle mb-2"> e-mail : <?php echo $_SESSION['company']->email; ?></h6>
                <h6 class="card-subtitle mb-2"> Industrija : <?php echo $_SESSION['company']->industry; ?></h6>
                <h6 class="card-subtitle mb-2"> Broj zaposlenih : <?php echo $_SESSION['company']->employees; ?></h6>
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