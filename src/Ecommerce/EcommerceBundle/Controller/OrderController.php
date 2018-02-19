<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Doctrine\ORM\NoResultException;
use Doctrine\ORM\ORMException;
use Ecommerce\EcommerceBundle\Entity\Address;
use Ecommerce\EcommerceBundle\Entity\UserOrder;
use Ecommerce\EcommerceBundle\Entity\Product;
use Ecommerce\EcommerceBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\SessionUnavailableException;

class OrderController extends Controller
{
	/**
	 * Méthode appellée au click sur payer. Formulaire en POST avec l'id de la commande envoyé à l'api de la banque
	 * @param Request $request
	 * @param $orderid
	 *
	 * @return RedirectResponse
	 */
	public function redirectAfterOrderValidationAction( Request $request, $orderid ){

		if( !$this->get('ecommerce.order_manager')->orderValidation()  ) {
			$message = $request->getSession()->getFlashBag()->add( 'danger', 'Un problème est survenu au moment de la validation de votre commande. BOUM ! hahahahahaahah !' );

			return $this->redirectToRoute( 'ecommerce_basket_validation' );
		}

		$message = $request->getSession()->getFlashBag()->add('success', 'Votre commande a bien été validée et le code a été généré. Merci de votre confiance');

		return $this->redirectToRoute( 'user_dashboard' );// à changer vers dashboard/factures

	}

}// END class
