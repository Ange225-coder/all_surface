<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Public\SubscriptionInProcess;
    use App\Forms\Fields\Admin\Management\Services\ValidationServicePasswordFields;
    use App\Forms\Types\Admin\Management\Services\ValidationServicePasswordTypes;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Symfony\Component\HttpFoundation\RequestStack;

    class ValidationServiceInProgressController extends AbstractController
    {
        private EntityManagerInterface $entityManager;
        private RequestStack $requestStack;


        public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
        {
            $this->entityManager = $entityManager;
            $this->requestStack = $requestStack;
        }


        #[Route(path: '/backstage/service-in-progress/validation/{id}', name: 'backstage_service_identifier')]
        #[isGranted('ROLE_ADMIN')]
        public function validationOfServiceInProgress(int $id): Response
        {
            $serviceInProgress = $this->entityManager->getRepository(SubscriptionInProcess::class)->find($id);

            /** removing services done in services in progress and put services done in db of services done */
            $passwordFields = new ValidationServicePasswordFields();

            $passwordTypes = $this->createForm(ValidationServicePasswordTypes::class, $passwordFields);

            return $this->render('admin/management/services/validationOfServiceInProgress.html.twig', [
                'serviceInProgress' => $serviceInProgress,
                'passwordForm' => $passwordTypes->createView(),
            ]);
        }
    }