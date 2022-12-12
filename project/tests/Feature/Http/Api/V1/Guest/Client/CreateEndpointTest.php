<?php

namespace Tests\Feature\Http\Api\V1\Guest\Client;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @link \App\Http\Controllers\Api\Guest\Clients\CreateController::create
 */
class CreateEndpointTest extends TestCase
{
    use WithFaker;
    
    private const URL = 'api/v1/guest/client/create';
        
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccess()
    {
        $postData = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->e164PhoneNumber,
        ];
        $response = $this->json('POST', self::URL, $postData);

        $response->assertStatus(200);
        
        $clientId = $response->json('id');
        
        $this->assertDatabaseHas('clients', [
            'id' => $clientId,
            'first_name' => $postData['firstName'],
            'last_name' => $postData['lastName'],
            'email' => $postData['email'],
            'phone' => $postData['phone'],
        ]);
    }
}
