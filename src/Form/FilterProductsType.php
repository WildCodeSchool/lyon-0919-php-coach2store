<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
            ->add('brands', ChoiceType::class, [
                'choices' => $options['brands'],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisir une marque',
                'choice_label' => function ($choice) {
                    return $choice;
                }
            ])
            ->add('suppliers', ChoiceType::class, [
                'choices' => $options['suppliers'],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisir un fournisseur',
                'choice_label' => function ($choice) {
                    return $choice;
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'brands' => [],
            'suppliers' => [],
        ]);
    }
}
