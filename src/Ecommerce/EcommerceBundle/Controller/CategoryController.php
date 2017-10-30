<?php

namespace Ecommerce\EcommerceBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller {

	public function menuCategNavAction(){
		$categories = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Category')->findAll();

				return $this->render('EcommerceBundle:Includes:ModulesLeft/bloc_menucategnav.html.twig', array( 'categories' => $categories ));
	}
}