<?php

    namespace App\Controller\Admin\Auth;

    use App\Entity\Admin\Admin;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Admin\Auth\AdminRegistrationFields;
    use App\Forms\Types\Admin\Auth\AdminRegistrationTypes;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
    use App\Security\BackstageAuthenticator;

    class AdminRegistrationController extends AbstractController
    {
        private RequestStack $requestStack;
        private EntityManagerInterface $entityManager;
        private UserPasswordHasherInterface $passwordHasher;
        private UserAuthenticatorInterface $authenticator;
        private BackstageAuthenticator $backstageAuthenticator;


        public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, UserAuthenticatorInterface $authenticator, BackstageAuthenticator $backstageAuthenticator)
        {
            $this->requestStack = $requestStack;
            $this->entityManager = $entityManager;
            $this->passwordHasher = $passwordHasher;
            $this->authenticator = $authenticator;
            $this->backstageAuthenticator = $backstageAuthenticator;
        }


        #[Route(path: '/backstage/registration', name: 'backstage_registration')]
        public function adminRegistration(): Response
        {
            $registrationFields = new AdminRegistrationFields();
            $adminEntity = new Admin();

            $registrationTypes = $this->createForm(AdminRegistrationTypes::class, $registrationFields);

            $request = $this->requestStack->getCurrentRequest();
            $registrationTypes->handleRequest($request);

            if($registrationTypes->isSubmitted() && $registrationTypes->isValid()) {

                $adminExists = $this->entityManager->getRepository(Admin::class)->findOneBy([
                    'admin_name' => $registrationFields->getAdminName(),
                ]);

                if($adminExists) {
                    $registrationTypes->get('admin_name')->addError(new FormError('Impossible d\'accéder à cet espace'));
                }

                if($registrationTypes->getErrors(true)->count() > 0) {
                    return $this->render('admin/auth/registration.html.twig', [
                        'registrationForm' => $registrationTypes->createView(),
                    ]);
                }

                $adminEntity->setAdminName($registrationFields->getAdminName());
                $adminEntity->setPassword($this->passwordHasher->hashPassword($adminEntity, $registrationFields->getPassword()));

                $this->entityManager->persist($adminEntity);
                $this->entityManager->flush();

                //authenticate admin here
                try {
                    $this->authenticator->authenticateUser($adminEntity, $this->backstageAuthenticator, $request);

                    return $this->redirectToRoute('backstage_dashboard');
                }

                catch (CustomUserMessageAuthenticationException $e) {
                    $this->addFlash('authentication failed', $e->getMessage());

                    return $this->redirectToRoute('backstage_registration');
                }

                catch (AuthenticationException) {
                    $this->addFlash('authentication_error', 'Une erreur est survenu');

                    return $this->redirectToRoute('backstage_registration');
                }
            }

            return $this->render('admin/auth/registration.html.twig', [
                'registrationForm' => $registrationTypes->createView(),
            ]);
        }
    }