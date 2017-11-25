<?php


namespace Ecommerce\EcommerceBundle\Twig\Extension;


class VatAmountExtension extends \Twig_Extension {

	public function getFilters() {

		return array( new \Twig_SimpleFilter('vatamt', array( $this, 'getVatAmount' )) );
	}

	public function getVatAmount($priceExclVat, $vat){

		return round(($priceExclVat * ($vat - 1) ), 2, PHP_ROUND_HALF_EVEN);
	}

	public function getName() {

		return 'VatAmountExtension';
	}

}