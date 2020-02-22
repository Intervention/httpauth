<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication type
    |--------------------------------------------------------------------------
    |
    | Intervention HttpAuth supports "basic" and "digest" authentication
    | implementations. "Basic" is the simplest technique, while "Digest" applies
    | hash functions to the password before sending it over the network.
    |
    | Supported: "basic", "digest"
    |
    */
    'type' => 'basic',

    /*
    |--------------------------------------------------------------------------
    | Authentication name
    |--------------------------------------------------------------------------
    |
    | Name of secured resource. Clients must authentificate to each named realm.
    |
    */
    'realm' => 'Secured',

    /*
    |--------------------------------------------------------------------------
    | Authentication username
    |--------------------------------------------------------------------------
    |
    | Username to access the secured realm in combination with a password.
    |
    */
    'username' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Password to access the secured realm in combination with the username.
    |
    */
    'password' => '1234'

];
