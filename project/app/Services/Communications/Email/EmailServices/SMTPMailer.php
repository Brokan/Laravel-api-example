<?php

namespace App\Services\Communications\Email\EmailServices;

class SMTPMailer extends MailerAbstract implements MailerInterface {

    private $subject = 'Test';

    public function send(): bool {
        $success = true;//mail($this->email, $this->subject, $this->content);
        return !empty($success);
    }

}
