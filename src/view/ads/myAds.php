<?php
require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php"; 
?>

<?php
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
	<?php
  foreach ($myAdsList as $ad ) {
    echo '<tr>' . '<td><a href="index.php?rt=ad/'.$ad->title.'">' . $ad->title . '</a></td>'
	 . '<td>' . $ad->text . '</td>'. '<td>' . $ad->salary . '</td>' . '</tr>';
  }

   ?>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>
