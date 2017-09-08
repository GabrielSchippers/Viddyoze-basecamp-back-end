<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\FormBuilderInterface;
use Symfony\Component\OptionResolver\OptionResolverInterface;

class AuthorType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $option
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('auther')
            ->add ('quote');
    }

    /**
    * @param OptionResolverInterface $resolver
    */
    public function setDefaultOptions(OptionResolverInterface $resolver) 
    {
        $resolver->setDefault(array(
            'data_class'=>'AppBundle/Entity/Author'
        ));
    }

    /**
    * @return string
    */
    public function getName(){
        return 'famousQuote_Author';
    }
}