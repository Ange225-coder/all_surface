<?php

    namespace App\Entity\Admin;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'services_done')]
    class ServicesDone
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
        private string $phone;

        #[ORM\Column(type: 'string', length: 55, nullable: true)]
        private ?string $municipality;

        #[ORM\Column(type: 'string', length: 55)]
        private string $service_type;

        #[ORM\Column(type: 'text', nullable: true)]
        private ?string $need;

        #[ORM\Column(type: 'datetime', nullable: true)]
        private \DateTime $published_date;



        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setServiceIdentifier(int $service_identifier): void
        {
            $this->service_identifier = $service_identifier;
        }

        public function setServiceType(string $service_type): void
        {
            $this->service_type = $service_type;
        }

        public function setFullName(string $full_name): void
        {
            $this->full_name = $full_name;
        }

        public function setNeed(?string $need): void
        {
            $this->need = $need;
        }

        public function setMunicipality(?string $municipality): void
        {
            $this->municipality = $municipality;
        }

        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }

        public function setPublishedDate(\DateTime $published_date): void
        {
            $this->published_date = $published_date;
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

        public function getServiceType(): string
        {
            return $this->service_type;
        }

        public function getFullName(): string
        {
            return $this->full_name;
        }

        public function getNeed(): ?string
        {
            return $this->need;
        }

        public function getMunicipality(): ?string
        {
            return $this->municipality;
        }

        public function getPhone(): string
        {
            return $this->phone;
        }

        public function getPublishedDate(): \DateTime
        {
            return $this->published_date;
        }
    }