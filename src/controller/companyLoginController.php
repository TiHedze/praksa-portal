<?php

require_once __DIR__ . "/../model/DB.class.php";
require_once __DIR__ . "/../model/company/company.service.php";
require_once __DIR__ . "/../model/company/company.model.php";

class CompanyLoginController
{
    private $companyService;

    public function __construct()
    {
        $this->companyService = CompanyService::getInstance();
    }

    public function index()
    {
        require __DIR__ . "./../../view/homepage/homepage.php";
    }

    public function companyLogin($request)
    {
        $name = $request['name'];
        $company = $this->companyService->getCompanyByName($request['name']);
        if ($company->verifyPassword($request['password'])) {
            session_start();
            $_SESSION['cname'] = $request['name'];
            $_SESSION['cid'] = $company->id;
            require __DIR__ . "/../view/homepage/homepage.php";

        } else {
            $error = true;
            $errorMessage = "Wrong name and/or password.";
            require __DIR__ . "/../view/login/login.php";
        }
    }

    public function companyRegister($request)
    {

        $company = Company::companyRegisterModel($request['name'], $request['password'], $request['owner'], $request['oib'], $request['email'], $request['industry'], $request['employees']);
        try {

            $this->companyService->createCompany($company);
            $this->companyLogin($request);
        } catch (PDOException $e) {

            print_r($e);
            $error = true;
            $errorMessage = "Name already exists!";
            require __DIR__ . "/../view/companyRegister/companyRegister.php";
        }
    }

    public function logout()
    {
        session_start();

        $title = 'Uspjesno ste se odjavili!';
		session_unset();
        session_destroy();
		require_once __DIR__ . "/../view/homepage/homepage.php";
    }
}