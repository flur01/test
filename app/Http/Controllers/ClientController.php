<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
