<?php

    namespace App\Entity\Admin;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

    #[ORM\Entity]
    #[ORM\Table(name: 'admins')]
    class Admin implements UserInterface, PasswordAuthenticatedUserInterface
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55, unique: true)]
        private string $admin_name;

        #[ORM\Column(type: 'string')]
        private string $password;

        #[ORM\Column()]
        private array $roles = [];

        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setAdminName(string $admin_name): void
        {
            $this->admin_name = $admin_name;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }

        public function setRoles(array $roles): void
        {
            $this->roles = $roles;
        }


        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getAdminName(): string
        {
            return $this->admin_name;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function getRoles(): array
        {
            $roles = $this->roles;

            if(!in_array('ROLE_ADMIN', $roles)) {
                $roles[] = 'ROLE_ADMIN';
            }

            return $roles;
        }

        public function getUserIdentifier(): string
        {
            return $this->admin_name;
        }

        public function eraseCredentials(): void
        {
        }
    }