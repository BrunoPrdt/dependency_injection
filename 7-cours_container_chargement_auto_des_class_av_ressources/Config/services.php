<?php

use App\Controller\OrderController;
use App\Database\Database;
use App\Logger;
use App\Mailer\GmailMailer;
use App\Mailer\SmtpMailer;
use App\Texter\FaxTexter;
use App\Texter\SmsTexter;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return function (ContainerConfigurator $configurator) {

    $parameters = $configurator->parameters();
    $parameters
        ->set('mailer.gmail_user', 'monmail@gmail.com')
        ->set('mailer.gmail_password', '123456')
        ->set('texter.sms_serviceDns', 'services.sms.com')
        ->set('texter.sms_key', 'apikey123')
        ->set('mailer.smtp_dns', '142.0.2.1')
        ->set('mailer.smtp_user', 'contact@brunopredot.com')
        ->set('mailer.smtp_password', 'monMDP')
    ;
    $services = $configurator->services();
    $services->defaults()->autowire(true);
    $services
        ->set('database', Database::class)
        ->alias('App\Database\Database', 'database');
    $services
        ->set('mailer.gmail', GmailMailer::class)
        ->args(['%mailer.gmail_user%', '%mailer.gmail_password%'])
        ->tag('with_logger')
        ->alias('App\Mailer\GmailMailer', 'mailer.gmail')
        ->alias('App\Mailer\MailerInterface', 'mailer.gmail');
    $services
        ->set('texter.sms', SmsTexter::class)
        ->args(["%texter.sms_serviceDns%", "%texter.sms_key%"])
        ->tag('with_logger')
        ->alias('App\Texter\SmsTexter', 'texter.sms')
        ->alias('App\Texter\TexterInterface', 'texter.sms');
    $services
        ->set('texter.fax', FaxTexter::class)
        ->alias('App\Texter\FaxTexter', 'texter.fax');
    $services
        ->set('mailer.smtp', SmtpMailer::class)
        ->args(['%mailer.smtp_dns%', '%mailer.smtp_user%', '%mailer.smtp_password%'])
        ->alias('App\Mailer\SmtpMailer', 'mailer.smtp');
    $services
        ->set('order_controller', OrderController::class)
        ->public()
        ->call('sayHello', ["Bonjour à tous!", 41])
        ->call('setSecondaryMailer', [ref(SmtpMailer::class)])
        ->alias('App\Controller\OrderController', 'order_controller')->public();
    $services
        ->set('logger', Logger::class)
        ->alias('App\Logger', 'logger')
    ;
};