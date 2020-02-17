<?php

namespace Intervention\Httpauth\Basic;

use Intervention\Httpauth\AbstractCredentials;

class Credentials extends AbstractCredentials
{
    /**
     * Determine if current credentials match given credentials
     *
     * @param  AbstractCredentials $credentials
     * @return bool
     */
    public function matches(AbstractCredentials $credentials): bool
    {
        $username_matches = $this->get('username') == $credentials->get('username');
        $password_matches = $this->get('password') == $credentials->get('password');
        
        return $username_matches && $password_matches;
    }
}
