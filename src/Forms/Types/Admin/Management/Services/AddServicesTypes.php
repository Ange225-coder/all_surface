<?php

    namespace App\Forms\Types\Admin\Management\Services;

    use Symfony\Component\Form\AbstractType;
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
                    'attr' => ['placeholder' => 'Nom du service']
                ])

                ->add('servicePic', FileType::class)
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => AddServicesFields::class,
            ]);
        }
    }