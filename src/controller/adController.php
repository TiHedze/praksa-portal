<?php 

require_once __DIR__ . "/../model/ad/ad.service.php";
require_once __DIR__ . "/../model/ad/ad.model.php";


class AdController 
{
    private $adService;

    public function __construct()
    {
        $this->adService = AdService::getInstance();
    }

    public function search($request)
    {
        print_r($request);
    }

    public function addNewAd( ){
		$title = 'Add new ad';
		$ls = AdService::getInstance();
		if( isset( $_POST['adTitle']) && isset( $_POST['adText']) && isset( $_POST['adSalary'] ) ){
			$check = $ls->addNewAd( $_POST['adTitle'], $_POST['adText'], $_POST['adSalary'] );
		if( !$check ){
				$title = 'Oglas vec postoji!';
				require_once __DIR__ . '/../view/ads/add_new_ad.php';
			}
			else{
				$title = 'Uspjesno dodan novi oglas!';
				require_once __DIR__ . '/../view/homepage/homepage.php';
			}

		}
		else
				require_once __DIR__ . '/../view/ads/add_new_ad.php';
	}

	public function myAds()
	{
		$ls = AdService::getInstance();

		if( !isset( $_SESSION['name'] ) || !preg_match( '/^[a-zA-Z ,-.]+$/', $_SESSION['name'] ) )
		{
			//header( 'Location: index.php?rt=books/search');
			exit();
		}

		$title = 'Ads by company ' . $_SESSION['name'] ;
		$myAdsList= $ls->getAdsByCompany( $_SESSION['name'] );

		require_once __DIR__ . '/../view/myAds.php';
	}


}

?>