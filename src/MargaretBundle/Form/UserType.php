<?php

namespace MargaretBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username')
        ->add('jobTitle')
        ->add('organization',null,array("label"=>"Organization"))
        ->add('charityNuber')
        ->add('workAddress')
        ->add('workPostcode')
        ->add('workTelephone')
        ->add('taxUk', ChoiceType::class, array('expanded' => true,"label"=>"Does your organisation pay tax in UK?", 'choices'  => array(
            'Yes' => 'Yes',
            'No' => 'No',
            'I don´t know' => 'n/a',
        )));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
