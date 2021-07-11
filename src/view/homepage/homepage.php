<?php 
$title = "Praksa Portal";
require_once __DIR__ . "/../core/_header.php";


if( isset( $_SESSION['user'] ) )
	echo 'praksa';
	echo '<br>';
	echo 'Dobrodošli, '.$_SESSION['user']. ' !';

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>Studentska praksa</title>

	<link rel="stylesheet" href="css/style.css">

</head>
<body>

	<nav>
		<ul>
			
			<li><a href="homepage.php?rt=users">Popis svih studenata</a></li>
            <!--
			<li><a href="index.php?rt=product/all_products">All products</a></li>
		
			<li><a href="index.php?rt=product/my_product">My products</a></li>
			<li><a href="index.php?rt=product/add_new_product">Add new product</a></li>
			<li><a href="index.php?rt=product/shopping_history">Shopping history</a></li>
			<li><a href="index.php?rt=product/products_search">Search</a></li>
			<li><a href="index.php?rt=login/logout">Logout</a></li>
            -->
		</ul>
	</nav>

		<h1><?php echo $title; ?></h1>
