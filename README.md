# Intervention Httpauth

Library to manage HTTP authentication with PHP. Includes ServiceProviders for easy Laravel integration.

[![Latest Version](https://img.shields.io/packagist/v/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth)
[![Build Status](https://travis-ci.org/Intervention/httpauth.png?branch=master)](https://travis-ci.org/Intervention/httpauth)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth/stats)

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/httpauth

### Laravel integration (optional)

The Validation library is built to work with the Laravel Framework (>=5.5). It comes with a service provider and facades, which will be discovered automatically.

## Usage

```php
use Intervention\Httpauth\Httpauth;

// create basic auth
$auth = Httpauth::basic(function ($vault) {
    $vault->setName('Secure Resource');
    $vault->setUsername('admin');
    $vault->setPassword('secret');
});

// to ask the user for credentials, call secure method
$auth->secure();
```

## Server Configuration

### Apache

If you are using Apache and running php with fast-cgi, check setting headers:
https://support.deskpro.com/en/kb/articles/missing-authorization-headers-with-apache

## License

Intervention Httpauth Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
