<?php

namespace Pages\PagesBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
	public function menuAction(){
		$pages = $this->getDoctrine()->getManager()->getRepository('PagesBundle:Page')->findAll();

		return $this->render('PagesBundle:Menus:menu.html.twig', array( 'pages' => $pages ));
	}

    public function pageViewAction($id)
    {
	    $page = $this->getDoctrine()->getManager()->getRepository('PagesBundle:Page')->find($id);

	    if( !$page ){ throw new EntityNotFoundException('La page demandée n\'existe pas :-('); }

        return $this->render('PagesBundle:Default:page_view.html.twig', array( 'page' => $page ));
    }
}
