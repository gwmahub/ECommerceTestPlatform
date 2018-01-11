<?php

namespace User\UserBundle\Controller;

//use Knp\Snappy\Pdf;
use Ecommerce\EcommerceBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;

class AddressAdminController extends Controller
{
	public function indexAction(){

		return $this->render('UserBundle:Admin:address/addressIndex.html.twig');
	}
	public function showAction(Address $address){

		return $this->render('UserBundle:Admin:address/addressShow.html.twig');
	}
	public function editAction(Address $address, Request $request){

		return $this->render('UserBundle:Admin:address/addressEdit.html.twig');
	}
	public function deleteAction(Address $address, Request $request){

		return $this->render('UserBundle:Admin:address/addressDelete.html.twig');
	}
}
