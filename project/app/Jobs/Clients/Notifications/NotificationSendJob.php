<?php

namespace App\Jobs\Clients\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Clients\ClientNotification;
use Symfony\Component\Console\Command\Command;

class NotificationSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     *
     * @var ClientNotification 
     */
    private $notification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ClientNotification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $success = $this->notification->sendNotification();
                
        if($success){
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }
}
