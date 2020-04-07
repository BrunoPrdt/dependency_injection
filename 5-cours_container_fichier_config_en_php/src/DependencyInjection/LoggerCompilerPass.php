<?php

namespace App\DependencyInjection;

use App\Logger;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class LoggerCompilerPass implements CompilerPassInterface{


    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $idServices = $container->findTaggedServiceIds('with_logger');//on recup tous les id av tags
        //dump($id);//on verif
        foreach ($idServices as $id => $service) {
            $definition = $container->getDefinition($id);//recup de la def via l'id
            $service = $definition->addMethodCall('setLogger', [new Reference(Logger::class)]);
        }
    }
}