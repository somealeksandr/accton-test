<?php

namespace App\Http\Controllers;

use App\DTO\CompanyDTO;
use App\Http\Requests\CompanyRequest;
use App\Services\Company\CompanyService;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $service)
    {
    }

    public function index(CompanyRequest $request)
    {
        $companies = $this->service->index(CompanyDTO::fromArray($request->validated()));

        return response($companies);
    }
}
