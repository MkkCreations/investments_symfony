<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public const USER_REFERENCE = 'user';

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@localhost');
        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);
        $user->setRoles([Role::ROLE_ADMIN, Role::ROLE_USER]);
        $user->setIsActive(true);
        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $user->addPortfolio($this->getReference(PortfolioFixture::PORTFOLIO_REFERENCE));
        $user->setBalance($this->getReference(BalanceFixture::BALANCE_REFERENCE));
        
        $manager->persist($user);
        $this->addReference(self::USER_REFERENCE, $user);
        $this->getReference(BalanceFixture::BALANCE_REFERENCE)->setUser($user);
        
        $manager->flush();
    }
}
