<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ApplicationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array("label"=>"Name"))
            ->add('age', null, array("label"=>"Age", 'attr' => array('min' => 1, 'max' => 150)))
            ->add('address', null, array("label"=>"Address"))
            ->add('illness', null, array("label"=>"Type of illness"))
            ->add('purpose', null, array("label"=>"Purpose of grant"))
            ->add('amount', null, array("label"=>"Amount of grant"))
            ->add('organisation', null, array("label"=>"Organisation to whom cheque should be made"))
            ->add('family', null, array("label"=>"Family in a position to assist"))
            ->add('taxUk', ChoiceType::class, array('expanded' => true,"label"=>"Is the applicant resident outside the UK for Tax?", 'choices'  => array(
                'Yes' => 'Yes',
                'No' => 'No',
                'I don´t know' => 'n/a',
            ),'required'=>true))
            ->add('nhs', ChoiceType::class, array('expanded' => true,"label"=>"Is the item/service you are seeking available on the NHS?", 'choices'  => array(
                'Yes' => true,
                'No' => false,
            ),'required'=>true))
            ->add('steps', null, array("label"=>"Please identify the steps you have taken to apply for funding elsewhere"))
            ->add('wages', null, array("label"=>"Wages, Salary, Pension"))
            ->add('housing', null, array("label"=>"Housing benefit"))
            ->add('tax', null, array("label"=>"Council tax benefit"))
            ->add('employment', null, array("label"=>"Job seekers allowance"))
            ->add('incomesupport', null, array("label"=>"Income support"))
            ->add('childbenefit', null, array("label"=>"Child benefit"))
            ->add('childtax', null, array("label"=>"Child tax credit"))
            ->add('workingtaxcredit', null, array("label"=>"Working tax credit"))
            ->add('incapacitybenefit', null, array("label"=>"Incapacity benefit"))
            ->add('carersallowence', null, array("label"=>"Attendance allowance"))
            ->add('personalindependence', null, array("label"=>"Personal Independence Payment, P.I.P."))
            ->add('disability', null, array("label"=>"Disability living allowance (care /mobility)"))
//            ->add('disability2',null,array("label"=>"Disability living allowance (mobility)"))
            ->add('other', null, array("label"=>"Other Disablement Allowance"))
            ->add('rent', null, array("label"=>"Rent"))
            ->add('mortgages', null, array("label"=>"Mortgages"))
            ->add('housingcost', null, array("label"=>"Housing cost, Council Tax, Service charge, Insurance"))
            ->add('utilities', null, array("label"=>"Water / Sewage / Gas/Electric / Coal and other Fuels(i.e. Bottled Gas)"))
            ->add('food', null, array("label"=>"Food, General Housekeeping including subscriptions, papers, magazines, cigarettes, sweets, alcohol"))
            ->add('childcare', null, array("label"=>"Childcare, general expenses"))
            ->add('liabilities', null, array("label"=>"Liabilities, Debts, please list"))
            ->add('maintenance', null, array("label"=>"Maintenance / Court Fines / Orders / Life Insurance / HP / TV Licence / Telephone"))
            ->add('fares', null, array("label"=>"Fares, Car costs inc. insurance, MOT. tax, repayments"))
            ->add('specialneeds', null, array("label"=>"Prescriptions, Special needs"))
            ->add('weekincome', null, array("label"=>"Total weekly income"))
            ->add('weekexpenditure', null, array("label"=>"Total weekly expenditure"))
            ->add('savings', null, array("label"=>"Savings"))
            ->add('othercomment', null, array("label"=>"Any other comments you may wish to add"))
            ->add('save', SubmitType::class, ['label' => 'Submit & Apply',   'attr' => array('class' => 'btn btn-primary ','style' => 'float: left;margin-right:50px;'  )])

        ;
    }



    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Application'
        ));
    }
}
