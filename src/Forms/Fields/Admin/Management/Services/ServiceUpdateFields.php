<?php

    namespace App\Forms\Fields\Admin\Management\Services;

    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Symfony\Component\Validator\Constraints as Assert;

    class ServiceUpdateFields
    {
        #[Assert\NotBlank(message: 'Veuillez entrer un nom de service pour continuer')]
        #[Assert\Length(
            min: 5,
            max: 55,
            minMessage: 'Le nom du service est trop court',
            maxMessage: 'Le nom du service est trop long'
        )]
        private string $serviceName;

        #[Assert\NotBlank(message: 'Veuillez entrer un titre de description')]
        private string $descriptionTitle;

        #[Assert\NotBlank(message: 'Veuillez entrer une description')]
        private string $description;

        #[Assert\NotBlank(message: 'Ajouter une nouvelle image au service')]
        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ['image/jpeg', 'image/jpg', 'image/png', 'image/jfif'],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format .jpeg, .jpg, .png ou .jfif'
        )]
        private UploadedFile $service_pic;


        //setters
        public function setServiceName(string $serviceName): void
        {
            $this->serviceName = $serviceName;
        }

        public function setServicePic(UploadedFile $service_pic): void
        {
            $this->service_pic = $service_pic;
        }

        public function setDescriptionTitle(string $descriptionTitle): void
        {
            $this->descriptionTitle = $descriptionTitle;
        }

        public function setDescription(string $description): void
        {
            $this->description = $description;
        }



        //getters

        public function getDescriptionTitle(): string
        {
            return $this->descriptionTitle;
        }

        public function getDescription(): string
        {
            return $this->description;
        }

        public function getServicePic(): UploadedFile
        {
            return $this->service_pic;
        }

        public function getServiceName(): string
        {
            return $this->serviceName;
        }
    }