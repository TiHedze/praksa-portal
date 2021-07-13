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

    public function addNewAd( )
	{
		session_start();

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

		if( !isset( $_SESSION['cname'] ) || !preg_match( '/^[a-zA-Z ,-.]+$/', $_SESSION['cname'] ) )
		{
			//header( 'Location: index.php?rt=books/search');
			exit();
		}

		$title = 'Ads by company ' . $_SESSION['cname'] ;
		$myAdsList= $ls->getAdsByCompany( $_SESSION['cname'] );

		require_once __DIR__ . '/../view/ads/myAds.php';
	}

	public function adSearch()
	{
		$ls = AdService::getInstance();

		if( !isset( $_POST['company_name']  ) )
		{
			$title = 'Popis svih oglasa tvrtke';
			require_once __DIR__ . '/../view/homepage/homepage.php';
			exit();
		}
		else{
		$title = 'Popis svih oglasa tvrtke ' . $_POST['company_name'];
		$adCompanyNameList = $ls->getAdsByCompany( $_POST['company_name'] );

		require_once __DIR__ . './../view/ads/adSearch.php';}
	}

}

?>