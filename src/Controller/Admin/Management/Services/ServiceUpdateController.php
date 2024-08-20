<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Admin\Services;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use App\Forms\Fields\Admin\Management\Services\ServiceUpdateFields;
    use App\Forms\Types\Admin\Management\Services\ServiceUpdateTypes;

    class ServiceUpdateController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/backstage/service/update/{id}', name: 'backstage_service_update')]
        #[IsGranted('ROLE_ADMIN')]
        public function serviceUpdate(int $id): Response
        {
            $service = $this->entityManager->getRepository(Services::class)->find($id);

            $serviceUpdateFields = new ServiceUpdateFields();

            $serviceUpdateTypes = $this->createForm(ServiceUpdateTypes::class, $serviceUpdateFields);

            return $this->render('admin/management/services/serviceUpdate.html.twig', [
                'service' => $service,
                'serviceUpdateForm' => $serviceUpdateTypes->createView(),
            ]);
        }
    }