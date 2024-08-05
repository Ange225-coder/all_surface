<?php

    namespace App\Entity\Public;

    use Doctrine\ORM\Mapping as ORM;
    use DateTime;

    #[ORM\Entity]
    #[ORM\Table(name: 'subscription_in_process')]
    class SubscriptionInProcess
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'integer')]
        private int $service_identifier;

        #[ORM\Column(type: 'string')]
        private string $full_name;

        #[ORM\Column(type: 'string', length: 55)]
        private string $email;

        #[ORM\Column(type: 'string', length: 55)]
        private string $phone;

        #[ORM\Column(type: 'string', length: 55)]
        private string $city;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $municipality;

        #[ORM\Column(type: 'string', length: 55)]
        private string $service_type;

        #[ORM\Column(type: 'text', nullable: true)]
        private ?string $need;

        #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
        private DateTime $date;


        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setServiceIdentifier(int $service_identifier): void
        {
            $this->service_identifier = $service_identifier;
        }

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

        public function setServiceType(string $service_type): void
        {
            $this->service_type = $service_type;
        }

        public function setCity(string $city): void
        {
            $this->city = $city;
        }

        public function setMunicipality(?string $municipality): void
        {
            $this->municipality = $municipality;
        }

        public function setNeed(?string $need): void
        {
            $this->need = $need;
        }

        public function setDate(DateTime $date): void
        {
            $this->date = $date;
        }



        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getServiceIdentifier(): int
        {
            return $this->service_identifier;
        }

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

        public function getNeed(): ?string
        {
            return $this->need;
        }

        public function getServiceType(): string
        {
            return $this->service_type;
        }

        public function getDate(): DateTime
        {
            return $this->date;
        }
    }