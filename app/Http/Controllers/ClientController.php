<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    public function store(CreateClientRequest $request)
    {
        $clientData = $request->validated();
        $location = Cache::rememberForever($request->address1, function () use ($request) {
            $response = json_decode(\GoogleMaps::load('geocoding')
                ->setParam ([
                    'address' => $request->address1,
                    'components'    => [
                        'city'   => $request->city,
                        'country' => $request->country,
                        'state' => $request->state,
                        'zip' => $request->zip,
                    ]
                ])
                ->get());
            return $response->results[0]->geometry->location;
        });
        $clientData['latitude'] = $location->lat;
        $clientData['longitude'] = $location->lng;
        $client = $this->clientRepository->create($clientData);
        $this->clientRepository->createUserForClient($client, $request->user);
        return new ClientResource($client);
    }
}
