<?php

namespace App\Services\Communications\Email\EmailServices;

use App\Services\Communications\Email\EmailServices\MailerInterface;

abstract class MailerAbstract implements MailerInterface {

    protected $email = '';
    protected $content = '';

    public function __construct(string $email, string $content) {
        $this->email = $email;
        $this->content = $content;
    }

    abstract public function send(): bool;
}
