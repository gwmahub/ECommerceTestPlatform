<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PageEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     * MEMO: not needed anymore thanks to Timestampable wich handle the createdat and updatedat
     */
//    public function buildForm(FormBuilderInterface $builder, array $options){
//        $builder->remove('createdat');
//    }

    public function getParent() {
	    return PageType::class;
    }

}
