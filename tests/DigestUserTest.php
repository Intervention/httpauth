<?php

use Intervention\Httpauth\DigestUser;

class DigestUserTest extends PHPUnit_Framework_Testcase
{
    public function testDigestUserCreation()
    {
        $user = new DigestUser;
        $this->assertInstanceOf('\Intervention\Httpauth\DigestUser', $user);
    }
}