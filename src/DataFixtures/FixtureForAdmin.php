<?php

    namespace App\DataFixtures;

    use App\Entity\Admin\Admin;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

    class FixtureForAdmin extends Fixture implements FixtureGroupInterface
    {
        public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
        {}



        public function load(ObjectManager $manager): void
        {
            for ($a=1; $a<=15; $a++) {
                $admin = new Admin();
                $admin->setAdminName('Admin2.0-'.$a);
                $admin->setPassword($this->passwordHasher->hashPassword($admin, 'AS_admin2.0'));
                $admin->setRoles(['ROLE_ADMIN']);

                $manager->persist($admin);
            }

            $manager->flush();
        }



        public static function getGroups(): array
        {
            return ['adminFixture'];
        }
    }
