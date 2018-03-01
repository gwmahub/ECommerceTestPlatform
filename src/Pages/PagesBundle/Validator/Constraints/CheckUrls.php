<?php

namespace Pages\PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class CheckUrls
 * @package Pages\PagesBundle\Validator\Constraints
 * @Annotation()
 */
class CheckUrls extends Constraint {

	public $message = 'Attention, liens erronés trouvés !';
}