<?php

namespace App\Services;

use Swift_Mailer;

class Mailer extends Swift_Mailer
{
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
