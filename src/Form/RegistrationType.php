<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['constraints' => [
                new NotBlank(),
                new Length(['min' => 3, 'max' => 20, 'minMessage' => 'Cette valeur est trop courte. Il doit y avoir 3 caractères ou plus.']),
            ]])
            ->add('email', EmailType::class, ['constraints' => [
                new NotBlank(),
            ]])
            ->add('password', RepeatedType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8, 'minMessage' => 'Votre mot de passe doit contenir mininum 8 caractères'])
                ],
                'type' => PasswordType::class,
                'invalid_message' => "Vous n'avez pas confirmé le même mot de passe",
                'required' => $options['required']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => true,
            'data_class' => null,
        ]);
    }
}
