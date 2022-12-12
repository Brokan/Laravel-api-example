<?php

namespace App\Endpoints\Clients;

use App\Endpoints\Endpoint;
use App\Models\Clients\Client;
use App\Traits\InstanceTrait;
use App\Exceptions\ExceptionNotFound;

final class ClientGetEndpoint extends Endpoint
{
    use InstanceTrait;
    
    /**
     * 
     * @param string $clientId
     * @return Client
     * @throws ExceptionNotFound
     */
    public function getById(string $clientId) : Client {
        /**
         * @var Client $client
         */
        $client = Client::query()->find($clientId);
        if(empty($client)){
            throw new ExceptionNotFound('Client with id ' . $clientId . ' not found');
        }
        
        return $client;
    }
}
