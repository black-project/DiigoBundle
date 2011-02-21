<?php

namespace Blackroom\DiigoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{
    public function getConfigTree()
    {
        $tb = new TreeBuilder();

        return $tb
            ->root('diigo', 'array')
            ->scalarNode('username')->isRequired()->end()
            ->scalarNode('password')->isRequired()->end()
        ->end()
        ->buildTree();
    }
}
