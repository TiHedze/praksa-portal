<?php
//session_start();
$title = "My applications";
require_once __DIR__ . "/../../model/ad/ad.service.php";


$ads = AdService::getInstance()->getAdsByStudent( $_SESSION['user']->id );
require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php";
if (count($ads) > 0) {
    foreach ($ads as $ad) {
        require __DIR__ . "/../homepage/ad.component.php";
    }
} else {
    $errorMessage = "No ads available";
    require __DIR__ . "/../login/login.error.php";
}
?>
<script src="./../view/homepage/ad.js"></script>
<?php
require_once __DIR__ . "/../core/_footer.php";
?>
