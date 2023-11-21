<?php

namespace App\Services\Company\Handle;

use App\ApiClients\Contracts\CaseHandler;
use App\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;

class Index implements CaseHandler
{
    public function __construct(private CompanyDTO $companyDTO)
    {
    }

    public function handle(): LengthAwarePaginator
    {
        $query = Company::query();

        $valueSearch = $this->companyDTO->search;

        if (isset($valueSearch)) {
            $query->where('name', 'like', "%$valueSearch%")
                  ->orWhere('address', 'like', "%$valueSearch%");
        }

        return $query->paginate($this->companyDTO->per_page);
    }
}
