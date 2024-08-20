<?php

    namespace App\Controller\Admin\Management\Services;

    use App\Entity\Admin\Services;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use App\Forms\Fields\Admin\Management\Services\AddServicesFields;
    use App\Forms\Types\Admin\Management\Services\AddServicesTypes;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Doctrine\ORM\EntityManagerInterface;

    class AddServiceController extends AbstractController
    {
        private RequestStack $requestStack;
        private EntityManagerInterface $entityManager;


        public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
        {
            $this->requestStack = $requestStack;
            $this->entityManager = $entityManager;
        }

        #[Route(path: '/backstage/services/add', name: 'backstage_services_add')]
        #[IsGranted('ROLE_ADMIN')]
        public function addService(): Response
        {
            $serviceFields = new AddServicesFields();
            $servicesEntity = new Services();

            $servicesTypes = $this->createForm(AddServicesTypes::class, $serviceFields);

            $request = $this->requestStack->getCurrentRequest();
            $servicesTypes->handleRequest($request);

            if($servicesTypes->isSubmitted() && $servicesTypes->isValid()) {

                $existingServiceName = $this->entityManager->getRepository(Services::class)->findOneBy([
                    'service_name' => $serviceFields->getServiceName(),
                ]);

                if($existingServiceName) {
                    $servicesTypes->get('serviceName')->addError(new FormError('Un service du même type existe déjà'));
                }

                if($servicesTypes->getErrors(true)->count() > 0) {
                    return $this->render('admin/management/services/addService.html.twig', [
                        'servicesForm' => $servicesTypes->createView(),
                    ]);
                }

                $servicesEntity->setServiceName($serviceFields->getServiceName());
                $servicesEntity->setDescriptionTitle($serviceFields->getDescriptionTitle());
                $servicesEntity->setDescription($serviceFields->getDescription());

                //adding service pic
                $servicePic = $serviceFields->getServicePic();
                $servicePicName = md5(uniqid()) . '.' .$servicePic->guessExtension();
                $servicePic->move($this->getParameter('pics/servicesPics'), $servicePicName);

                $servicesEntity->setServicePic($this->getParameter('pics/servicesPics').'/'.$servicePicName);

                $this->entityManager->persist($servicesEntity);
                $this->entityManager->flush();

                $this->addFlash('service_added_successfully', 'Un service vient d\'être ajouté avec succès');

                return $this->redirectToRoute('backstage_dashboard');
            }

            return $this->render('admin/management/services/addService.html.twig', [
                'servicesForm' => $servicesTypes->createView(),
            ]);
        }
    }