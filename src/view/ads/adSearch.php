<?php
session_start();
$title = "Ads I applied to";
require_once __DIR__ . "/../../model/ad/ad.service.php";

//$adCompanyNameList = 
//$ads = AdService::getInstance()->getAdsByCompany( $_SESSION['name'] );
require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php";
if (count($adCompanyNameList) > 0) {
    foreach ($adCompanyNameList as $ad) {
        require __DIR__ . "/../homepage/ad.component.php";
    }
} else {
    $errorMessage = "No ads available";
    require __DIR__ . "/../login/login.error.php";
}
?>
<script src="./ad.js"></script>
<?php
require_once __DIR__ . "/../core/_footer.php";
?>
