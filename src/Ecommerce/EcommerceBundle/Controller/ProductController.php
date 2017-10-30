<?php

/**
 * Used to manage the Product CRUD
 */

namespace Ecommerce\EcommerceBundle\Controller;

use Doctrine\ORM\NoResultException;
use Ecommerce\EcommerceBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function productListAction(){
		$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findBy( array( 'isonline' => 1 ) );

		return $this->render("EcommerceBundle:Default:product/product_list.html.twig", array( 'products' => $products ) );
	}

	/**
	 * @param $categid
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function productsByCategoryAction($categid){
		$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->getProductsByCategory($categid);
		if( !$products ){ throw new NotFoundHttpException('Hoops... The page you\'re searching doesn\'t exists or has been removed :-( '); }
		return $this->render('EcommerceBundle:Default:product/products_by_categ.html.twig', array( 'products' => $products ));
	}



	public function productSearcFormAction(){
		$form = $this->get('form.factory')->create( SearchType::class );

		return $this->render('EcommerceBundle:Includes:product_search_form.html.twig', array( 'form' => $form->createView()	));
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

	/**
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function productDetailAction($id){//$id
		$product = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->find($id);
		if( !$product ){ throw new NotFoundHttpException('Hoops... The page you\'re searching doesn\'t exists or has been removed :-( '); }

		return $this->render("EcommerceBundle:Default:product/product_detail.html.twig", array( 'product' => $product ) );
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
}
