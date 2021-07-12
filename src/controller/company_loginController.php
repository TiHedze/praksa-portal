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
        require __DIR__ . "/../view/login/login.php";
    }

    public function company_login($request)
    {
        $company = $this->companyService->getCompanyByName($request['name']);
        if ($company->verifyPassword($request['password'])) {
            session_start();
            $_SESSION['name'] = $name;

        } else {
            $error = true;
            $errorMessage = "Wrong name and/or password.";
            require __DIR__ . "/../view/login/login.php";
        }
    }

    public function company_register($request)
    {

        $company = company_login::company_registerModel($request['name'], $request['password'], $request['owner'], $request['oib'], $request['email'], $request['industry'], $request['employees']);
        try {

            $this->companyService->createCompany($company);
            $this->company_login($request);
        } catch (PDOException $e) {

            $error = true;
            $errorMessage = "Username already exists!";
            require __DIR__ . "/../view/register/company_register.php";
        }
    }

    public function logout()
    {
    }
}