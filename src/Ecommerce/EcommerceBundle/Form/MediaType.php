<?php

namespace Ecommerce\EcommerceBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType {

	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add('path', TextType::class)
			->add('alt', TextType::class)
		;
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class' => 'Ecommerce\EcommerceBundle\Entity\Media'
		) );
	}

//	/**
//	 * {@inheritdoc}
//	 */
//	public function getBlockPrefix()
//	{
//		return 'ecommerce_ecommercebundle_media';
//	}

}