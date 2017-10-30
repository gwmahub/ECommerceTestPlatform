<?php

namespace Ecommerce\EcommerceBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType {

	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add('search', TextType::class)
			->add('send', SubmitType::class)
		;
	}

//	public function configureOptions( OptionsResolver $resolver ) {
//		$resolver->setDefault( array(
//			'data_class' => 'Ecommerce\EcommerceBundle\Entity\Search'
//		) );
//	}

}