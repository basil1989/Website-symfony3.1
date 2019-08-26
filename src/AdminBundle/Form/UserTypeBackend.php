<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class UserTypeBackend extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, ['required'=>true])
            ->add('email', null, ['required'=>true])
            ->add('jobTitle')
            ->add('organisation', null, ['required'=>true,'label'=>'Organization'])
            ->add('charityNuber', null, ['label'=>'Charity Number'])
            ->add('workAddress')
            ->add('workPostcode')
            ->add('workTelephone')
            ->add('taxUk', ChoiceType::class, array('expanded' => true,"label"=>"Does your organisation pay tax in UK?", 'choices'  => array(
                'Yes' => 'Yes',
                'No' => 'No',
                'I don´t know' => 'n/a',
            )))
            ->add('gdpr', ChoiceType::class, array('expanded' => true, "label"=> "GDPR", 'choices' => array(
                'Yes' => '1',
                'No'  => '0'
            )))
            ->add('save', SubmitType::class, ['label' => 'Save',   'attr' => array('class' => 'btn btn-primary btn-sm','style' => 'float: left;margin-right:50px;'  )])
            ->add('cancel', ButtonType::class, ['label' => 'Cancel',   'attr' => array('class' => 'btn btn-sm', 'onclick'=>'history.back();')])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\User'
        ));
    }
}
