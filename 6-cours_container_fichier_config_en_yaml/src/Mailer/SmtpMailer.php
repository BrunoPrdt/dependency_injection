<?php

namespace App\Mailer;

use App\HasLoggerInterface;
use App\Logger;

class SmtpMailer implements MailerInterface, HasLoggerInterface
{

    protected $dsn;
    protected $user;
    protected $password;

    public function __construct(string $dsn, string $user, string $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }

    public function setLogger(Logger $logger){
        $this->logger = $logger;
        $this->logger->log('Ca fonctionne dans le SmtpMailer');
    }

    public function send(Email $email)
    {
        //var_dump("ENVOI VIA SMTPMAILER ($this->dsn)", $email);
        dump("ENVOI VIA SMTPMAILER ($this->dsn)", $email);
    }
}
