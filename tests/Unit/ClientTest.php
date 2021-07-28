<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;


    /* @test */
    public function test_create_client_and_user_for_him()
    {
        $client = Client::factory()->create();
        $client->users()->save(User::factory()->make());
        $client->users()->save(User::factory()->make());
        $this->assertEquals(2, $client->users()->count());
    }

    /* @test */
    public function test_default_get_all_clients()
    {
        $client = Client::factory()->make();
        $client->client_name = 'AAAAAAA';
        $client->save();
        Client::factory()->count(3)->create();
        $clientRepository = new ClientRepository();
        $firstClient =  $clientRepository->getAll()->first();
        $this->assertEquals('AAAAAAA', $firstClient->client_name);
    }

    /* @test */
    public function test_sorting_by_name_clients()
    {
        Client::factory()->count(3)->create();
        $client = Client::factory()->make();
        $client->client_name = 'AAAAAAA';
        $client->save();
        $clientRepository = new ClientRepository();
        $firstClientFilteredByName =  $clientRepository->getAll('client_name')->first();
        $this->assertEquals('AAAAAAA', $firstClientFilteredByName->client_name);
    }
}
