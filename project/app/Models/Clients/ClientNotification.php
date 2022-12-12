<?php

namespace App\Models\Clients;

use Exception;
use Cownet\Laravel\Uuid\Model;
use App\Enums\Clients\Notifications\NotificationsStatusesEnum;
use App\Enums\Clients\Notifications\NotificationsTypesEnum;
use App\Models\Clients\Client;
use Illuminate\Support\Facades\Log;
use App\Services\Communications\Email\EmailHandler;
use App\Services\Communications\Sms\SmsHandler;

/**
 * @property string $id
 * @property string $client_id
 * @property string $send_type
 * @property string $content
 * @property string $status
 * @property string $sent_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ClientNotification extends Model {

    protected $table = "clients_notifications";

    /**
     * To use UUID.
     * @var bool 
     */
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'send_type',
        'content',
        'status',
        'sent_at',
    ];
    protected $casts = [
        'id' => 'string',
        'client_id' => 'string',
        'send_type' => 'string',
        'content' => 'string',
        'status' => 'string',
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function client(): Client {
        return $this->belongsTo(Client::class, 'client_id')->first();
    }

    public function sendNotification(): bool {
        if($this->status !== NotificationsStatusesEnum::NEW){
            return false;
        }
        $this->setAsProcessing();
        try {
            $client = $this->client();
            if ($this->sendByType($client)){
                $this->setAsSent();
                return true;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ':' . $e->getLine());
        }
        $this->setAsFail();
        return false;
    }

    private function setAsProcessing(): void {
        $this->status = NotificationsStatusesEnum::PROCESSING;
        $this->save();
    }

    private function setAsFail(): void {
        $this->status = NotificationsStatusesEnum::FAIL;
        $this->save();
    }
    
    private function setAsSent(): void {
        $this->status = NotificationsStatusesEnum::SENT;
        $this->sent_at = date('Y-m-d H:i:s');
        $this->save();
    }

    private function sendByType(Client $client) : bool {
        switch ($this->send_type){
            case NotificationsTypesEnum::EMAIL:
                return EmailHandler::instance()->send($client->email, $this->content);
            case NotificationsTypesEnum::SMS:
                return SMSHandler::instance()->send($client->phone, $this->content);
        }
        throw new Exception('Undefiend notification type: ' . $client->type);
    }
}
