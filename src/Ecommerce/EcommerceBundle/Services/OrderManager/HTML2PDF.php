<?php
/**
 */

namespace Ecommerce\EcommerceBundle\Services\OrderManager;

use Symfony\Component\DependencyInjection\ContainerInterface;

class HTML2PDF{

	private $myHtml2Pdf;
	private $container;


	public function create( $orientation = null, $format = null, $lang = null, $unicode = null, $encoding = null, $margin = null ){
		$this->myHtml2Pdf = new \Spipu\Html2Pdf\Html2Pdf(
		$orientation ? $orientation: $this->orientation,
		$format? $format:$this->format,
		$lang?$lang:$this->lang,
		$unicode?$unicode:$this->unicode,
		$encoding?$encoding:$this->encoding,
		$margin?$margin:$this->margin
		);
	}



	public function generatePdf ($location = null, $template, $name, $dest){
		$this->myHtml2Pdf->writeHTML($template);

		return $this->myHtml2Pdf->Output($name.'.pdf');

	}

	public function generatePdfOnDisk ($location = null, $template, $name, $dest){
		$this->myHtml2Pdf->writeHTML($template);

		return $this->myHtml2Pdf->Output($location.$name.'.pdf', $dest);
	}

}