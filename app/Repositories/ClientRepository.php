<?php

namespace App\Repositories;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function create(array $arguments)
    {
        return Client::create($arguments);
    }

    public function createUserForClient(Client $client, array $userArguments) {
        return $client->users()->create($userArguments);
    }
}
