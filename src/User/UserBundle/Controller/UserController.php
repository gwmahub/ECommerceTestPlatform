<?php
/**
 * Used to display the pages linked to the User activities
 * - User details
 * - change the password
 * - Orders and Order details (HTML)
 * - Bills and bill details (pdf)
 * - Wishlist ??
 * - navigation modules
 */
namespace User\UserBundle\Controller;


use Ecommerce\EcommerceBundle\Entity\UserOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

// +++++ NOT FINISHED/VALIDATED ORDERS +++++ //

	public function listNotValidatedOrdersAction(){
		$user    = $this->get('security.token_storage')->getToken()->getUser();
		$orders  = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->getTheLastNotValidatedOrdersByUser($user, -1);

		return $this->render('UserBundle:DashboardModules:dashLastNotValidatedOrders.html.twig', array(
				'orders' => $orders
			)
		);
	}
	/**
	 * Edit the not finished/validated order
	 * Send the products and quantities in the current order in session
	 * @param UserOrder $order
	 */
	public function editTheNotValidatedOrderAction(UserOrder $order){

	}
	public function deleteNotValidatedOrderAction(){
		// TODO : créer formulaire
	}
	public function getAndInjectProdsInCurrentOrderAction(){
		// TODO : récupérer la session en cours et injecter les id produits => qté -> OrderManager ??
		// TODO : renvoyer vers le panier
	}
// +++++ ORDERS&BILLS +++++ //
	/**
	 * Display the user orders
	 * @return Response
	 */
	public function listOrdersAction(){
		$user   = $this->get('security.token_storage')->getToken()->getUser();
		$orders = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->findBy(
			['user' => $user, 'valid' => 1],
			['id'   => 'DESC']
		);
		return $this->render('UserBundle:Default:orderIndex.html.twig', array(
			'orders' => $orders
		));
	}
	public function showOrderAction( UserOrder $order ){

		return $this->render('UserBundle:Default:orderShow.html.twig', array(
			'order' => $order
		));
	}
    public function billsListAction(){
		$userBills = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->getBillsByUser( $this->getUser() );

		return $this->render('UserBundle:Default:billsList.html.twig', array( 'userbills' => $userBills ));
    }
	/**
	 * Get the data's of the valid and finished order and send them to the ecommerce.order_html2pdf service to create the PDF bill file.
	 * @param $orderid
	 *
	 * @return mixed
	 */
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
//+++++ MENU +++++ //
	/**
	 * Menu displayed by default
	 * @return Response
	 */
    public function userNonConnectedMenuBlocNavAction(){

	    return $this->render('UserBundle:Includes:ModulesLeft/user_non_connected_menu_bloc_nav.html.twig');
    }

	/**
	 * Menu displayed if the user is authenticated
	 * @return Response
	 */
    public function userDashboardMenuBlocNavAction(){

    	return $this->render('UserBundle:Includes:ModulesLeft/user_dashboard_menu_bloc_nav.html.twig');
    }
}
