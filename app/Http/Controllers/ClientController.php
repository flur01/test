<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
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
        $client = new Client();
        if ($request->column && !$request->value){
            $client = $this->clientRepository->sort($request->column);
        } elseif ($request->column && $request->value) {
            $client = $this->clientRepository->filter($request->column, $request->value);
        }
        return ClientResource::collection($this->clientRepository->paginate($client));
    }

    public function store(CreateClientRequest $request)
    {
        $client = $this->clientRepository->create($request->validated());
        $this->clientRepository->createUserForClient($client, $request->user);
        return new ClientResource($client);
    }
}
