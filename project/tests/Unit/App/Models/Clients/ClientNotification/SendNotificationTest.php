<?php

namespace Tests\Unit\App\Models\Clients\ClientNotification;

use Tests\TestCase;
use App\Models\Clients\Client;
use App\Models\Clients\ClientNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @cover \App\Models\Clients\ClientNotification::sendNotification()
 */
class SendNotificationTest extends TestCase
{
    use WithFaker;
    
    public function testSuccessWhenSendEmail()
    {
        Mail::fake();
        
        /**
         * @var Client $client
         */
        $client = Client::query()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->e164PhoneNumber,
        ]);
        /**
         * @var ClientNotification $clientNotification
         */
        $clientNotification = ClientNotification::query()->create([
            'client_id' => $client->id,
            'send_type' => 'email',
            'content' => $this->faker->text(135),
            'status' => 'new',
        ]);
                
        $success = $clientNotification->sendNotification();
        
        $this->assertTrue($success);
        $this->assertNotEmpty($clientNotification->sent_at);
        $this->assertEquals('sent', $clientNotification->status);
    }
}
