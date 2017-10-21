<?php

/**
 * Used to manage the Product CRUD
 */

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
	public function productListAction(){

		return $this->render("EcommerceBundle:Default:product/product_list.html.twig");
	}

	public function productDetailAction(){//$id

		return $this->render("EcommerceBundle:Default:product/product_detail.html.twig"); //, array( 'id' => $id )
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
