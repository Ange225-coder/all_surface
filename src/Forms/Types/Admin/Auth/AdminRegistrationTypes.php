<?php

    namespace App\Forms\Types\Admin\Auth;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use App\Forms\Fields\Admin\Auth\AdminRegistrationFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class AdminRegistrationTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('admin_name', TextType::class, [
                    'attr' => ['placeholder' => 'Entrez un nom']
                ])

                ->add('password', PasswordType::class, [
                    'attr' => ['placeholder' => 'Veuillez entrez un mot de passe']
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => AdminRegistrationFields::class,
            ]);
        }
    }