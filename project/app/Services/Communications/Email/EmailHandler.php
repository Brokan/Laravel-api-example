<?php

namespace App\Services\Communications\Email;

use Exception;
use App\Traits\InstanceTrait;
use App\Services\Communications\Email\EmailServices\MailerInterface;

class EmailHandler {

    use InstanceTrait;

    public function send(string $phone, string $content): bool {
        $mailerClassName = $this->getMailerClassName();
        
        /**
         * @var MailerInterface $mailer
         */
        $mailer = (new $mailerClassName($phone, $content));
        return $mailer->send();
    }

    private function getMailerClassName(): string {
        $mailerName = config('mail.default');
        $mailerClass = config('mail.mailers.' . $mailerName . '.service');
        if (!class_exists($mailerClass)) {
            throw new Exception('Class ' . $mailerClass . ' not exist!');
        }
        
        return $mailerClass;
    }

}
