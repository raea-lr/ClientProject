<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('labelleProject')
            ->add('budgetProject')
            ->add('description')
            ->add('deadlineProject')
            ->add('logoProject')
            ->add('responsibleProject')
            ->add('createdAt')
            ->add('updateAt')
            ->add('client')
            ->add('clients')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
