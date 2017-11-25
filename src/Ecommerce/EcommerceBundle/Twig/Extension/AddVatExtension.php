<?php


namespace Ecommerce\EcommerceBundle\Twig\Extension;


class AddVatExtension extends \Twig_Extension {

	public function getFilters() {

		return array( new \Twig_SimpleFilter('addvat', array( $this, 'getPriceInclVat' )) );
	}

	public function getPriceInclVat($priceExclVat, $vat){

		return round(($priceExclVat * $vat), 2);
	}

	public function getName() {

		return 'AddVatExtension';
	}

}