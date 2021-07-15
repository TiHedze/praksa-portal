<?php
require_once __DIR__ . "/ad.model.php";
require_once __DIR__ . "/../DB.class.php";
require_once __DIR__ . "/../company/company.model.php";
require_once __DIR__ . "/../company/company.service.php";


class AdService
{

    private static $instance;
    private $db;
    private $companyService;

    private final function __construct($db)
    {
        $this->db = $db;
    }

    private final function __clone()
    {
    }

    public static function getInstance()
    {
        if (AdService::$instance == null) {
            AdService::$instance = new AdService(DB::getInstance());
        }

        return AdService::$instance;
    }

    public function createAd($title, $companyId, $text, $companyName, $salary)
    {
        $query = $this->db
            ->prepare('SELECT name FROM company WHERE id=:id')
            ->execute(array('id' => $companyId));

        //$companyName = $query->fetch()['name'];

        $query = $this->db
            ->prepare('INSERT INTO ads (title, company_id, company_name, text, salary) VALUES (:title, :company_id, :company_name, :text, :salary)')
            ->execute(array(
                'title' => $title,
                'company_id' => $companyId,
                'company_name' => $companyName,
                'text' => $text,
                'salary' => $salary
            ));

        $adId = $this->db->lastInsertId('id');

        return $this->getAdById($adId);
    }

    public function getAdById($id)
    {
        $query = $this->db
            ->prepare('SELECT * FROM ads WHERE id=:id');
        $success = $query->execute(array('id' => $id));

        $row = $query->fetch();

        return AdModel::retrieveAd(
            $row['id'],
            $row['title'],
            $row['company_id'],
            $row['text'],
            $row['company_name'],
            $row['salary']
        );
    }

    public function getAds()
    {
        try {
            $ads = array();

            $query = $this->db->query("SELECT * FROM ads");

            $rows = $query->fetchAll();

            foreach($rows as $row) {
                $ads[] = AdModel::retrieveAd(
                    $row['id'],
                    $row['title'],
                    $row['company_id'],
                    $row['text'],
                    $row['company_name'],
                    $row['salary']
                );
            }

            return $ads;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function addNewAd( $adTitle, $adText, $adSalary )
    {
        //print_r($_SESSION['cname'] );

        $companies = array();
        $ads = array();

        $query = $this->db->query("SELECT * FROM ads");
        $rows = $query->fetchAll();
        foreach($rows as $row) {
            $ads[] = AdModel::retrieveAd(
                $row['id'],
                $row['title'],
                $row['company_id'],
                $row['text'],
                $row['company_name'],
                $row['salary']
            );
        }

        $query = $this->db->query("SELECT * FROM company");
        $rows = $query->fetchAll();
        foreach($rows as $row) {
            $companies[] = Company::companyLoginModel(
                $row['id'], $row['name'], $row['password'], $row['owner'], $row['oib'], $row['email'], $row['industry'], $row['employees']
            );
        }

        if( isset( $_SESSION['cname'] ) ){
            foreach( $companies as $company)
            if( $company->name == $_SESSION['cname']){
                $value = $company->id;
                $name = $company->name;
            }
            $ad = AdService::createAd($adTitle, $value, $adText, $name, $adSalary);
        }
        else{
            echo'Nemam session name.';
        }

        return true;
    }

    function getAdsByCompany( $company_name )
	{
		$ads = [];
		$myads = [];

        $this->companyService = CompanyService::getInstance();

        $company = $this->companyService->getCompanyByName($company_name);

        $ads = AdService::getAds();

        foreach( $ads as $ad) 
        if($ad->companyName === $company_name){
            $myads[] = AdModel::retrieveAd($ad->id, $ad->title, $ad->companyId, $ad->text, $ad->companyName , $ad->salary);
        }

		return $myads;
	}

    function getAdsByStudent( $user_id )
	{
		$ads = [];
		$myads = [];
        $applcations = [];

        $ads = AdService::getAds();

		$value = 0;
        $query = $this->db->prepare('SELECT * FROM ad_application WHERE ( user_id = :user_id)');
        $exist = $query->execute(array("user_id" => $user_id));

		while( $row = $query->fetch() ){
			$applcations[] = [ $row['id'], $row['ad_id'], $row['user_id'] ];
		}

		foreach ($applcations as $apply ) {
			if( $apply[2] == $user_id )
				$value = $apply[1];
            try
            {
                $query = $this->db->prepare( 'SELECT id, title, company_id, text, company_name, salary FROM ads WHERE id=:id' );
                $exist = $query->execute( array( 'id' => $value ) );
            }
            catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }


            while( $row = $query->fetch() )
            {
                $myads[] = AdModel::retrieveAd($row['id'], $row['title'], $row['company_id'], $row['text'],$row['company_name'] , $row['salary']);
            }
        }
		return $myads;
	}

    function apply()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        header('Content-Type: application/json; charset: utf-8');

        $adId = $data['adId'];
        $userId = $data['userId'];

        $query = $this->db->prepare('SELECT * FROM ad_application WHERE ( ad_id = :adId AND user_id = :userId)');
        $exist = $query->execute(array("adId" => $adId, "userId" => $userId));
        if ( $query->fetch() )
        {
            http_response_code(404);
            echo json_encode(array('error'=>'Već ste prijavljeni na taj oglas. '));
        }
        else
        {
            $query = $this->db->prepare('INSERT INTO ad_application (ad_id, user_id) VALUES (:adId, :userId)');
            $query->execute(array("adId" => $adId, "userId" => $userId));
            
            
            echo json_encode(array("userId" => $userId, "adId" =>$adId));
        }
    }
}
