<?php

/**
 * Used to manage the Product CRUD
 */

namespace Ecommerce\EcommerceBundle\Controller;

use Doctrine\ORM\NoResultException;
use Ecommerce\EcommerceBundle\Entity\Category;
use Ecommerce\EcommerceBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{

	public function productListAllOrByCategoryAction(Category $category = null, Request $request){

		if( $category !== null ){
			$q_products       = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->getProductsByCategory( $category );
		}else{
			$q_products       = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findBy( array( 'isonline' => 1 ) );
		}
		$nbProducts = count($q_products);
		$products = $this->get('knp_paginator')->paginate($q_products,$request->query->get('page', 1),3);

		return $this->render("EcommerceBundle:Default:product/product_list.html.twig", array(
			'products'      => $products,
			'nbProducts'    => $nbProducts
		));
	}

	/**
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function productDetailAction($id, Request $request){
		$session = $request->getSession();
		if( $session->has('basket') ){ $prodsInBasket = $session->get('basket');}else{ $prodsInBasket = false; }
		$product = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->find($id);
		if( !$product ){ throw new NotFoundHttpException('Hoops... The page you\'re searching doesn\'t exists or has been removed :-( '); }

		return $this->render("EcommerceBundle:Default:product/product_detail.html.twig", array(
			'product'       => $product,
			'prodsInBasket' => $prodsInBasket
		) );
	}

	public function productCreateAction(){
		return $this->render("EcommerceBundle:Default:product/product_create.html.twig");
	}

	public function productEditAction(){//$id

		return $this->render("EcommerceBundle:Default:product/product_edit.html.twig"); //, array( 'id' => $id )
	}

	public function productDeleteAction(){//$id

		return $this->render("EcommerceBundle:Default:product/product_delete.html.twig"); //, array( 'id' => $id )
	}

	public function productSearcFormAction(){
		$form = $this->get('form.factory')->create( SearchType::class );

		return $this->render('EcommerceBundle:Includes:product_search_form.html.twig', array( 'form' => $form->createView() ));
	}

	public function productSearchResultsAction($terms=null, Request $request){
		$form = $this->get('form.factory')->create( SearchType::class );

		if( $request->isMethod('POST') && $form->handleRequest($request)->isValid() ){
			$terms =  $form['search']->getData();
			$productsFoundBySearch = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->getProductsByTermsSearched($terms);

			if( count( $productsFoundBySearch ) < 1 ){
				$request->getSession()->getFlashBag()->add('info', 'Sorry, no result found for: " '.$terms.'" .');
				return $this->redirectToRoute('ecommerce_product_list');
			}else{
				return $this->render('EcommerceBundle:Default:product/product_search_results.html.twig',array( 'productsFoundBySearch' => $productsFoundBySearch ) );
			}
		}
		$request->getSession()->getFlashBag()->add('warning', 'You don\'t have permission to access that page or the terms aren\'t valid' );

		return $this->redirectToRoute('ecommerce_homepage');
	}

}
