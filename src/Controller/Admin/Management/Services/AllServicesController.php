<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Admin\Services;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Doctrine\ORM\EntityManagerInterface;

    class AllServicesController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/backstage/services/list', name: 'backstage_services_list')]
        #[IsGranted('ROLE_ADMIN')]
        public function allServices(): Response
        {
            $allServices = $this->entityManager->getRepository(Services::class)->findAll();

            return $this->render('admin/management/services/allServices.html.twig', [
                'all_services' => $allServices,
            ]);
        }
    }