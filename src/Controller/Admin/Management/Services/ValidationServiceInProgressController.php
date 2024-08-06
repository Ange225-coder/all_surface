<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Admin\Admin;
    use App\Entity\Admin\ServicesDone;
    use App\Entity\Public\SubscriptionInProcess;
    use App\Forms\Fields\Admin\Management\Services\ValidationServicePasswordFields;
    use App\Forms\Types\Admin\Management\Services\ValidationServicePasswordTypes;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

    class ValidationServiceInProgressController extends AbstractController
    {
        private EntityManagerInterface $entityManager;
        private RequestStack $requestStack;
        private UserPasswordHasherInterface $passwordHasher;


        public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, UserPasswordHasherInterface $passwordHasher)
        {
            $this->entityManager = $entityManager;
            $this->requestStack = $requestStack;
            $this->passwordHasher = $passwordHasher;
        }


        #[Route(path: '/backstage/service-in-progress/validation/{id}', name: 'backstage_service_identifier')]
        #[isGranted('ROLE_ADMIN')]
        public function validationOfServiceInProgress(int $id): Response
        {
            $serviceInProgress = $this->entityManager->getRepository(SubscriptionInProcess::class)->find($id);

            /** removing services done in services in progress and put services done in db of services done */
            $passwordFields = new ValidationServicePasswordFields();
            $serviceDoneEntity = new ServicesDone();

            $passwordTypes = $this->createForm(ValidationServicePasswordTypes::class, $passwordFields);

            $passwordTypes->handleRequest($this->requestStack->getCurrentRequest());

            $admin = $this->entityManager->getRepository(Admin::class)->findOneBy([
                'admin_name' => $this->getUser()->getUserIdentifier(),
            ]);

            if($passwordTypes->isSubmitted() && $passwordTypes->isValid()) {

                if($this->passwordHasher->isPasswordValid($admin, $passwordFields->getPassword())) {
                    $serviceDoneEntity->setServiceIdentifier($serviceInProgress->getServiceIdentifier());
                    $serviceDoneEntity->setFullName($serviceInProgress->getFullName());
                    $serviceDoneEntity->setPhone($serviceInProgress->getPhone());
                    $serviceDoneEntity->setMunicipality($serviceInProgress->getMunicipality());
                    $serviceDoneEntity->setServiceType($serviceInProgress->getServiceType());
                    $serviceDoneEntity->setNeed($serviceInProgress->getNeed());
                    $serviceDoneEntity->setPublishedDate($serviceInProgress->getDate());

                    $this->entityManager->persist($serviceDoneEntity);
                    $this->entityManager->remove($serviceInProgress);

                    $this->entityManager->flush();

                    $this->addFlash('remove_successfully', 'Félicitation vous venez de valider une prestation');

                    return $this->redirectToRoute('backstage_dashboard');
                }
                else {
                    $passwordTypes->get('password')->addError(new FormError('Mot de passe invalide'));
                }
            }

            return $this->render('admin/management/services/validationOfServiceInProgress.html.twig', [
                'serviceInProgress' => $serviceInProgress,
                'passwordForm' => $passwordTypes->createView(),
            ]);
        }
    }