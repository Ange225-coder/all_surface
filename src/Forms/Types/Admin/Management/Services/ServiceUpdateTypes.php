<?php

    namespace App\Forms\Types\Admin\Management\Services;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Forms\Fields\Admin\Management\Services\ServiceUpdateFields;

    class ServiceUpdateTypes extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('serviceName', TextType::class)

                ->add('descriptionTitle', TextType::class)

                ->add('description', TextareaType::class, [
                    'attr' => [
                        'cols' => 40,
                        'rows' => 6
                    ]
                ])

                ->add('service_pic', FileType::class)
            ;
        }



        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ServiceUpdateFields::class,
            ]);
        }
    }