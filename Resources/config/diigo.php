<?php

use Symfony\Component\DependencyInjection\Definition;

$container->setParameter('diigo.class','Blackroom\DiigoBundle\Service\DiigoAPI');
$container->setParameter('diigo.key','null');
$container->setParameter('diigo.username','null');
$container->setParameter('diigo.password','null');

$container->setDefinition('diigo', new Definition(
        '%diigo.class%',
        array(
            'key' => '%diigo.key%',
            'username' => '%diigo.username%',
            'password' => '%diigo.password%'
            )
        ));
