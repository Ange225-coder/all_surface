<?php

    namespace App\Controller\Errors;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class ErrorsController extends AbstractController
    {
        #[Route(path: '/error', name: 'error_404')]
        public function error404(): Response
        {
            return $this->render('errors/error404.html.twig');
        }
    }