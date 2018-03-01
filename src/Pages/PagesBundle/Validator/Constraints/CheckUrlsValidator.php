<?php

namespace Pages\PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckUrlsValidator extends ConstraintValidator{
	/**
	 * @param $site
	 *
	 * @return bool
	 */
	public function curlUrl( $site ){
		$site = curl_init($site);
		curl_setopt($site, CURLOPT_FAILONERROR, true);
		curl_setopt($site, CURLOPT_NOBODY, true);

		$curl = curl_exec($site) === false ? false : true;

		curl_close( $site );

		return $curl;
	}

	/**
	 * @param $value    the text to scan to find urls
	 */
	public function findUrl( $value ){
		$violation = false;
		$badUrls = array();
		$urls = preg_match_all('/<a href="(.*)">/', $value, $url);

		foreach( array_unique( $url[1] ) as $site ){
			$violation = $this->curlUrl($site) === true ? false : true;
		}

		return $violation; // must be to false
	}

	/**
	 * @param mixed $value the text to scan to find urls
	 * @param Constraint $constraint
	 */
	public function validate( $value, Constraint $constraint ){
		var_dump( $this->curlUrl( 'http://zdefzrgthyujktrgf' ) );
//		if( !$this->findUrl($value) ){ $this->context->addViolation($constraint->message); }
	}

}