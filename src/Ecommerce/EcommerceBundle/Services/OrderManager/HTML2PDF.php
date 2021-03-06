<?php

namespace Ecommerce\EcommerceBundle\Services\OrderManager;

class HTML2PDF{

	private $myHtml2Pdf;

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

	public function generatePdf ( $template, $name ){
		$this->myHtml2Pdf->writeHTML($template);

		return $this->myHtml2Pdf->Output($name.'.pdf');
	}

	public function generatePdfOnDisk ($location, $template, $name, $dest){
		$this->myHtml2Pdf->writeHTML($template);

		return $this->myHtml2Pdf->Output($location.$name.'.pdf', $dest);
	}

}