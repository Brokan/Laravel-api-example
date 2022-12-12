<?php

namespace App\Services\Communications\Sms;

use App\Traits\InstanceTrait;
use Exception;

class SmsHandler
{
   use InstanceTrait;
   
   public function send(string $phone, string $content) : bool {
       //@todo
       //throw new Exception('To do');
       return false;
   }
}
