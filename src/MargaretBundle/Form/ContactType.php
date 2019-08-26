<?php

namespace MargaretBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,['label'=>'First Name','required'=>true])
            ->add('last',TextType::class,['label'=>'Last Name','required'=>true])
            ->add('email',EmailType::class,['label'=>'Email','required'=>true])
            ->add('address',TextType::class,['label'=>'Address','required'=>false])
            ->add('phone',TextType::class,['label'=>'Phone','required'=>false])
            ->add('message',TextareaType::class,['label'=>'Message','required'=>true,  'attr' => array('style' => 'min-height:130px;')])
            ->add('save', SubmitType::class,['label' => 'Send',   'attr' => array('class' => 'btn btn-primary btn-sm','style' => 'float: left;margin-right:50px;'  )])


        ;
    }


}
