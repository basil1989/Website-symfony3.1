<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class LinkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('description', null, ['attr'=>['class'=>'tinymce','style'=>'min-height:300px;']])
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
            'data_class' => 'AdminBundle\Entity\Link'
        ));
    }
}
