<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Admin\ServicesDone;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class ServicesDoneController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/backstage/services-done', name: 'backstage_services_done')]
        #[IsGranted('ROLE_ADMIN')]
        public function servicesDoneController():  Response
        {
            $servicesDoneList = $this->entityManager->getRepository(ServicesDone::class)->findBy(
                [],
            );

            return $this->render('admin/management/services/servicesDone.html.twig', [
                'servicesDone' => $servicesDoneList,
            ]);
        }
    }