<?php

namespace App\ApiClients\Contracts;

interface ApiClientContract
{
    public function getUsers($page = 1);

    public function getCompanies($page = 1);

    public function getCompanyPositions($companyId);
}
