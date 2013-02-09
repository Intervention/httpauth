<?php

namespace Intervention\Httpauth;

use Exception;
use Illuminate\Config\Repository as Config;
use Illuminate\Config\FileLoader;
use Illuminate\Filesystem\Filesystem;

class Httpauth
{
    public $type = 'basic';

    /**
     * Realm of HTTP Authentication
     * 
     * @var string
     */
    public $realm = 'Secured resource';

    /**
     * Username of HTTP Authentication
     * 
     * @var string
     */
    private $username;

    /**
     * Password of HTTP Authentication
     * 
     * @var string
     */
    private $password;

    /**
     * Illuminate Config Repository
     * 
     * @var Illuminate\Config\Repository
     */
    public $config;

    /**
     * User data object
     * 
     * @var Intervention\Httpauth\UserInterface
     */
    private $user;

    /**
     * Creates new instance of Httpauth
     * 
     * @param array $parameters     set realm, username and/or password as key
     * @param Illuminate\Config\Repository $config
     */
    
    public function __construct($parameters = array(), \Illuminate\Config\Repository $config = null) 
    {
        // create configurator
        if (is_a($config, '\Illuminate\Config\Repository')) {
            
            $this->config = $config;

        } else {

            $loader = new FileLoader(new Filesystem, __DIR__.'/../../config');
            $this->config = new Config($loader, null);
        }

        // basic settings from config files
        $this->type = $this->config->get($this->getConfigKey('httpauth.type'));
        $this->realm = $this->config->get($this->getConfigKey('httpauth.realm'));
        $this->username = $this->config->get($this->getConfigKey('httpauth.username'));
        $this->password = $this->config->get($this->getConfigKey('httpauth.password'));

        // overwrite settings with runtime parameters (optional)
        if (is_array($parameters)) {

            if (array_key_exists('type', $parameters)) {
                $this->type = $parameters['type'];
            }

            if (array_key_exists('realm', $parameters)) {
                $this->realm = $parameters['realm'];
            }

            if (array_key_exists('username', $parameters)) {
                $this->username = $parameters['username'];
            }

            if (array_key_exists('password', $parameters)) {
                $this->password = $parameters['password'];
            }
        }

        // set user based on authentication type
        switch (strtolower($this->type)) {
            case 'digest':
                $this->user = new DigestUser;
                break;
            
            default:
                $this->user = new BasicUser;
                break;
        }

        // check if at leat username and password is set
        if ( ! $this->username || ! $this->password) {
            throw new Exception('No username or password set for HttpAuthentication.');
        }
    }

    /**
     * Creates new instance of Httpaccess with given parameters
     * 
     * @param  array  $parameters   set realm, username and/or password
     * @return Intervention\Httpauth\Httpauth         
     */
    static public function make($parameters = array())
    {
        return new Httpauth($parameters);
    }

    /**
     * Denies access for not-authenticated users 
     * 
     * @return void 
     */
    public function secure()
    {
        if ( ! $this->validateUser($this->user)) {
            $this->denyAccess();
        }
    }

    /**
     * Checks for valid user
     * 
     * @param  User $user
     * @return bool
     */
    private function validateUser(UserInterface $user)
    {
        return $user->isValid($this->username, $this->password, $this->realm);
    }

    /**
     * Checks if username/password combination matches
     *   
     * @param  string  $username
     * @param  string  $password
     * @return boolean          
     */
    public function isValid($username, $password)
    {
        return ($username == $this->username) && ($password == $this->password);
    }

    /**
     * Gets either global or package config-key
     *  
     * @param  string $key
     * @return string
     */
    private function getConfigKey($key)
    {
        return $this->config->has($key) ? $key : 'httpauth::'.$key;
    }

    /**
     * Sends HTTP 401 Header
     * 
     * @return void
     */
    private function denyAccess()
    {
        header('HTTP/1.0 401 Unauthorized');

        switch (strtolower($this->type)) {
            case 'digest':
                header('WWW-Authenticate: Digest realm="' . $this->realm .'",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($this->realm) . '"');
                break;
            
            default:
                header('WWW-Authenticate: Basic realm="'.$this->realm.'"');
                break;
        }
        
        die('<strong>HTTP/1.0 401 Unauthorized</strong>');
    }
}