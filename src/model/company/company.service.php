<?php
require_once __DIR__ . "/company.model.php";
require_once __DIR__ . "/../user/user.model.php";

class CompanyService
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
        if (CompanyService::$instance == null) {
            CompanyService::$instance = new CompanyService(DB::getInstance());
        }

        return CompanyService::$instance;
    }

    public function getCompanyByName($name)
    {
        $query = $this->db->prepare('SELECT * FROM company WHERE name=:name');
        $query->execute(array('name' => $name));

        $row = $query->fetch();

        if ($row === false) {
            return null;
        }

        return Company::companyLoginModel($row['id'], $row['name'], $row['password'], $row['owner'], $row['oib'], $row['email'], $row['industry'], $row['employees']);
    }

    public function createCompany($company)
    {
        $query = $this->db->prepare('INSERT INTO company (name, password, owner, oib, email, industry, employees) VALUES(:name, :password, :owner, :oib, :email, :industry, :employees)');
        $query->execute(
            array(
                'name' => $company->name,
                'password' => $company->password_hash,
                'owner' => $company->owner,
                'oib' => $company->oib,
                'email' => $company->email,
                'industry' => $company->industry,
                'employees' => $company->employees
            )
        );

        return $query = $this->getCompanyByName($company->name);
    }

    public function getAppliedStudents($adId, $companyId)
    {
        $query = $this->db->prepare('SELECT DISTINCT users.name, users.lastname, users.id, users.username, users.password, users.role FROM users JOIN ad_application ON users.id = ad_application.user_id JOIN ads ON ad_application.ad_id = ads.id WHERE ads.company_id = :companyId AND ad_application.ad_id = :adId;');
        $query->execute(array("companyId"=> $companyId, "adId"=>$adId));
        $students = [];
        while($row = $query->fetch())
        {
            $students[] = User::loginModel( $row['id'], $row['name'], $row['lastname'], $row['username'], $row['password'], $row['role'] );
        }

        return $students;
    }

}
