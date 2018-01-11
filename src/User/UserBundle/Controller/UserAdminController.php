<?php

namespace User\UserBundle\Controller;

//use Knp\Snappy\Pdf;
use Ecommerce\EcommerceBundle\Entity\UserOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use User\UserBundle\Entity\User;

class UserAdminController extends Controller
{
    public function indexAction(){

    	$users  = $this->getDoctrine()->getManager()->getRepository('UserBundle:User')->findAll();

        return $this->render('UserBundle:Admin:index.html.twig', array(
            'users' => $users,
        ));
    }

    public function showAction(User $user){

    	return $this->render('UserBundle:Admin:show.html.twig', array( 'user' => $user ));
    }

    public function newAction(Request $request){

	    return $this->render('UserBundle:Admin:new.html.twig');
    }

    public function editAction(User $user, Request $request){

	    return $this->render('UserBundle:Admin:edit.html.twig', array( 'user' => $user ));
    }

    public function deleteAction(User $user, Request $request){

	    return $this->render('UserBundle:Admin:delete.html.twig', array( 'user' => $user ));
    }


    public function addressesOrBillsAction( User $user, Request $request ){
    	if( $request->get('_route') === 'admin_user_addresses' ){
		    return $this->render('UserBundle:Admin:userAddresses.html.twig', array( 'user' => $user ));
	    }elseif($request->get('_route') === 'admin_user_bills'){
		    return $this->render('UserBundle:Admin:userBills.html.twig', array('user' => $user,));
	    }else{
    		throw new ResourceNotFoundException('This page doesn\'t exist or has been removed');
	    }
    }


}
