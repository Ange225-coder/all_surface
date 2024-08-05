<?php

    namespace App\Controller\Public\Services;

    use App\Entity\Admin\Services;
    use App\Entity\Public\SubscriptionInProcess;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Forms\Fields\Public\Services\ServiceDetailsSubscriptionFields;
    use App\Forms\Types\Public\Services\ServiceDetailsSubscriptionTypes;
    use Symfony\Component\HttpFoundation\RequestStack;

    class ServiceDetailsController extends AbstractController
    {
        private EntityManagerInterface $entityManager;
        private RequestStack $requestStack;


        public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
        {
            $this->entityManager = $entityManager;
            $this->requestStack = $requestStack;
        }


        #[Route(path: '/services/{serviceName}', name: 'service')]
        public function serviceDetails(string $serviceName): Response
        {
            $service = $this->entityManager->getRepository(Services::class)->findOneBy([
                'service_name' => $serviceName,
            ]);

            /** subscription form manager */
            $subscriptionFields = new ServiceDetailsSubscriptionFields();
            $subscriptionServiceEntity = new SubscriptionInProcess();

            $subscriptionTypes = $this->createForm(ServiceDetailsSubscriptionTypes::class, $subscriptionFields);

            $request = $this->requestStack->getCurrentRequest();
            $subscriptionTypes->handleRequest($request);

            if($subscriptionTypes->isSubmitted() && $subscriptionTypes->isValid()) {

                $subscriptionServiceEntity->setFullName($subscriptionFields->getFullName());

                do {
                    $serviceId = substr(str_shuffle('1234567890'), 0, 9);
                }
                while($this->entityManager->getRepository(SubscriptionInProcess::class)->findOneBy([
                    'service_identifier' => $serviceId,
                ]));

                $subscriptionServiceEntity->setServiceIdentifier($serviceId);
                $subscriptionServiceEntity->setEmail($subscriptionFields->getEmail());
                $subscriptionServiceEntity->setPhone($subscriptionFields->getPhone());
                $subscriptionServiceEntity->setCity($subscriptionFields->getCity());
                $subscriptionServiceEntity->setMunicipality($subscriptionFields->getMunicipality());
                $subscriptionServiceEntity->setServiceType($serviceName);
                $subscriptionServiceEntity->setNeed($subscriptionFields->getNeed());
                $subscriptionServiceEntity->setDate(new \DateTime());

                $this->entityManager->persist($subscriptionServiceEntity);
                $this->entityManager->flush();

                $this->addFlash('subscription_done', 'Votre demande de service à été prise en compte. Vous serez contacté dans les plus bref délais');

                return $this->redirectToRoute('home');
            }

            return $this->render('public/services/servicesDetails.html.twig', [
                'service' => $service,
                'subscriptionForm' => $subscriptionTypes->createView(),
            ]);
        }
    }