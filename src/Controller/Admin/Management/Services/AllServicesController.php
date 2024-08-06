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


        /** Supprimer un service en fonction de son id */
        #[Route(path: '/backstage/service/deletion/{id}', name: 'backstage_service_deletion', methods: 'POST')]
        public function serviceDeletion(int $id): Response
        {
            $service = $this->entityManager->getRepository(Services::class)->find($id);

            if($service) {
                $this->entityManager->remove($service);
                $this->entityManager->flush();

                $this->addFlash('service_deletion_success', 'Un service vient d\'être retiré de la base de données');
            }

            return $this->redirectToRoute('backstage_services_list');
        }
    }