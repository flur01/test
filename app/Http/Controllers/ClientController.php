<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Resources\ClientResource;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }

    public function index(Request $request)
    {
        return ClientResource::collection($this->clientRepository->getAll(
            $request->sortColumn ?: 'id',
            $request->filterData ?: []
        ));
    }

    public function store(CreateClientRequest $request)
    {
        $client = $this->clientRepository->create($request->validated());
        $this->clientRepository->createUserForClient($client, $request->user);
        return new ClientResource($client);
    }
}
