<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 21/10/2016
 * Time: 10:47
 */

namespace Datamart\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('expression', TextType::class)
            ->add('search', SubmitType::class)
        ;
    }
}