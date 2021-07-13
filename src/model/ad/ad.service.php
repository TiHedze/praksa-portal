<?php
require_once __DIR__ . "/ad.model.php";
require_once __DIR__ . "/../DB.class.php";
require_once __DIR__ . "/../company/company.model.php";
require_once __DIR__ . "/../company/company.service.php";


class AdService
{

    private static $instance;
    private $db;

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

    public function createAd($title, $companyId, $text, $salary)
    {
        $query = $this->db
            ->prepare('SELECT name FROM company WHERE id=:id')
            ->execute(array('id' => $companyId));

        $companyName = $query->fetch()['name'];

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
            ->prepare('SELECT * FROM ads WHERE id=:id')
            ->execute(array('id' => $id));

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

        if( isset( $_SESSION['name'] ) ){
            foreach( $companies as $company)
            if( $company->name == $_SESSION['name']){
                $value = $company->id;
                $name = $company->name;
            }

            $ad = AdModel::createAd($adTitle, $value, $adText, $adSalary);
        }
        else{
            echo'Nemam session name.';
        }

        return true;
    }
}
