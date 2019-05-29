<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected function makeUser(
        string $email,
        string $firstName = null,
        string $middleName = null,
        string $lastName = null
    ): User
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setMiddleName($middleName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        
        return $user;
    }
    
    public function testEmptyUser(): void
    {
        $email = 'test@mac.mac';
        $user = $this->makeUser($email);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame($user->getEmail(), $user->getFullName());
        $this->assertSame($email, $user->getFullName());
    }
    
    public function testFullUser(): void
    {
        $email = 'test@mac.mac';
        $firstName = 'Ivan';
        $middleName = 'Petrovich';
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame(implode(' ', [
            $firstName,
            $middleName,
            $lastName,
        ]), $user->getFullName());
        
    }
    
    public function testUserWithoutMiddleName(): void
    {
        $email = 'test@mac.mac';
        $firstName = 'Ivan';
        $middleName = '';
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame(implode(' ', [
            $firstName,
            $lastName,
        ]), $user->getFullName());
        
        $email = 'test@mac.mac';
        $firstName = 'Ivan';
        $middleName = null;
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame(implode(' ', [
            $firstName,
            $lastName,
        ]), $user->getFullName());
    }
    
    public function testUserWithoutFirstName(): void
    {
        $email = 'test@mac.mac';
        $firstName = '';
        $middleName = 'Petrovich';
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame($email, $user->getFullName());
        
        $email = 'test@mac.mac';
        $firstName = null;
        $middleName = 'Petrovich';
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame($email, $user->getFullName());
    }
    
    public function testUserWithoutLastName(): void
    {
        $email = 'test@mac.mac';
        $firstName = '';
        $middleName = 'Petrovich';
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame($email, $user->getFullName());
        
        $email = 'test@mac.mac';
        $firstName = null;
        $middleName = 'Petrovich';
        $lastName = 'Sidorov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);
        
        $this->assertIsString($user->getFullName());
        $this->assertSame($email, $user->getFullName());
    }
}
