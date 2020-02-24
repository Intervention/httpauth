# Intervention HttpAuth

Library to manage HTTP authentication with PHP. Includes ServiceProviders for easy Laravel integration.

[![Latest Version](https://img.shields.io/packagist/v/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth)
[![Build Status](https://travis-ci.org/Intervention/httpauth.png?branch=master)](https://travis-ci.org/Intervention/httpauth)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth/stats)

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/httpauth

### Laravel integration (optional)

The HttpAuth library is built to work with the Laravel Framework (>=5.5). It comes with a service provider and facades, which will be discovered automatically after installation.

## Usage

To create HTTP authentication instances you can choose between different methods.

### Static instantiation by array

```php
use Intervention\HttpAuth\HttpAuth;

// create basic auth by array
$auth = HttpAuth::make([
    'type' => 'basic',
    'realm' => 'Secure Resource',
    'username' => 'admin',
    'password' => 'secret',
]);
```

### Instantiation by calls

```php
use Intervention\HttpAuth\HttpAuth;

// create digest auth
$auth = HttpAuth::make();
$auth->digest();
$auth->realm('Secure');
$auth->username('admin');
$auth->password('secret');
```

### Ask user for credentials

After you created a HTTP authentication instance, you have to call `secure()` to ask for credentials.

```php
$auth->secure();
```

## Server Configuration

### Apache

If you are using Apache and running php with fast-cgi, check setting headers:
https://support.deskpro.com/en/kb/articles/missing-authorization-headers-with-apache

## License

Intervention HttpAuth Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
