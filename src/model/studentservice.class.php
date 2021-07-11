<?php

require __DIR__ . '/DB.class.php';
require __DIR__ . '/user/user.model.php';
require __DIR__ . '/product.class.php';
require __DIR__ . '/sale.class.php';


class ebuyService
{
	public function getUserById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email,registration_sequence, has_registered  FROM dz2_users WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'] );
	}
	public function getUsersByUsername( $username )
	{
		$users = [];
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email,registration_sequence, has_registered  FROM dz2_users WHERE username=:username' );
			$st->execute( array( 'username' => $username ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		while( $row = $st->fetch() ){
			$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'] );
		}
		return $users;
	}


	public function getAllUsers( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email,registration_sequence, has_registered  FROM dz2_users' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']  );
		}

		return $arr;
	}



	public function getProductById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, name, description, price FROM dz2_products WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Product( $row['id'], $row['id_user'], $row['name'], $row['description'], $row['price'] );
	}

	public function getProductName($product_id){
	$db = DB::getConnection();

	$st = $db->prepare( 'SELECT * FROM dz2_products WHERE id=:id' );
				$st->execute( ['id' => $product_id] );

	$product = $st->fetch()['name'];
	return $product;
	}

	function getProductByUser( $username )
	{
		$products = [];
		$users = [];
		$value = 0;
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email, registration_sequence, has_registered FROM dz2_users');
			$st->execute( );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		while( $row = $st->fetch() ){
			$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']  );
		}

		foreach ($users as $user ) {
			if( $user->username == $username )
				$value = $user->id;
		}
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, name, description, price FROM dz2_products WHERE id_user=:id_user ORDER BY id' );
			$st->execute( array( 'id_user' => $value ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }


		while( $row = $st->fetch() )
		{
			$products[] = new Product( $row['id'], $row['id_user'], $row['name'], $row['description'], $row['price'] );
		}

		return $products;
	}


	public function getAllProducts()
	{
		$arr = array();
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, name, description, price FROM dz2_products' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		while( $row = $st->fetch() )
		{
			$arr[] = new Product( $row['id'], $row['id_user'], $row['name'], $row['description'], $row['price'] );
		}

		return $arr;
	}

	public function buy_product( $id_user, $id_product){
		$sales = [];

		$db = DB::getConnection();
		$st = $db->prepare( 'SELECT * FROM dz2_sales' );
		$st->execute();

		while( $row = $st->fetch() )
			$sales[] = new Sale( $row['id'], $row['id_product'], $row['id_user'], $row['rating'], $row['comment'] );

		foreach( $sales as $sale )
			if( $sale->id_user == $id_user && $sale->id_product == $id_product)
				return false;

		$st = $db->prepare( 'INSERT INTO dz2_sales(id_product, id_user, rating, comment ) VALUES (:id_product, :id_user, :rating, :comment )' );
			$st->execute( array( 'id_product' => $id_product, 'id_user' => $id_user, 'rating' => NULL, 'comment' => NULL ) );
		return true;
		}

	public function add_comment($Komentar, $Ocjena, $id_product){
		$users=[];

		$db = DB::getConnection();
		$st = $db->prepare( 'SELECT * FROM dz2_users' );
		$st->execute();

		while( $row = $st->fetch() )
			$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']);

		foreach( $users as $user)
			if( $user->username == $_SESSION['username'])
				$value = $user->id;

		$st = $db->prepare( 'UPDATE dz2_sales SET rating = :rating, comment = :comment WHERE id_user = :id_user and id_product = :id_product' );
			$st->execute( array( 'id_product'=>$id_product,'id_user' => $value, 'rating' => $Ocjena, 'comment' => $Komentar) );
		return true;
		}

public function add_new_product($productName, $productDescription, $productPrice){
	$users=[];
	$products = [];

	$db = DB::getConnection();
	$st = $db->prepare( 'SELECT * FROM dz2_products' );
	$st->execute();

	while( $row = $st->fetch() )
		$products[] = new Product( $row['id'], $row['id_user'], $row['name'], $row['description'], $row['price'] );

	foreach( $products as $product )
		if( $product->name == $productName)
			return false;

	$st = $db->prepare( 'SELECT * FROM dz2_users' );
	$st->execute();

	while( $row = $st->fetch() )
		$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']);

	foreach( $users as $user)
		if( $user->username == $_SESSION['username'])
			$value = $user->id;

	$st = $db->prepare( 'INSERT INTO dz2_products(id_user, name, description, price ) VALUES (:id_user, :name, :description, :price )' );
		$st->execute( array( 'id_user' => $value, 'name' => $productName, 'description' => $productDescription, 'price' => $productPrice ) );
	return true;
	}

	function getShoppingList( $username )
	{
		$products = [];
		$users = [];
		$shopping_bag = [];
		$value = 0;
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email, registration_sequence, has_registered FROM dz2_users');
			$st->execute( );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		while( $row = $st->fetch() ){
			$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']  );
		}

		foreach ($users as $user ) {
			if( $user->username == $username )
				$value = $user->id;
		}
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_product, id_user, rating, comment FROM dz2_sales WHERE id_user=:id_user ORDER BY id' );
			$st->execute( array( 'id_user' => $value ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }


		while( $row = $st->fetch() )
		{
			$shopping_bag[] = new Sale( $row['id'], $row['id_product'], $row['id_user'], $row['rating'], $row['comment'] );
		}

		foreach ($shopping_bag as $product ) {
			$products[] = ebuyService::getProductById($product->id_product);
		}

		return $products;
	}

	public function getProductByName( $pName )
	{

		$products = [];
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM dz2_products WHERE name LIKE CONCAT(\'%\', :name, \'%\')');
			//$st = $db->prepare( 'SELECT id, id_user, name, description, price FROM dz2_products WHERE name=:name ORDER BY id' );
			$st->execute( array( 'name' => $pName ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		while( $row = $st->fetch() )
		{
			$products[] = new Product( $row['id'], $row['id_user'], $row['name'], $row['description'], $row['price'] );
		}

		return $products;
	}

	public function getAllProductsById($product_id)
	{

		$sales = [];
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_product, id_user, rating, comment FROM dz2_sales WHERE id_product=:id_product ORDER BY id' );
			$st->execute( array( 'id_product' => $product_id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		while( $row = $st->fetch() )
		{
			$sales[] = new Sale( $row['id'], $row['id_product'], $row['id_user'], $row['rating'], $row['comment'] );
		}

		return $sales;
	}
	public function getAllSales($id_product){
      $sales = [];

      $db = DB::getConnection();

	    $st = $db->prepare( 'SELECT * FROM dz2_sales WHERE id_product=:id_product' );
      $st->execute( ['id_product' => $id_product] );

      while( $row = $st->fetch() )
          $sales[] = new Sale( $row['id'], $row['id_product'], $row['id_user'], $row['rating'], $row['comment']);

      return $sales;
  }


};

?>