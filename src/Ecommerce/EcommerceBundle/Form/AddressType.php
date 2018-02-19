<?php

namespace Ecommerce\EcommerceBundle\Form;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

class AddressType extends AbstractType
{

	private $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//	    /** @var \Doctrine\ORM\EntityManager $em */
//	    $em = $options['entity_manager'];

        $builder->add('firstname', TextType::class)
                ->add('lastname', TextType::class)
                ->add('address', TextType::class)
                ->add('addresscompl', TextType::class, array('required' => false))
                ->add('postcode', TextType::class, array('attr'=>array( 'class'=>'postcode', 'maxlength'=>5 ) ) )
                ->add('city', ChoiceType::class, array( 'attr'=>array(  'class'=>'city' ) ))
                ->add('country', TextType::class)
                ->add('phone', TextType::class)
                ->add('mobile', TextType::class)
//	            ->add('save',      SubmitType::class);
//              ->add('user')
				;

	    $city = function(FormInterface $form, $postcode) {
		    $villeCodePostal    = $this->em->getRepository('UserBundle:CitiesBe')->findBy(array('zip' => $postcode));
		    if ($villeCodePostal) {
			    $villes = array();
			    foreach($villeCodePostal as $ville) {
				    $villes[$ville->getName()] = $ville->getName();
			    }
		    } else {
			    $villes = null;
		    }

		    $form->add('city', ChoiceType::class, array( 'attr'=>array(  'class'=>'city' ), 'choices' => $villes ));
	    };

	    $builder->get('postcode')->addEventListener(
	    	FormEvents::POST_SUBMIT,
		    function(FormEvent $event) use ($city) {
		        $city($event->getForm()->getParent(),
			    $event->getForm()->getData());
	    });

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Address'
        ));
//	    $resolver->setRequired('entity_manager');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_address';
    }
//
//    public function getName(){
//    	return 'address_form';
//    }

}
