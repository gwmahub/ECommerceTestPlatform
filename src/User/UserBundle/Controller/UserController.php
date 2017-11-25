<?php

namespace User\UserBundle\Controller;

//use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;

class UserController extends Controller
{
    public function dashboardIndexAction(){

        return $this->render('UserBundle:Default:dashboard_index.html.twig');
    }

    public function dashboardBillsListAction(){
		$userBills = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->getBillsByUser( $this->getUser() );
//var_dump($userBills);die;
		return $this->render('UserBundle:Default:dashboard_bills_list.html.twig', array( 'userbills' => $userBills ));
    }

    public function dashboardBillPDFAction($orderid){
    	$bill = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->findOneBy( array(
    	    'user' => $this->getUser(),
		    'valid' => 1,
		    'id' => $orderid
	    ));
//		var_dump( $bill->getOrderfullref() );die;

    	if( !$bill ){
    		$this->get('session')->getFlashBag()->add('danger', 'Critical error during the pdf rendering. Please retry');
	    }

	    $template   = $this->renderView("UserBundle:Default:dashboard_bill.html.twig", array('bill' => $bill ) );
		$name       = $bill->getId().'_'.$bill->getOrderfullref();

	    $html2pdf   = $this->get('ecommerce.order_html2pdf');
    	$html2pdf->create( 'P','A4', 'fr', true, 'UTF-8', array(5, 5, 5, 8) );


		return $html2pdf->generatePdf ($template, $name);
    }


    public function userNonConnectedMenuBlocNavAction(){

	    return $this->render('UserBundle:Includes:ModulesLeft/user_non_connected_menu_bloc_nav.html.twig');

    }

    public function userDashboardMenuBlocNavAction(){

    	return $this->render('UserBundle:Includes:ModulesLeft/user_dashboard_menu_bloc_nav.html.twig');
    }
}
