# Intervention HttpAuth

Library to manage HTTP authentication with PHP.

[![Latest Version](https://img.shields.io/packagist/v/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth)
![build](https://github.com/Intervention/httpauth/workflows/build/badge.svg)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth/stats)

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/httpauth

## Usage

The workflow is easy. Just create an authentication instance in the first step and secure your resource with a second step.

### Create authentication instance

To create HTTP authentication instances you can choose between different methods.

#### Create instance by using static factory method

```php
use Intervention\HttpAuth\Authenticator;

$auth = Authenticator::basic('Secured Realm');
$auth->withUsername('admin');
$auth->withPassword('secret');
```

#### Create instance by using static universal factory method

```php
use Intervention\HttpAuth\Authenticator;

// create basic auth by array
$auth = Authenticator::make([
    'type' => 'basic',
    'realm' => 'Secure Resource',
    'username' => 'admin',
    'password' => 'secret',
]);
```

#### Create instance by using class constructor

```php
use Intervention\HttpAuth\Authenticator;

$auth = new Authenticator(
   'basic',
   'Secure Resource',
   'admin',
   'secret'
);

// alternatively use methods to set properties
$auth = new Authenticator();
$auth->withType('digest');
$auth->withRealm('Secure');
$auth->withCredentials('admin', 'secret');
```

### Ask user for credentials

After you created a HTTP authentication instance, you have to call `secure()` to secure the resource. This results in a 401 HTTP response and the browser asking for credentials.

```php
$auth->secure();
```

## Server Configuration

### Apache

If you are using Apache and running php with fast-cgi, check setting headers:
https://support.deskpro.com/en/kb/articles/missing-authorization-headers-with-apache

## License

Intervention HttpAuth Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
