<?php

namespace App\Endpoints\Clients;

use App\Endpoints\Endpoint;
use App\Models\Clients\Client;
use App\ValueObjects\Clients\ClientValueObject;
use App\Traits\InstanceTrait;

final class ClientCreateEndpoint extends Endpoint
{
    use InstanceTrait;
    
    /**
     * Create new client.
     * @param ClientValueObject $client
     * @return string
     */
    public function create(ClientValueObject $client) : string {
        $newClient = Client::query()->create([
            'first_name' => $client->getFirstName(),
            'last_name' => $client->getLastName(),
            'email' => $client->getEmail(),
            'phone' => $client->getPhone(),
        ]);
        
        return $newClient->id;
    }
}
