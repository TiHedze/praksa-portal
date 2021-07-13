
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <!--<a href="./../src/view/login/login.php" class="navbar-brand">Profil</a>-->
	<?php
		if(( !isset( $_SESSION['cname'] )&& (!isset( $_SESSION['user']) ))){
		
			echo '<a href="./../src/view/login/login.php" class="navbar-brand">Prijava</a>';
		}
		if( isset( $_SESSION['cname'] ) ){
			echo 'Praksa';
			echo '<br>';
			echo 'Welcome, '.$_SESSION['cname']. ' !';	
					
			echo '<a class="navbar-brand"  href="./../src/view/ads/addNewAd.php">Stvori oglas</a>';
			echo '<a class="navbar-brand"  href="./../src/view/ads/myAds.php">Pogledaj svoje oglase</a>';

			echo '<form class="d-flex" method="POST" action="./index.php?rt=companyLogin/logout">' . 
				'<button class="btn bg-white" type="submit">Odjava</button>' . 
			'</form> ';
		}
		if( isset( $_SESSION['user'] ) ){
			echo 'Praksa';
			echo '<br>';
			echo 'Welcome, '.$_SESSION['user']. ' !';		
			
			echo '<form class="d-flex" method="POST" action="./index.php?rt=login/logout">' . 
				'<button class="btn bg-white" type="submit">Odjava</button>' . 
			'</form> ';

			//echo '<a class="navbar-brand"  href="./../src/view/ads/addNewAd.php">Stvori oglas</a>';
			//echo '<a class="navbar-brand"  href="./../src/view/ads/myAds.php">Pogledaj svoje oglase</a>';
		}
	?>
    <form class="d-flex" method="POST" action="./index.php?rt=ad/adSearch">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="company_name">
      <button class="btn bg-white" type="submit">Search</button>
    </form>
  </div>
</nav>