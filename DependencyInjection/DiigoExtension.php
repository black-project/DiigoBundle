<?php

namespace Blackroom\DiigoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
// use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
// use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class DiigoExtension extends Extension {
    
    public function load(array $configs, ContainerBuilder $container) {
        
        $configuration = new Configuration();
        
        $processor = new Processor();
        $configs = $processor->process($configuration->getConfigTree(), $configs);    

        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        $loader->load('diigo.xml');
        
        // $loader = new YamlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        // $loader->load('diigo.yml');
        
        // $loader = new PhpFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        // $loader->load('diigo.php');
        
        foreach($configs as $attribute => $value)
        {
            $container->setParameter('diigo.' . $attribute, $value);
        }
        
    }

    public function getXsdValidationBasePath() {

        return null;
    }

    public function getNamespace() {

        return 'http://www.symfony-project.org/schema/dic/symfony';
    }

    public function getAlias() {

        return 'diigo';
    }
}