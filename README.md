# Intervention HttpAuth

HTTP Authentication Management

[![Latest Version](https://img.shields.io/packagist/v/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth)
[![Tests](https://github.com/Intervention/httpauth/actions/workflows/build.yml/badge.svg)](https://github.com/Intervention/httpauth/actions/workflows/build.yml)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/httpauth.svg)](https://packagist.org/packages/intervention/httpauth/stats)
[![Support me on Ko-fi](https://raw.githubusercontent.com/Intervention/httpauth/main/.github/images/support.svg)](https://ko-fi.com/interventionphp)

## Installation

You can easily install this library using [Composer](https://getcomposer.org).
Just request the package with the following command:

```bash
composer require intervention/httpauth
```

## Documentation

Read the full [documentation](https://httpauth.intervention.io) for this library.

## Usage

The workflow is easy. Just create an instance of `Authenticator::class` in the first step
and secure your resource in the second step.

### 1. Create Authenticator Instance

To create authenticator instances you can choose between different methods.

#### Create Instance by Using Static Factory Method

```php
use Intervention\HttpAuth\Authenticator;

// create http basic auth
$auth = Authenticator::basic(
    'myUsername',
    'myPassword',
    'Secured Area',
);

// create http digest auth
$auth = Authenticator::digest(
    'myUsername',
    'myPassword',
    'Secured Area',
);
```

#### Create Instance by Using Class Constructor

```php
use Intervention\HttpAuth\Authenticator;

// alternatively choose DigestVault::class
$vault = new BasicVault(
    'myUsername',
    'myPassword',
    'Secured Area',
);

$auth = new Authenticator($vault);
```

#### Create Instance by Static Factory Method

```php
use Intervention\HttpAuth\Authenticator;

// alternatively choose DigestVault::class
$vault = new BasicVault(
    'myUsername',
    'myPassword',
    'Secured Area',
);

$auth = Authenticator::withVault($vault);
```

### 2. Ask User for Credentials

After you created a HTTP authentication instance, you have to call `secure()`
to secure the resource. This results in a 401 HTTP response and the browser
asking for credentials.

```php
$auth->secure();
```

A character string can optionally be passed to the method. This is displayed if
authentication fails. Output from template engines can also be used here.

```php
$auth->secure('Sorry, you can not access this resource!');
```

## Server Configuration

### Apache

If you are using Apache and running PHP with CGI/FastCGI, check the server
configuration to make sure the authorization headers are passed correctly to PHP:

https://support.deskpro.com/en/kb/articles/missing-authorization-headers-with-apache

## Authors

This library is developed and maintained by [Oliver Vogel](https://intervention.io)

Thanks to the community of [contributors](https://github.com/Intervention/httpauth/graphs/contributors) who have helped to improve this project.

## License

Intervention HttpAuth is licensed under the [MIT License](LICENSE).
