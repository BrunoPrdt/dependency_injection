<?php

namespace App\Mailer;

use App\Logger;

class GmailMailer implements MailerInterface
{

    protected $user;
    protected $password;
    protected $logger;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function setLogger(Logger $logger){
        $this->logger = $logger;
        $this->logger->log('ça fonctionne dans le GmailMailer');
    }

    public function send(Email $email)
    {
        //var_dump("ENVOI VIA GMAILMAILER", $email);
        dump("ENVOI VIA GMAILMAILER", $email);
    }
}
