<?php

namespace Ecommerce\EcommerceBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//	            ->add('createdat', DateType::class, array('label_attr' => array('class' => 'hidden'), 'attr' => array('class'=>'hidden')))
//              ->add('updatedat')
                ->add('code')
                ->add('name')
                ->add('description', CKEditorType::class)
                ->add('price')
                ->add('availability')
                ->add('isonline')
		        ->add('image', MediaType::class)
	        // Pas de Type pour category et vat.
	        // Ajout de la méthode __toString() dans l'entité Category pour la conversion de l'objet en string
	        // ET permettre l'affichage du champ select et des options en front
		        ->add('category')
                ->add('vat');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_product';
    }


}
