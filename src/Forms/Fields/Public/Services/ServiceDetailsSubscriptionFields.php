<?php

    namespace App\Forms\Fields\Public\Services;

    use Symfony\Component\Validator\Constraints as Assert;

    class ServiceDetailsSubscriptionFields
    {
        #[Assert\NotBlank(message: 'Veuillez entrer votre nom complet')]
        #[Assert\Length(
            min: 6,
            max: 35,
            minMessage: 'Ce nom est trop court',
            maxMessage: 'Ce nom est trop long'
        )]
        private string $full_name;

        #[Assert\NotBlank(message: 'Veuillez entrer votre e-mail')]
        #[Assert\Regex(
            pattern: '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',
            message: 'Votre email doit être sous la forme: xyz@exemple.com'
        )]
        private string $email;

        #[Assert\Regex(
            pattern: '#^(?:0[157](?:[ -]?[0-9]{2}){4})$#',
            message: 'Entrez un numéro de téléphone ivoirien; Ex : 01 02 03 04 05'
        )]
        #[Assert\NotBlank(message: 'Veuillez entrer votre numéro de téléphone')]
        private string $phone;

        #[Assert\NotBlank(message: 'Entrez la ville de votre localité')]
        private string $city;

        private ?string $municipality = null;

        /**
         * #[Assert\Regex(
            pattern: '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_@$.])[A-Za-z\d_@$.]{6,16}$#',
            message: 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial parmi _@$.'
        )]
        #[Assert\Length(
            min: 6,
            max: 16,
            minMessage: 'Mot de passe trop court; min 6 caractères.',
            maxMessage: 'Mot de passe trop long; max 16 caractères.'
        )]
        #[Assert\NotBlank(message: 'Veuillez entrer un mot de passe pour valider la souscription')]
        private string $password;
         */

        private ?string $need = null;


        //setters
        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setFullName(string $full_name): void
        {
            $this->full_name = $full_name;
        }
        public function setCity(string $city): void
        {
            $this->city = $city;
        }

        public function setMunicipality(?string $municipality): void
        {
            $this->municipality = $municipality;
        }

        /**
         *
         * public function setPassword(string $password): void
         * {
         * $this->password = $password;
         * }
         */


        public function setNeed(?string $need): void
        {
            $this->need = $need;
        }


        //getters
        public function getFullName(): string
        {
            return $this->full_name;
        }

        public function getPhone(): string
        {
            return $this->phone;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getCity(): string
        {
            return $this->city;
        }

        public function getMunicipality(): ?string
        {
            return $this->municipality;
        }

        /**
         * @return string
         *
         * public function getPassword(): string
         * {
         * return $this->password;
         * }
         */

        public function getNeed(): ?string
        {
            return $this->need;
        }
    }