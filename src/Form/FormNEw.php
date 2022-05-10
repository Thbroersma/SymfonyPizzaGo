<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FormNEw extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voornaam')
            ->add('achternaam')
            ->add('adres')
            ->add('stad')
            ->add('postcode')
            ->add('grote')
            ->add('aantal')
            ;
    }

}