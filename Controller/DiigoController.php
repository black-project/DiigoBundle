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

        $result = $diigo->getBookmarks(array(
                                    'user' => $username,
                                    'count' => 10
                                  ));  
        
        return $this->render('DiigoBundle:Diigo:show.html.twig', array('diigo' => $result));
    }
}
