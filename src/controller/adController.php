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

    public function add_new_ad( $adTitle, $adText, $adSalary ){
		$title = 'Add new ad';
		$ls = new adService;
		if( isset( $_POST['adTitle']) && isset( $_POST['adText']) && isset( $_POST['adSalary'] ) ){
			$check = $ls->add_new_ad( $_POST['adTitle'], $_POST['adText'], $_POST['adSalary'] );
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


}

?>