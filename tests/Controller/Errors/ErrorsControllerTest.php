<?php

    namespace App\Tests\Controller\Errors;

    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class ErrorsControllerTest extends WebTestCase
    {
        public function testErrorPageIsOk()
        {
            $client = static::createClient();

            $urlGenerator = $client->getContainer()->get('router.default');

            $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('error_404'));

            $this->assertResponseStatusCodeSame(Response::HTTP_OK);
            $this->assertStringContainsString('erreur', $client->getResponse()->getContent());
            $this->assertSame(1, $crawler->filter('section')->count());
            $this->assertSame(1, $crawler->filter('h2')->count());
        }



        public function testLinkInErrorPage()
        {
            //$this->markTestSkipped();
            $client = static::createClient();
            $urlGenerator = $client->getContainer()->get('router.default');

            $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('error_404'));
            $link = $crawler->selectLink('Allez à la page d\'accueil')->link();

            $crawler = $client->click($link);

            $this->assertResponseIsSuccessful();

            //$this->assertSame(1, $crawler->filter('footer')->count());
        }


        public function tearDown(): void
        {
            parent::tearDown();
        }
    }
