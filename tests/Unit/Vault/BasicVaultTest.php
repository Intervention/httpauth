<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Vault;

use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Token\HttpAuthentification;
use Intervention\HttpAuth\Token\HttpAuthorization;
use Intervention\HttpAuth\Token\PhpAuthDigest;
use Intervention\HttpAuth\Token\PhpAuthUser;
use Intervention\HttpAuth\Token\RedirectHttpAuthorization;
use PHPUnit\Framework\TestCase;

final class BasicVaultTest extends TestCase
{
    public function testDirective(): void
    {
        $vault = new BasicVault('myUsername', 'myPassword', 'myRealm');
        $this->assertInstanceOf(Directive::class, $vault->directive());
    }

    public function testVerifyPhpAuthUserPositive(): void
    {
        $_SERVER['PHP_AUTH_USER'] = 'myUsername';
        $_SERVER['PHP_AUTH_PW'] = 'myPassword';

        $vault = new BasicVault('myUsername', 'myPassword');
        $token = new PhpAuthUser();

        $this->expectNotToPerformAssertions();
        $vault->verify($token);
    }

    public function testVerifyPhpAuthUserNegative(): void
    {
        $_SERVER['PHP_AUTH_USER'] = 'myUsername';
        $_SERVER['PHP_AUTH_PW'] = 'myPassword';

        $vault = new BasicVault('foo', 'bar');
        $token = new PhpAuthUser();

        $this->expectException(AuthentificationException::class);
        $vault->verify($token);
    }

    public function testVerifyHttpAuthentificationPositive(): void
    {
        $_SERVER['HTTP_AUTHENTICATION'] = implode(' ', [
            'basic',
            base64_encode('myUsername:myPassword')
        ]);

        $vault = new BasicVault('myUsername', 'myPassword');
        $token = new HttpAuthentification();

        $this->expectNotToPerformAssertions();
        $vault->verify($token);
    }

    public function testVerifyHttpAuthentificationNegative(): void
    {
        $_SERVER['HTTP_AUTHENTICATION'] = implode(' ', [
            'basic',
            base64_encode('myUsername:myPassword')
        ]);

        $vault = new BasicVault('foo', 'bar');
        $token = new HttpAuthentification();

        $this->expectException(AuthentificationException::class);
        $vault->verify($token);
    }

    public function testVerifyRedirectHttpAuthorizationPositive(): void
    {
        $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] = implode(' ', [
            'basic',
            base64_encode('myUsername:myPassword')
        ]);

        $vault = new BasicVault('myUsername', 'myPassword');
        $token = new RedirectHttpAuthorization();

        $this->expectNotToPerformAssertions();
        $vault->verify($token);
    }

    public function testVerifyRedirectHttpAuthorizationNegative(): void
    {
        $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] = implode(' ', [
            'basic',
            base64_encode('myUsername:myPassword')
        ]);

        $vault = new BasicVault('foo', 'bar');
        $token = new RedirectHttpAuthorization();

        $this->expectException(AuthentificationException::class);
        $vault->verify($token);
    }

    public function testVerifyPhpAuthDigestNegative(): void
    {
        $_SERVER['PHP_AUTH_DIGEST'] = 'foo';

        $vault = new BasicVault('myUsername', 'myPassword');
        $token = new PhpAuthDigest();

        $this->expectException(AuthentificationException::class);
        $vault->verify($token);
    }

    public function testVerifyHttpAuthorizationNegative(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = 'Digest username="test", realm="Secured Area", nonce="6634a746479d7", ' .
            'uri="/", response="33b14121b182f17da1b8c5d7ac99d10f", opaque="6e2e6cb06b9aadaae7a38209f54bb531", ' .
            'qop=auth, nc=00000004, cnonce="cfcfec29a4eb6299"';

        $vault = new BasicVault('test', 'secret'); // correct credentials
        $token = new HttpAuthorization();

        $this->expectException(AuthentificationException::class); // fails because vault is not digest
        $vault->verify($token);
    }
}
