<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinanceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ticker', TextType::class, array(
                'label' => 'Stock ticker',
                'attr' => [
                    'placeholder' => 'For example AAPL',
                ]
            ))
            ->add('time_from', TextType::class, array(
                'label' => 'Time period from',
                'attr' => [
                    'placeholder' => 'For example 2020-11-01',
                ]
            ))
            ->add('time_to', TextType::class, array(
                'label' => 'to',
                'attr' => [
                    'placeholder' => 'For example 2020-12-01',
                ]
            ))
            ->add('show', SubmitType::class, array(
                'label' => 'Show',
                'attr' => [
                    'class' => 'btn btn-success btn-block',
                ]
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }
}
