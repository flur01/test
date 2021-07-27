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

    public function sort(string $columnName)
    {
        return Client::orderBy($columnName);
    }

    public function filter(string $columnName, $value)
    {
        return Client::where($columnName, $value)->orderBy($columnName);
    }

    public function paginate($client)
    {
        return $client->paginate(config('app.clients_pagination'));
    }

}
