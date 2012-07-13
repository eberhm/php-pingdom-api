<?php
namespace Emagister;


require_once __DIR__.'/../../vendor/autoload.php';

use Guzzle\Http\Client;

class PingdomAPI
{

    private $_key;
    private $_username;
    private $_password;

    public function __construct($baseUrl = '', $key = '', $username = '', $password = '') {
        $client = $this->getHttpClient();
        $client->setBaseUrl($baseUrl);
        $this->setHttpClient($client);

        $this->setKey($key);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    /**
     * @var Client
     */
    private $_httpClient;

    public function getChecks()
    {
        $client = $this->getHttpClient();
        $request = $client->get('checks', array(
            'App-Key' => $this->getKey()
        ));
        $request->setAuth($this->getUsername(), $this->getPassword());

        return $request->send();
    }

    /**
     * @param \Guzzle\Http\Client $httpClient
     */
    public function setHttpClient(\Guzzle\Http\Client $httpClient)
    {
        $this->_httpClient = $httpClient;
    }

    /**
     * @return \Guzzle\Http\Client
     */
    public function getHttpClient()
    {
        if (null === $this->_httpClient) {
            $this->_httpClient = new Client();
        }
        return $this->_httpClient;
    }

    public function setKey($key)
    {
        $this->_key = $key;
    }

    public function getKey()
    {
        return $this->_key;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function getUsername()
    {
        return $this->_username;
    }
}