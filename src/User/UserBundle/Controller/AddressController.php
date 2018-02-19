<?php

namespace User\UserBundle\Controller;

use Doctrine\ORM\EntityManager;
use Ecommerce\EcommerceBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;

class AddressController extends Controller
{
	public function indexAction(){

		return $this->render('UserBundle:Default:addressIndex.html.twig');
	}


	public function showAction(Address $address){

		return $this->render('UserBundle:Default:addressShow.html.twig');
	}

	public function newAction(Request $request){

		return $this->render('UserBundle:Default:addressNew.html.twig');
	}


	public function editAction(Address $address, Request $request){

		return $this->render('UserBundle:Default:addressEdit.html.twig');
	}


	public function deleteAction(Address $address, Request $request){

		return $this->render('UserBundle:Default:addressDelete.html.twig');
	}

	public function citiesBeAction(Request $request, $pc){
		$cities = $this->getDoctrine()->getManager()->getRepository('UserBundle:CitiesBe')->findBy( array( 'zip' => $pc ) );
		if( $request->isXmlHttpRequest() ){
			if( count($cities) > 0 ){
				$citiesName = array();
				foreach( $cities as $city ){
					$citiesName[] = $city->getName();
				}
			}else{
				$citiesName = null;
			}

			$jsonResponse = new JsonResponse();

			return $jsonResponse->setData( array( 'cities' => $citiesName ) );
		}

		throw new Exception('Request not allowed');

	}


}
