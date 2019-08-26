<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('text', null, ['label'=>'Content','attr'=>['class'=>'tinymce','style'=>'min-height:300px;']])
            ->add('seoTitle', null, ['label'=>'SEO Title'])
            ->add('seoDesc', null, ['label'=>'SEO Description'])
            ->add('seoKey', null, ['label'=>'SEO Keywords'])
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
            'data_class' => 'AdminBundle\Entity\Page'
        ));
    }
}
