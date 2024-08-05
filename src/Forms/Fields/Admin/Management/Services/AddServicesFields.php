<?php

    namespace App\Forms\Fields\Admin\Management\Services;

    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Symfony\Component\Validator\Constraints as Assert;

    class AddServicesFields
    {
        #[Assert\NotBlank(message: 'Veuillez entrer le nom du service')]
        #[Assert\Length(
            min: 5,
            max: 55,
            minMessage: 'Le nom du service est trop court',
            maxMessage: 'Le nom du service est trop long'
        )]
        private string $serviceName;

        #[Assert\NotBlank(message: 'Associer une image au service')]
        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ['image/jpeg', 'image/jpg', 'image/png', 'image/jfif'],
            maxSizeMessage: 'Les fichiers ne doivent pas dépasser 2Mo',
            mimeTypesMessage: 'Les fichiers doivent être au format .jpeg, .jpg, .png ou .jfif'
        )]
        private ?UploadedFile $servicePic;

        //setters
        public function setServiceName(string $serviceName): void
        {
            $this->serviceName = $serviceName;
        }

        public function setServicePic(?UploadedFile $servicePic): void
        {
            $this->servicePic = $servicePic;
        }


        //getters
        public function getServiceName(): string
        {
            return $this->serviceName;
        }

        public function getServicePic(): ?UploadedFile
        {
            return $this->servicePic;
        }
    }