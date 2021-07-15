<?php
session_start();
$title = "My ads";
require_once __DIR__ . "/../../model/ad/ad.service.php";


$ads = AdService::getInstance()->getAdsByCompany( $_SESSION['cname'] );
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

















<!--
require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php"; 

	if( $myAdsList == [] ){
		echo 'You do not have any ads on your name!';
		exit(0);
	}
?>

<table>
  <tr>
    <th>My ads</th>
	<th>Description</th>
	<th>Salary</th>
  </tr>
	<?php /*
  foreach ($myAdsList as $ad ) {
    echo '<tr>' . '<td><a href="index.php?rt=ad/'.$ad->title.'">' . $ad->title . '</a></td>'
	 . '<td>' . $ad->text . '</td>'. '<td>' . $ad->salary . '</td>' . '</tr>';
  }
*/
   ?>
</table>
*/