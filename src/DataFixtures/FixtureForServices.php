<?php

    namespace App\DataFixtures;

    use App\Entity\Admin\Services;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Persistence\ObjectManager;

    class FixtureForServices extends Fixture implements FixtureGroupInterface
    {
        public function load(ObjectManager $manager): void
        {
            $pics = [
                '5e3ee481a3bd997bbf52ad4aa96a3982.jpg',
                '042e0dadbde72b99189d9729301f55a5.jpg',
                '58ca06cddda6b890b445d7ff64f1a48c.jpg',
                '85f3f8c55fac955a3f13e390d0f5df05.jpg',
                '92feb2558275b4f02ba6265ba3414bb5.jpg',
                '651c17bff3ca1d6f1c9245939ff51cef.jpg',
                'c7217ceabf7aa85864f499bab680f7f7.jpg',
                'ce4f499e51f14e432055ea444c454568.jpg',
                'dd66ea6e639ca64d0fec76d9790ad520.jpg'
            ];

            for ($s=1; $s<=15; $s++) {
                $service = new Services();
                $service->setServiceName('Service 00-'.$s);
                $service->setDescriptionTitle('Titre de la description du service 00-'.$s);
                $service->setDescription('Description du service 00-'.$s);

                $randomPic = $pics[array_rand($pics)];
                $picPath = 'pics/ServicesPics/'.$randomPic;
                $service->setServicePic($picPath);

                $manager->persist($service);
            }

            $manager->flush();
        }



        public static function getGroups(): array
        {
            return ['servicesFixture'];
        }


    }