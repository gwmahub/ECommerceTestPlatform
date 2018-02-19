<?php
/**
 * Used to display the pages linked to the User activities
 * - User details
 * - change the password
 * - Bills and bill details (pdf)
 * - Wishlist ??
 * - navigation modules
 */
namespace User\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;

class UserController extends Controller
{
    public function dashboardAction(){

        return $this->render('UserBundle:Default:dashboard.html.twig');
    }


    public function billsListAction(){
		$userBills = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->getBillsByUser( $this->getUser() );

		return $this->render('UserBundle:Default:billsList.html.twig', array( 'userbills' => $userBills ));
    }


    public function billPDFAction($orderid){
    	$bill = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->findOneBy( array(
    	    'user' => $this->getUser(),
		    'valid' => 1,
		    'id' => $orderid
	    ));
    	if( !$bill ){
    		$this->get('session')->getFlashBag()->add('danger', 'Critical error during the pdf rendering. Please retry');
	    }

	    $template   = $this->renderView("UserBundle:Default:bill.html.twig", array('bill' => $bill ) );
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
