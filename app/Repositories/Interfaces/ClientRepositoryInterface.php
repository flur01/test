<?php


namespace App\Repositories\Interfaces;


use App\Models\Client;

interface ClientRepositoryInterface
{
    public function create(array $arguments);
    public function all();
    public function createUserForClient(Client $client, array $userArguments);
    public function sort(string $columnName);
    public function filter(string $columnName, $value);
}
