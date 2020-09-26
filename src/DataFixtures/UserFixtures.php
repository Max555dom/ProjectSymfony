<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
	private UserPasswordEncoderInterface $passwordEncoder;

	public function __construct(UserPasswordEncoderInterface $passwordEncoder)
	{
		$this->passwordEncoder = $passwordEncoder;
	}

    public function load(ObjectManager $manager)
    {
		$user = new User();
		$user
			->setEmail('user@user.com')
			->setPassword( $this->passwordEncoder->encodePassword($user, 'user') )
		;

		// mise en mémoire de l'utilisateur pour récupération dans d'autres fixtures
		$this->addReference('user', $user);

		$manager->persist($user);
        $manager->flush();
    }
}
