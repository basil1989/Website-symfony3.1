<?php
// src/AppBundle/Form/RegistrationType.php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('jobTitle');
        $builder->add('organization');
        $builder->add('charityNumber');
        $builder->add('workAddress');
        $builder->add('workPostcode');
        $builder->add('workTelephone');
        $builder->add('taxUk', ChoiceType::class, array('expanded' => true,"label"=>"Does your organisation pay tax in UK?", 'choices'  => array(
            'Yes' => 'Yes',
            'No' => 'No',
            'I don´t know' => 'n/a',
        ),'required'=>true));
	    $builder->add('gdpr', HiddenType::class, array('data' => '1',));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
