<?php
/**
	Used to display the dashboard modules.
 * - User details
 * - Lasts orders & bills
 * - Lasts not validated orders
 * - Main address / last recorded address
 * - Wishlist
 * - Favorites
 * - Suggested products
 * ....
 */

namespace User\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use User\UserBundle\Entity\User;

class DashboardController extends Controller {

	public function dashboardAction(){

		return $this->render('UserBundle:Default:dashboard.html.twig');
	}
	/**
	 * Get the last non finished order to display it in the dashboard
	 * @param User $user
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function dashboardModuleLastOrdersNotValidatedAction(){
		$user                    = $this->get('security.token_storage')->getToken()->getUser();
		$lastOrdersNotValidated  = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->getTheLastNotValidatedOrdersByUser($user, 5);

		return $this->render('UserBundle:DashboardModules:dashLastNotValidatedOrders.html.twig', array(
			'lastOrdersNotValidated' => $lastOrdersNotValidated
			)
		);
	}
	/**
	 * Display the current user details
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function dashboardModuleUserDetailsAction(){
		$user = $this->get('security.token_storage')->getToken()->getUser();
		return $this->render( 'UserBundle:DashboardModules:dashUserPersoInfo.html.twig', array(
			'user' => $user
		) );
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function dashboardModuleLastsOrdersAction(){
		$user   = $this->get('security.token_storage')->getToken()->getUser();
		$orders = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:UserOrder')->getTheLastsOrdersByUser($user, 5);

		return $this->render( 'UserBundle:DashboardModules:dashLastOrders.html.twig', array(
			'orders' => $orders
		) );
	}

	public function dashboardModuleAddressAction(User $user){
		//... TODO: get the em and send the datas to a custom view for the module
	}

	public function dashboardModuleWishlistAction(User $user){
		//... TODO: get the em and send the datas to a custom view for the module
	}


}