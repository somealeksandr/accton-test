<?php

namespace App\Services\Company;

use App\DTO\CompanyDTO;
use App\Services\Company\Handle\Index;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyService
{
    public function index(CompanyDTO $companyDTO): LengthAwarePaginator
    {
        return (new Index($companyDTO))->handle();
    }
}
