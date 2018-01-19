<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\UserOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\UserBundle\Entity\User;


class OrderAdminController extends Controller {

	public function indexAction (){
		$em     = $this->getDoctrine()->getManager();
		$orders = $em->getRepository('EcommerceBundle:UserOrder')->findAll();

		return $this->render("EcommerceBundle:Admin:order/index.html.twig", array(
			'orders'=> $orders
		));
	}

	public function showOrderHtmlAction( UserOrder $order ){
		$order = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->find($order);

		return $this->render('EcommerceBundle:Admin:order/show.html.twig', array(
			'order' => $order
		));
	}

	public function showBillPdfAction(UserOrder $order){
		$bill = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->find( $order );
		if( !$bill ){
			$this->get('session')->getFlashBag()->add('danger', 'Critical error during the pdf rendering. Please retry');
		}
		$template   = $this->renderView("UserBundle:Default:dashboard_bill.html.twig", array('bill' => $bill ) );
		$name       = $bill->getId().'_'.$bill->getOrderfullref();
		$html2pdf   = $this->get('ecommerce.order_html2pdf');
		$html2pdf->create( 'P','A4', 'fr', true, 'UTF-8', array(5, 5, 5, 8) );

		return $html2pdf->generatePdf ('',$template, $name, 'I');

	}

}