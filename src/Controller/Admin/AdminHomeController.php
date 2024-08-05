<?php

    namespace App\Controller\Admin;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AdminHomeController extends AbstractController
    {
        #[Route(path: '/backstage', name: 'backstage')]
        public function adminHome(): Response
        {
            if($this->getUser()) {
                return $this->redirectToRoute('backstage_dashboard');
            }

            return $this->render('admin/adminHome.html.twig');
        }
    }