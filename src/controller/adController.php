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

}

?>