<?php

namespace App\Http\Controllers\Api\Guest\Clients;

use App;
use App\Http\Controllers\Api\ApiPublicController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Guest\Clients\CreateClientRequest;
use App\Endpoints\Clients\ClientCreateEndpoint;
use App\ValueObjects\Clients\ClientValueObject;

class CreateController extends ApiPublicController {
    
    /**
     * 
     * @param CreateClientRequest $request POST Keys are: firstName, lastName, email, phone
     * @return type
     */
    public function create(CreateClientRequest $request) {
        $clientValueObject = new ClientValueObject(
                $request->post('firstName'),
                $request->post('lastName'),
                $request->post('email'),
                $request->post('phone'),
        );
        $clientId = ClientCreateEndpoint::instance()->create($clientValueObject);
        return response()->json([
            'id' => $clientId
        ]);
    }

}
