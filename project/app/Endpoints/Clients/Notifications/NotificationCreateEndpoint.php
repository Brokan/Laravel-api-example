<?php

namespace App\Endpoints\Clients\Notifications;

use App\Endpoints\Endpoint;
use App\ValueObjects\Clients\ClientValueObject;
use App\Traits\InstanceTrait;
use App\Endpoints\Clients\ClientGetEndpoint;
use App\Models\Clients\ClientNotification;
use App\Enums\Clients\Notifications\NotificationsTypesEnum;
use App\Exceptions\ExceptionNotValid;
use App\Enums\Clients\Notifications\NotificationsStatusesEnum;
use App\Jobs\Clients\Notifications\NotificationSendJob;

final class NotificationCreateEndpoint extends Endpoint
{
    use InstanceTrait;
    
    /**
     * Create new client.
     * @param ClientValueObject $client
     * @return string
     */
    public function create(string $clientId, string $channel, string $content) : string {
        
        $client = ClientGetEndpoint::instance()->getById($clientId);
        
        $channel = $this->channelCheck($channel);

        $notification = ClientNotification::query()->create([
            'client_id' => $client->id,
            'send_type' => $channel,
            'content' => $content,
            'status' => NotificationsStatusesEnum::NEW,
        ]);
        
        NotificationSendJob::dispatch($notification);
        
        return $notification->id;
    }
    
    private function channelCheck(string $channel) : string {
        $channel = strtolower($channel);
        if(!NotificationsTypesEnum::hasChannelType($channel)){
            throw new ExceptionNotValid('Channel "'.$channel.'" is not valid');
        }
        return $channel;
    }
}
