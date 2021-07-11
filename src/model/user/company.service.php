<?php
require_once __DIR__ . "/company.model.php";
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

        return Company::loginModel($row['id'], $row['name'], $row['password'], $row['owner'], $row['oib'], $row['email'], $row['industry'], $row['employees']);
    }

    public function createCompany($company)
    {
        $query = $this->db->prepare('INSERT INTO company (name, password, owner, oib, email, industry, employees) VALUES(:name, :password, :owner, :oib, :email, :industry, :employees)');
        $query->execute(
            array(
                'name' => $company->name,
                'password' => $company->password,
                'owner' => $company->owner,
                'oib' => $company->oib,
                'email' => $company->email,
                'industry' => $company->industry,
                'employees' => $company->employees,
            )
        );

        return $query = $this->getCompanyByName($company->name);
    }
}
