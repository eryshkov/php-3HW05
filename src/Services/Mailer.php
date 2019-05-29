<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    public static $userName = 'dwebbo@bk.ru';
    public static $password = 'pekZes-pykgon-cuqsy3';
    public static $destination = 'eryshkov@gmail.com';
    public static $smtpHost = 'smtp.mail.ru';
    
    public function mail(string $subjText, string $messageText): int
    {
        $transport = new Swift_SmtpTransport(self::$smtpHost, 465);
        $transport->setEncryption('SSL');
        $transport->setUsername(self::$userName);
        $transport->setPassword(self::$password);
        
        $mailer = new Swift_Mailer($transport);
        
        $message = new Swift_Message($subjText);
        $message->setFrom([self::$userName => 'robot']);
        $message->setTo([self::$destination => 'admin']);
        $message->setBody($messageText);
        
        return $mailer->send($message);
    }
    
    /**
     * @param string $email
     * @return bool|null
     */
    protected function validateEmail(string $email): ?bool
    {
        $regExp = '~^[^.]"?[A-Z0-9._%+-]+"?[^.]@\[?[A-Z0-9.-]+\.[A-Z0-9]{2,}\]?$~iD';
    
        $result = preg_match($regExp, $email);
    
        if (1 === $result) {
            return true;
        }
        
        if (0 === $result) {
            return false;
        }
        
        return null;
    }
}
