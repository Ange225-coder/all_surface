<?php

    namespace App\Forms\Types\Admin\Management\Services;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Admin\Management\Services\AddServicesFields;

    class AddServicesTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('serviceName', TextType::class, [
                    'label' => 'Nom du service',
                    'attr' => ['placeholder' => 'Nom du service']
                ])

                ->add('descriptionTitle', TextType::class, [
                    'label' => 'Titre de la description',
                    'attr' => ['placeholder' => 'Titre de la description']
                ])

                ->add('description', TextareaType::class, [
                    'label' => 'Description',
                    'attr' => [
                        'placeholder' => 'Ajouter une description du service',
                        'cols' => 40,
                        'rows' => 6
                    ]
                ])

                ->add('servicePic', FileType::class, [
                    'label' => 'Associer une image au service',
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => AddServicesFields::class,
            ]);
        }
    }