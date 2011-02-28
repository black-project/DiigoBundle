<?php

namespace Blackroom\DiigoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DiigoController extends Controller
{
  
    public function indexAction()
    {
        return $this->render('DiigoBundle:Diigo:index.html.twig');
    }
    
    public function showAction($username)
    {     
        $diigo = $this->get('diigo');
        $diigo->setUser('pockystar');
        $diigo->setStart(10);
               
        $result = $diigo->getBookmarks();
        
        $diigo->resetArguments();
        
        return $this->render('DiigoBundle:Diigo:show.html.twig', array('diigo' => $result));
    }
}
