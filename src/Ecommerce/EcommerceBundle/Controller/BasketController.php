<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BasketController extends Controller
{
	public function basketViewAction()
	{
		return $this->render('EcommerceBundle:Default:basket/basket_view.html.twig');
	}

	public function basketDeliveryAction()
	{
		return $this->render('EcommerceBundle:Default:basketDelivery/basket_delivery.html.twig');
	}

	public function basketValidationAction()
	{
		return $this->render('EcommerceBundle:Default:basketValidation/basket_validation.html.twig');
	}
}
