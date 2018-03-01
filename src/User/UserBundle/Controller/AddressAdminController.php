<?php

namespace User\UserBundle\Controller;

//use Knp\Snappy\Pdf;
use Ecommerce\EcommerceBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddressAdminController extends Controller
{
	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(){

		return $this->render('UserBundle:Admin:address/addressIndex.html.twig');
	}

	/**
	 * @param Address $address
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Address $address){

		return $this->render('UserBundle:Admin:address/addressShow.html.twig');
	}

	/**
	 * @param Address $address
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function newAction(Address $address, Request $request){

		return $this->render('UserBundle:Admin:address/addressNew.html.twig');
	}

	/**
	 * @param Address $address
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Address $address, Request $request){

		return $this->render('UserBundle:Admin:address/addressEdit.html.twig');
	}

	/**
	 * @param Address $address
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function deleteAction(Address $address, Request $request){

		return $this->render('UserBundle:Admin:address/addressDelete.html.twig');
	}
}
