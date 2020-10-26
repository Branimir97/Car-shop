<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('branimirb51@gmail.com');
        $user->setFirstName('Branimir');
        $user->setLastName('Butković');
        $user->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));

        $manager->persist($user);
        $manager->flush();

        $manager->flush();
    }
}
