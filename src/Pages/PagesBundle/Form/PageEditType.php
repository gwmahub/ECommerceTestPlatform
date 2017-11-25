<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class PageEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('createdat')
//                ->add('updatedat', DateType::class,  array(
//				    'widget' => 'choice',
//				    'data' => new \DateTime("now"),
//			    ))
//                ->add('updatedat', DateType::class,  array(
//	                'widget' => 'choice',
//                ))
        ;
    }

    public function getParent() {
	    return PageType::class;
    }

}
