<?php

namespace App\Form;

use App\Entity\Continent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContinentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pays',TextType::class)
            ->add('zone',ChoiceType::class,[
                'choices' => [
                'Amérique du Nord'=>'Amérique du Nord',
                    'Amérique du Sud'=>'Amérique du Sud',
                    'Afrique'=>'Afrique',
                    'Océanie'=>'Océanie',
                    'Asie'=>'Asie',
                    'Europe'=>'Europe',
                    'Moyen-Orient'=>'Moyen-Orient',
                    'Monde'=>'Monde'
            ],
                ])
             ->add('enregistrer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Continent::class,
        ]);
    }
}
