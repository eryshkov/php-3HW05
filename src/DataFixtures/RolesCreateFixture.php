<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RolesCreateFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roles = [
            'ROLE_ADMIN',
            'ROLE_USER',
            
        ];
    
        foreach ($roles as $role) {
            $roleObj = new Role();
            $roleObj->setName($role);
            $manager->persist($roleObj);
        }
    
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
            UserAddFixture::class,
        ];
    }
}
