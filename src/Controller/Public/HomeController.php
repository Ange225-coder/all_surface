<?php

    namespace App\Controller\Public;

    use App\Entity\Admin\Services;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Doctrine\ORM\EntityManagerInterface;

    class HomeController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/', name: 'home')]
        public function home(): Response
        {
            $services = $this->entityManager->getRepository(Services::class)->findAll();

            return $this->render('public/home.html.twig', [
                'services' => $services
            ]);
        }
    }