<?php

namespace Datamart\MappingsBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RoomtypeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('originalField', TextType::class)
            ->add('mappedField',   TextType::class)
            ->add('hotel',         EntityType::class, array(
                'class'        => 'DatamartInfosBundle:Hotel',
                'choice_label' => 'shortName'
            ))
            ->add('save',          SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Datamart\MappingsBundle\Entity\Roomtype'
        ));
    }
}
