<?php

namespace App\DataFixtures;

use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RolesAddFixture extends Fixture implements DependentFixtureInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    
    /**
     * RolesAddFixture constructor.
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = $this->userRepository->findOneBy([
            'email' => 'admin@test.mac',
        ]);
        
        $role = $this->roleRepository->findOneBy([
            'name' => 'ROLE_ADMIN',
        ]);
    
        if (!isset($user, $role)) {
            throw new \LogicException('User or role is not found');
        }
    
        $user->addRole($role);
        
        $manager->persist($user);
        $manager->flush();
    }
    
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            RolesCreateFixture::class,
            UserAddFixture::class,
        ];
    }
}
