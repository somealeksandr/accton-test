<?php

namespace App\Console\Commands;

use App\ApiClients\Contracts\ApiClientContract;
use App\Models\Company;
use App\Models\Position;
use App\Models\User;
use Illuminate\Console\Command;

class ParseAndSaveCommand extends Command
{
    const PAGES = 6;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse data from API and save it to the local database';

    public function __construct(private ApiClientContract $apiClient)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Parsing data from API and saving to the database...');

        $users = [];
        $companies = [];
        for ($page = 1; $page < self::PAGES; $page++) {
            $users = array_merge($users, $this->apiClient->getUsers($page));
            $companies = array_merge($companies, $this->apiClient->getCompanies($page));
        }

        $this->saveUsersAndCompanies($users, $companies);

        $companyPositions = [];
        foreach ($companies as $company) {
            $companyPositions = array_merge($companyPositions, $this->apiClient->getCompanyPositions($company['Id']));
        }

        $this->savePositionsToDatabase($companyPositions);

        $this->info('Data parsed and saved to the database successfully.');
    }

    private function saveUsersAndCompanies($users, $companies): void
    {
        foreach ($users as $userData) {
            User::updateOrCreate(['id' => $userData['Id']], [
                'id' => $userData['Id'],
                'last_name' => $userData['LastName'],
                'first_name' => $userData['FirstName'],
                'email' => $userData['Email'],
            ]);
        }

        foreach ($companies as $companyData) {
            Company::updateOrCreate(['id' => $companyData['Id']], [
                'id' => $companyData['Id'],
                'name' => $companyData['Name'],
                'address' => $companyData['Address'],
            ]);
        }
    }

    private function savePositionsToDatabase($companyPositions): void
    {
        foreach ($companyPositions as $positionData) {
            if ($this->conditionsForPositions($positionData['CompanyId'], $positionData['UserId'])) {
                Position::updateOrCreate(['company_id' => $positionData['CompanyId'], 'user_id' => $positionData['UserId']], [
                    'company_id' => $positionData['CompanyId'],
                    'user_id' => $positionData['UserId'],
                    'position' => $positionData['Position'],
                ]);
            }
        }
    }

    private function conditionsForPositions($companyId, $userId): bool
    {
        return Company::where('id', $companyId)->exists() && User::where('id', $userId)->exists();
    }
}
