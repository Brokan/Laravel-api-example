<?php

namespace App\Services\Communications\Email\EmailServices;

interface MailerInterface
{
   public function __construct(string $email, string $content);
   
   public function send() : bool;
}
