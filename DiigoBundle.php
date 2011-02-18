<?php

/**
 * Provide a simple api connector for Diigo.com
 * 
 * @package DiigoBudnle
 * @author alexandre 'pocky' Balmes
 */

namespace Blackroom\DiigoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DiigoBundle extends Bundle
{ 
    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return __DIR__;
    }
}
