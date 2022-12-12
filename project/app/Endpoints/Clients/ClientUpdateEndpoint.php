<?php

namespace App\Endpoints\Clients;

use App\Endpoints\Endpoint;
use App\Models\Clients\Client;
use App\ValueObjects\Clients\ClientValueObject;
use App\Traits\InstanceTrait;
use App\Exceptions\ExceptionNotFound;
use App\Endpoints\Clients\ClientGetEndpoint;

final class ClientUpdateEndpoint extends Endpoint
{
    use InstanceTrait;
    
    /**
     * 
     * @param string $clientId
     * @param ClientValueObject $clientValueObject
     * @return string
     */
    public function update(string $clientId, ClientValueObject $clientValueObject) : string {
        
        $client = ClientGetEndpoint::instance()->getById($clientId);
        
        $client->first_name = $clientValueObject->getFirstName();
        $client->last_name = $clientValueObject->getLastName();
        $client->email = $clientValueObject->getEmail();
        $client->phone = $clientValueObject->getPhone();
        $client->save();
        
        return $client->id;
    }
}
