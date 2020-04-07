<?php

use App\Controller\OrderController;
use App\Mailer\SmtpMailer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return function (ContainerConfigurator $configurator){
    $services = $configurator->services();
    $services->defaults()
        ->autowire(true)
        ->set($firstname, 'Bruno')
    ;

    $services
        ->set('order_controller', OrderController::class)
        ->public()
        ->call('setSecondaryMailer', [ref(SmtpMailer::class)])
        ->alias('App\Controller\OrderController', 'order_controller')->public();
};