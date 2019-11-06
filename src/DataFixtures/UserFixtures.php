<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture {
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setEmail('franck.huby@loamok.org');

        // ne pas oublier de lancer la commande : "bin\console security:encode-password" et de mettre à jour le mot de passe de l'utilisateur
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'the_new_password'
        ));
        
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        // $product = new Product();
         $manager->persist($user);

        $manager->flush();
    }
}
