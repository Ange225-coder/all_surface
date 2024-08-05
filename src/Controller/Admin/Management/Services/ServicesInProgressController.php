<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Public\SubscriptionInProcess;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Doctrine\ORM\EntityManagerInterface;

    class ServicesInProgressController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/backstage/services-in-progress', name: 'backstage_services_in_progress')]
        #[IsGranted('ROLE_ADMIN')]
        public function servicesInProgress(): Response
        {
            $servicesInProgress = $this->entityManager->getRepository(SubscriptionInProcess::class)->findBy(
                [],
                ['date' => 'DESC']
            );

            return $this->render('admin/management/services/servicesInProgress.html.twig', [
                'services_in_progress' => $servicesInProgress,
            ]);
        }
    }