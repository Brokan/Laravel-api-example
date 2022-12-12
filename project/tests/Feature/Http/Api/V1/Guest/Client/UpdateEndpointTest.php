<?php

namespace Tests\Feature\Http\Api\V1\Guest\Client;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Clients\Client;

class UpdateEndpointTest extends TestCase
{
    use WithFaker;
    
    private const URL = 'api/v1/guest/client/update';
        
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccess()
    {
        $oldClient = Client::query()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->e164PhoneNumber,
        ]);
        
        $postData = [
            'id' => $oldClient->id,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->e164PhoneNumber,
        ];
        $response = $this->json('PUT', self::URL, $postData);

        $response->assertStatus(200);
        
        $clientId = $response->json('id');
        
        $this->assertEquals($oldClient->id, $clientId);
        
        $this->assertDatabaseHas('clients', [
            'id' => $oldClient->id,
            'first_name' => $postData['firstName'],
            'last_name' => $postData['lastName'],
            'email' => $postData['email'],
            'phone' => $postData['phone'],
        ]);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessWhenNotFoundClient()
    {
        $postData = [
            'id' => $this->faker->uuid,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->e164PhoneNumber,
        ];
        $response = $this->json('PUT', self::URL, $postData);

        $response->assertStatus(404);
        
        $this->assertEquals('Client with id ' . $postData['id'] . ' not found', $response->json('error'));
                
        $this->assertDatabaseMissing('clients', [
            'id' => $postData['id'],
        ]);
    }
}
