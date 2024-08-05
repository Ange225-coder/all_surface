<?php

    namespace App\Forms\Types\Public\Services;

    use App\Forms\Fields\Public\Services\ServiceDetailsSubscriptionFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ServiceDetailsSubscriptionTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('full_name', TextType::class, [
                    'attr' => ['placeholder' => 'Nom complet']
                ])

                ->add('email', EmailType::class, [
                    'attr' => ['placeholder' => 'E-mail']
                ])

                ->add('phone', TelType::class, [
                    'attr' => ['placeholder' => 'Contact téléphonique']
                ])

                ->add('city', TextType::class, [
                    'attr' => ['placeholder' => 'Ville']
                ])

                ->add('municipality', TextType::class, [
                    'attr' => ['placeholder' => 'Commune']
                ])

                //->add('password', PasswordType::class, [
                //    'attr' => ['placeholder' => 'Mot de passe'],
                //    'help' => 'Un compte utilisateur sera automatiquement créé'
                //])

                ->add('need', TextareaType::class, [
                    'attr' => [
                        'placeholder' => 'Décrivez brièvement votre besoin',
                        'cols' => 40,
                        'rows' => 5,
                    ]
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ServiceDetailsSubscriptionFields::class,
            ]);
        }
    }