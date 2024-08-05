<?php

    namespace App\Controller\Admin\Management\Dashboard;

    use App\Entity\Public\SubscriptionInProcess;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Doctrine\ORM\EntityManagerInterface;

    class AdminDashboardController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/backstage/dashboard', name: 'backstage_dashboard')]
        #[IsGranted('ROLE_ADMIN')]
        public function adminDashboard(): Response
        {
            $serviceInProgressCounter = $this->entityManager->getRepository(SubscriptionInProcess::class)->findAll();

            return $this->render('/admin/management/dashboard/dashboard.html.twig', [
                'service_in_progress_counter' => $serviceInProgressCounter,
            ]);
        }
    }