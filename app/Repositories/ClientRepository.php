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

    public function getAll(string $sortColumn = 'id', array $filterData = []){
        $clients = Client::orderBy($sortColumn);
        if (count($filterData)){
            $clients->filterBy($filterData);
        }
        return $clients->paginate(config('app.clients_pagination'));
    }
}
