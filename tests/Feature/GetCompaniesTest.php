<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetCompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function testApiWithQuerySearch()
    {
        $response = $this->json('GET', '/api/companies', ['search' => 'your_search_term']);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'address',
                    'users' => [
                        '*' => [
                            'id',
                            'last_name',
                            'first_name',
                            'email',
                            'position',
                        ],
                    ],
                ],
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links' => [
                '*' => [
                    'url',
                    'label',
                    'active',
                ],
            ],
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);
    }
}
