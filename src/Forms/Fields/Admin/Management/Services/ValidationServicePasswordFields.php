<?php

    namespace App\Forms\Fields\Admin\Management\Services;

    use Symfony\Component\Validator\Constraints as Assert;

    class ValidationServicePasswordFields
    {
        #[Assert\NotBlank(message: 'Entrez Votre mot de passe')]
        private string $password;


        public function setPassword(string $password): void
        {
            $this->password = $password;
        }

        public function getPassword(): string
        {
            return $this->password;
        }
    }