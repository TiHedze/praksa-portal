<?php
require_once __DIR__ . "/profil.model.php";
require_once __DIR__ . "/../DB.class.php";
require_once __DIR__ . "/../user/user.model.php";
require_once __DIR__ . "/../user/user.service.php";


class ProfilService
{

    private static $instance;
    private $db;
    private $userService;

    private final function __construct($db)
    {
        $this->db = $db;
    }

    private final function __clone()
    {
    }

    public static function getInstance()
    {
        if (ProfilService::$instance == null) {
            ProfilService::$instance = new ProfilService(DB::getInstance());
        }

        return ProfilService::$instance;
    }

    public function createProfil($student_id, $age, $college, $grades, $email)
    {
        session_start();

        $sid = $_SESSION['user']->id;
        $query = $this->db->prepare('SELECT * FROM profil WHERE ( student_id = :sid )');
        $exist = $query->execute(array('student_id' => $sid,));
        $row = $query->fetch();

        if ($row !== false) {
            return false;
        }
        else
        {
            $query = $this->db
                ->prepare('INSERT INTO profil (student_id, age, college, grades, email) VALUES (:student_id, :age, :college, :grades, :email)')
                ->execute(array(
                    'student_id' => $student_id,
                    'age' => $age,
                    'college' => $college,
                    'grades' => $grades,
                    'email' => $email
                ));

            $profilId = $this->db->lastInsertId('id');
            return true;
            //return $this->getProfilById($profilId);
        }
    }

    public function getProfilById($id)
    {
        $query = $this->db
            ->prepare('SELECT * FROM profil WHERE id=:id');
        $success = $query->execute(array('id' => $id));

        $row = $query->fetch();

        return ProfilModel::retrieveProfil(
            $row['id'],
            $row['student_id'],
            $row['age'],
            $row['college'],
            $row['grades'],
            $row['email']
        );
    }

    public function checkProfilById($student_id)
    {
        $query = $this->db
            ->prepare('SELECT * FROM profil WHERE student_id=:student_id');
        $success = $query->execute(array('student_id' => $student_id));

        $row = $query->fetch();

        if ($row === false) {
            return false;
        }

        return ProfilModel::retrieveProfil(
            $row['id'],
            $row['student_id'],
            $row['age'],
            $row['college'],
            $row['grades'],
            $row['email']
        );
    }

    public function getProfilByStuudentId($student_id)
    {
        $query = $this->db->prepare('SELECT * FROM profil WHERE student_id=:student_id');
        $query->execute(array('student_id' => $student_id));

        $row = $query->fetch();

        if ($row === false) {
            return null;
        }

        //$this->profilModel = ProfilModel::getInstance();

        $profil = ProfilModel::retrieveProfil($row['id'], $row['student_id'], $row['age'], $row['college'], $row['grades'], $row['email']);

        return $profil;
    }
/*
    public function add_profil_desc($student_id, $age, $college, $grades, $email)
    {

        $profils= ProfilService::getProfilByStuudentId($student_id);






    


		while( $row = $st->fetch() )
			$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']);

		foreach( $users as $user)
			if( $user->username == $_SESSION['username'])
				$value = $user->id;

		$st = $db->prepare( 'UPDATE users SET age = :age, college = :college, grades = :grades, email = :email WHERE id_user = :id_user' );
			$st->execute( array( 'id_product'=>$id_product,'id_user' => $value, 'rating' => $Ocjena, 'comment' => $Komentar) );
		return true;
	}*/

/*
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
	}*/
}
