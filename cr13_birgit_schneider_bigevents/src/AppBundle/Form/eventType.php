<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class eventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            
            ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('image', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('capacity', IntegerType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('contact', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('phonenumber', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('streetname', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('streetnumber', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('postalcode', IntegerType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('city', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
            ->add('eventType', ChoiceType::class, array('choices'=>array('Music'=>'Music', 'Sport'=>'Sport', 'Exhibition'=>'Exhibition', 'Movie'=>'Movie', 'Theater'=>'Theater' ),'attr' => array('class'=> 'form-control', 'style'=>'margin-botton:15px')))
            ->add('startDate', DateTimeType::class, array('attr' => array('style'=>'margin-bottom:15px')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }
    
 
    

}
