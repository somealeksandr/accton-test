<?php

namespace App\ApiClients;

use App\ApiClients\Contracts\ApiClientContract;
use GuzzleHttp\Client;

class ApiClientService implements ApiClientContract
{
    public function __construct(protected Client $client)
    {
    }

    public function getUsers($page = 1)
    {
        $response = $this->client->get(config('services.external_api.base_uri') . 'users', [
            'headers' => config('services.external_api.headers'),
            'query' => ['page' => $page],
        ]);

        return json_decode($response->getBody(), true)['users'];
    }

    public function getCompanies($page = 1)
    {
        $response = $this->client->get(config('services.external_api.base_uri') . 'companies', [
            'headers' => config('services.external_api.headers'),
            'query' => ['page' => $page],
        ]);

        return json_decode($response->getBody(), true)['compaines'];
    }

    public function getCompanyPositions($companyId)
    {
        $response = $this->client->get(config('services.external_api.base_uri') . "company/{$companyId}", [
            'headers' => config('services.external_api.headers'),
        ]);

        return json_decode($response->getBody(), true)['positions'];
    }
}
