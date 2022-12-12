<?php

namespace Tests\Feature\Http\Api\V1\Notification;

use Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Clients\Client;

/**
 * @link \App\Http\Controllers\Api\Auth\Clients\Notifications\CreateController::create
 */
class CreateNotificationEndpointTest extends TestCase
{
    use WithFaker;
    
    private const URL = 'api/v1/notification/create';
        
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessWhenSendSMS()
    {
        $client = Client::query()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->e164PhoneNumber,
        ]);
        
        $postData = [
            'clientId' => $client->id,
            'channel' => 'sms',
            'content' => $this->faker->text(135),
        ];
        $response = $this->json('POST', self::URL, $postData, $this->getAuthenticationHeader());

        $response->assertStatus(200);
                
        $notificationId = $response->json('id');
        
        $this->assertDatabaseHas('clients_notifications', [
            'id' => $notificationId,
            'client_id' => $postData['clientId'],
            'send_type' => $postData['channel'],
        ]);
    }
}
