<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('executor', EntityType::class, array(
                'label' => 'Who will execute the task?',
                'class' => User::class,
                'choice_label' => 'name',
                ))
            ->add('author', TextType::class, array(
                'label' => 'Who write the task?',
                'attr' => [
                    'placeholder' => 'Enter the task',
                ]
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Task',
                'attr' => [
                    'placeholder' => 'Enter the task',
                ]
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn btn-success float-left mr-5',
                ]
            ))
            ->add('delete', SubmitType::class, array(
                'label' => 'Delete',
                'attr' => [
                    'class' => 'btn btn-danger',
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
