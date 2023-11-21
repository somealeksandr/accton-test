<?php

namespace Tests\Feature;

use App\ApiClients\Contracts\ApiClientContract;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ParseAndSaveCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    public function testParseAndSaveCommand()
    {
        $apiClientMock = $this->createMock(ApiClientContract::class);
        $apiClientMock->method('getUsers')->willReturn([]);
        $apiClientMock->method('getCompanies')->willReturn([]);
        $apiClientMock->method('getCompanyPositions')->willReturn([]);

        $this->app->instance(ApiClientContract::class, $apiClientMock);

        $this->artisan('data:parse');

        $this->assertDatabaseCount('users', 9);
        $this->assertDatabaseCount('companies',9);
        $this->assertDatabaseCount('positions', 31);
    }
}

