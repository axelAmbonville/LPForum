<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Users;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Users();

        $user->setUserPseudo('test');
        $user->setUserPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));
        $user->setUserMail('test@example.fr');
        $user->setUserAvatar('image.png');
        $user->setUserRoles('["ROLE_ADMIN", "ROLE_USER"]');

        $manager->persist($user);

        $manager->flush();
    }
}
