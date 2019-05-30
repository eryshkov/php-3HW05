<?php

namespace App\Tests;

use App\Services\Mailer;
use PHPUnit\Framework\TestCase;
use Swift_SmtpTransport;

class MailerTests extends TestCase
{
    /** @link https://blogs.msdn.microsoft.com/testing123/2009/02/06/email-address-test-cases/ */
    protected $emailListValid = <<<'VALID'
email@example.com
firstname.lastname@example.com
email@subdomain.example.com
firstname+lastname@example.com
email@123.123.123.123
email@[123.123.123.123]
"email"@example.com
1234567890@example.com
email@example-one.com
_______@example.com
email@example.name
email@example.museum
email@example.co.jp
firstname-lastname@example.com
VALID;
    
    protected $emailListInvalid = <<<'INVALID'
plainaddress
#@%^%#$@#$@#.com
@example.com
Joe Smith <email@example.com>
email.example.com
email@example@example.com
.email@example.com
email.@example.com
email..email@example.com
あいうえお@example.com
email@example.com (Joe Smith)
email@example
email@-example.com
email@example.web
email@111.222.333.44444
email@example..com
Abc..123@example.com
INVALID;
    
    
    public function testValidateEmail()
    {
        $transport = new Swift_SmtpTransport();
        $mailer = new Mailer($transport);
        
        $reflector = new \ReflectionMethod(Mailer::class, 'validateEmail');
        $reflector->setAccessible(true);
        
        $validEmails = explode(PHP_EOL, $this->emailListValid);
        foreach ($validEmails as $validEmail) {
            $isValid = $reflector->invoke($mailer, $validEmail);
            $this->assertTrue($isValid, $validEmail . ' is not valid');
        }
        
        $invalidEmails = explode(PHP_EOL, $this->emailListInvalid);
        foreach ($invalidEmails as $invalidEmail) {
            $isValid = $reflector->invoke($mailer, $invalidEmail);
            $this->assertFalse($isValid, $invalidEmail . ' is valid');
        }
    }
}

;
