<?php

    namespace App\Entity\Admin;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'services')]
    class Services
    {
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        #[ORM\Column(type: 'integer')]
        private int $id;

        #[ORM\Column(type: 'string', length: 55)]
        private string $service_name;

        #[ORM\Column(type: 'string')]
        private string $service_pic;

        //setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setServiceName(string $service_name): void
        {
            $this->service_name = $service_name;
        }

        public function setServicePic(string $service_pic): void
        {
            $this->service_pic = $service_pic;
        }


        //getters
        public function getId(): int
        {
            return $this->id;
        }

        public function getServiceName(): string
        {
            return $this->service_name;
        }

        public function getServicePic(): string
        {
            return $this->service_pic;
        }
    }