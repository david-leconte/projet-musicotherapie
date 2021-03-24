<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CauseType;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('participants', IntegerType::class)
                ->add('causeType', EntityType::class, [
                    'class' => CauseType::class,
                    'choice_label' => 'nameType',
                    'multiple' => false,
                    'expanded' => false
                ])
                ->add('completeCause', TextareaType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
