<?php
require_once __DIR__ . "/ad.class.php";
require_once __DIR__ . "/../DB.class.php";


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

    public function add_new_ad( $adTitle, $adText, $adSalary )
    {
        $companies=[];
        $ads = [];

        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM ads' );
        $st->execute();

        while( $row = $st->fetch() )
            $ads[] = new Ad( $row['id'], $row['id_user'], $row['name'], $row['description'], $row['price'] );

        foreach( $ads as $ad )
            if( $ad->title === $adTitle) //možemo dodati da provjeri dal je i ista satnica i ista company
                return false;

        $st = $db->prepare( 'SELECT * FROM company' );
        $st->execute();

        while( $row = $st->fetch() )
            $companies[] = new Company( $row['id'], $row['name'], $row['password'], $row['owner'], $row['oib'], $row['email'], $row['industry'], $row['employees']);

        foreach( $companies as $company)
            if( $company->name == $_SESSION['name']){
                $value = $company->id;
                $name = $company->name;
            }

        $st = $db->prepare( 'INSERT INTO ads(title, company_id, text, company_name, salary ) VALUES (:title, :company_id, :text, :company_name, :salary )' );
            $st->execute( array( 'title' => $adTitle, 'company_id' => $value, 'text' => $adText, 'company_name' => $name, 'salary' => $adSalary ) );
        return true;
    }
}
