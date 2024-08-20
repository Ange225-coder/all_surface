<?php

    namespace App\Forms\Fields\Admin\Auth;

    use Symfony\Component\Validator\Constraints as Assert;

    class AdminRegistrationFields
    {
        #[Assert\NotBlank(message: 'Veuillez entrez un nom')]
        #[Assert\Regex(
            pattern: '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@_-.$])[a-zA-Z0-9@_-.$]{6,20}$#',
            message: 'Vous n\'avez pas accès à cette espace'
        )]
        //for validate regex put : upper, lower, number and special characters
        private string $admin_name;


        #[Assert\Regex(
            pattern: '#^(AS_)+[a-zA-Z0-9/_@$. ]{6,16}$#',
            message: 'Accès interdit !'
        )]
        private string $password;


        //setters
        public function setAdminName(string $admin_name): void
        {
            $this->admin_name = $admin_name;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }


        //getters
        public function getAdminName(): string
        {
            return $this->admin_name;
        }

        public function getPassword(): string
        {
            return $this->password;
        }
    }