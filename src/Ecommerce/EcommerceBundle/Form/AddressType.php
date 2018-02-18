<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class)
                ->add('lastname', TextType::class)
                ->add('address', TextType::class)
                ->add('addresscompl', TextType::class, array('required' => false))
                ->add('postcode', TextType::class, array('attr'=>array( 'class'=>'postcode', 'maxlength'=>5 ) ) )
                ->add('city', TextType::class, array( 'attr'=>array(  'class'=>'city' ) ))
                ->add('country', TextType::class)
                ->add('phone', TextType::class)
                ->add('mobile', TextType::class)
//	            ->add('save',      SubmitType::class);
//              ->add('user')
				;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_address';
    }


}
