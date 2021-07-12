<?php

if( isset( $_POST['name'] ) ){
	$_SESSION['name'] = $_POST['name'];
	echo 'Praksa';
	echo '<br>';
	echo 'Welcome, '.$_SESSION['name']. ' !';
}
if( isset( $_POST['user'] ) ){
	$_SESSION['user'] = $_POST['user'];
	echo 'Praksa';
	echo '<br>';
	echo 'Welcome, '.$_SESSION['user']. ' !';
}
?>

<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <a href="./../src/view/login/login.php" class="navbar-brand">Profil</a>
    <form class="d-flex" method="POST" action="index.php?rt=ad/search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="companyName">
      <button class="btn bg-white" type="submit">Search</button>
    </form>
  </div>
</nav>