<?php

namespace App\Http\Controllers\Api\Guest\Clients;

use App;
use Exception;
use App\Exceptions\ExceptionNotFound;
use App\Http\Controllers\Api\ApiPublicController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Endpoints\Clients\ClientUpdateEndpoint;
use App\Http\Requests\Api\Guest\Clients\UpdateClientRequest;
use App\ValueObjects\Clients\ClientValueObject;

class UpdateController extends ApiPublicController {

    /**
     * 
     * @param CreateClientRequest $request POST Keys are: id, firstName, lastName, email, phone
     * @return type
     */
    public function update(UpdateClientRequest $request) {
        $clientValueObject = new ClientValueObject(
                $request->post('firstName'),
                $request->post('lastName'),
                $request->post('email'),
                $request->post('phone'),
        );

        try {
            $clientId = ClientUpdateEndpoint::instance()->update($request->post('id'), $clientValueObject);
        } catch (ExceptionNotFound $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            response()->json([
                'error' => 'Server error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'id' => $clientId
        ]);
    }

}
