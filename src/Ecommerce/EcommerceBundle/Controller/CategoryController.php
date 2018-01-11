<?php

namespace Ecommerce\EcommerceBundle\Controller;


use Ecommerce\EcommerceBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller {
	/**
	 * Used to display the list of the availables categories with the number of products in each category
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getProductCategoriesAction(){
		$categories             = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Category')->findAll();
		$nbProductsByCategory   = array();
		foreach( $categories as $category => $data ){
			$nbProductsByCategory[]   = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->countProductsByCateg($data->getId());
		}
		return $this->render('EcommerceBundle:Includes:ModulesLeft/categories_list.html.twig', array(
			'categories'            => $categories,
			'nbProductsByCategory'  => $nbProductsByCategory
		));
	}

	public function getTheCategoryAction($categId){
		$category = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Category')->getTheCategory($categId);

		return $this->render('EcommerceBundle:Includes:current_category_datas.html.twig', array(
			'category' => $category
		) );
	}
}