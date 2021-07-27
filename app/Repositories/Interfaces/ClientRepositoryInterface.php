<?php


namespace App\Repositories\Interfaces;


use App\Models\Client;

interface ClientRepositoryInterface
{
    public function create(array $arguments);
    public function createUserForClient(Client $client, array $userArguments);
}
