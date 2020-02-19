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

The HttpAuth library is built to work with the Laravel Framework (>=5.5). It comes with a service provider and facades, which will be discovered automatically.

## Usage

To create HTTP authentication instances you can choose between different methods.

### Static instantiation by array

```php
use Intervention\Httpauth\Httpauth;

// create basic auth
$auth = Httpauth::make([
    'type' => 'basic',
    'realm' => 'Secure Resource',
    'username' => 'admin',
    'password' => 'secret',
]);
```

### Static instantiation by callback

```php
use Intervention\Httpauth\Httpauth;

// create basic auth
$auth = Httpauth::make(function ($config) {
    $config->type('basic');
    $config->realm('Secure Resource');
    $config->username('admin');
    $config->password('secret');
});
```

### Instantiation by calls

```php
use Intervention\Httpauth\Httpauth;

// create digest auth
$auth = Httpauth::digest()->realm('Secure')->credentials('admin', 'secret');
```

After your created a HTTP authentication instance, you have to call `secure()` to ask the user for credentials.


```php
// to ask the user for credentials, call secure method
$auth->secure();
```


## Server Configuration

### Apache

If you are using Apache and running php with fast-cgi, check setting headers:
https://support.deskpro.com/en/kb/articles/missing-authorization-headers-with-apache

## License

Intervention Httpauth Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
