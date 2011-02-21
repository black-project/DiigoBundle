<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('index', new Route('/diigo/', array(
    '_controller' => 'DiigoBundle:Diigo:index',
)));
$collection->add('show', new Route('/diigo/{username}', array(
    '_controller' => 'DiigoBundle:Diigo:show',
)));

return $collection;
