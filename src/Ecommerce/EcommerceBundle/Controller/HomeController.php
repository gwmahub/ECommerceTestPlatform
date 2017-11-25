<?php


namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

	public function indexAction(){

		// A changer vers une sélection à déterminer -> derniers enregistré, promos du mois,...
		$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findBy( array( 'isonline' => 1 ),array( 'name'=>'ASC' ), 3, null );

		return $this->render("EcommerceBundle:Default:index.html.twig", array( 'products' => $products )); // home with products list
	}
	/**
	 * Navigation modules
	 */
	public function catalogueMenuBlocNavAction(  ){

		return $this->render('EcommerceBundle:Includes:ModulesLeft/catalogue_menu_bloc_nav.html.twig');
	}

}