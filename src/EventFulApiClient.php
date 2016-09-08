<?php

namespace EventFul;

use EventFul\Common\Util;
use EventFul\Exception\InvalidResponseException;
use EventFul\Exception\ResponseException;
use EventFul\Transport\CurlTransport;
use EventFul\Transport\TransportInterface;

class EventFulApiClient
{

    /**
     * @deprecated TO BE DELETED, TODAY!!
     */
    const API_URL = 'http://api.evdb.com';

    private $apiKey;
    private $transport;

    /**
     * Constructor
     *
     * @param  string    $apiKey    Your API key
     * @param  Transport $transport A Transport instance
     */
    public function __construct($apiKey, $transport = null)
    {
        $this->apiKey = $apiKey;
        $this->transport = $transport;
        if (null === $transport) {
            $transport = new CurlTransport();
        }
        $this->setTransport($transport);
    }

    /**
     * Returns the api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Defines the underlying transport
     *
     * @param  TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * Returns the underlying transport
     *
     * @return Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Shortcut method to perform a GET request
     *
     * @param  string  $apiMethod
     * @param  array   $service
     * @param  array   $parameters
     * @param  boolean $raw
     *
     * @return mixed
     */
    public function get($apiMethod, $service, array $parameters = array(), $raw = false)
    {
        return $this->request(TransportInterface::HTTP_METHOD_GET, $apiMethod, $service, $parameters, $raw);
    }

    /**
     * Shortcut method to perform a POST request
     *
     * @param  string  $apiMethod
     * @param  array   $service
     * @param  array   $parameters
     * @param  boolean $raw
     *
     * @return mixed
     */
    public function post($apiMethod, $service, array $parameters = array(), $raw = false)
    {
        return $this->request(TransportInterface::HTTP_METHOD_POST, $apiMethod, $service, $parameters, $raw);
    }

    /**
     * Performs an API request and returns the result
     *
     * @param  string  $httpMethod   The HTTP method (one of the Transport::HTTP_METHOD_* constants)
     * @param  string  $service     The API service
     * @param  string  $apiMethod    The API method
     * @param  array   $parameters   An array of parameters
     * @param  boolean $raw          Whether to return the raw result
     *
     * @return mixed
     */
    public function request($httpMethod, $service, $apiMethod, array $parameters = array(), $raw = false)
    {
        if (null !== $this->apiKey) {
            $parameters['app_key'] = $this->apiKey;
        }
        if (!$raw) {
            $options['format'] = 'json';
        }

        $rawResult = $this->transport->request($httpMethod, $service, $apiMethod, $parameters, $options);
        if ($raw) {
            return $rawResult;
        }
        $result = json_decode($rawResult);

        if ($result === null) { // no results found
            $result = array();
        }
        if (!is_object($result)) {
            throw new InvalidResponseException($rawResult);
        }
        if (isset($result->error)) {
            $message = sprintf('Api error (%d): %s', $result->error, $result->description);

            throw new ResponseException($message);
        }

        return $result;
    }

    /**
     * Returns an event service instance
     *
     * @return \Lastfm\Service\EventService
     */
    public function getEventService()
    {
        return $this->getService('event');
    }

    /**
     * Returns an event service instance
     *
     * @return \Lastfm\Service\UserService
     */
    public function getUserService()
    {
        return $this->getService('user');
    }

    /**
     * Returns an event service instance
     *
     * @return \Lastfm\Service\PerformerService
     */
    public function getPerformerService()
    {
        return $this->getService('performer');
    }

    /**
     * Returns an instance of the specified service
     *
     * @param  string $name
     *
     * @return \Lastfm\Service
     */
    protected function getService($name)
    {
        if (!isset($this->services[$name])) {
            $this->services[$name] = $this->createService($name);
        }
        return $this->services[$name];
    }

    /**
     * Creates an instance of the specified service
     *
     * @param  string $name
     *
     * @return \Lastfm\Service
     */
    protected function createService($name)
    {
        $className = sprintf('EventFul\Service\%sService', ucfirst($name));
        if (!class_exists($className)) {
            throw new \RuntimeException(sprintf(
                    'Cannot create service \'%s\', class %s not found.', $name, $className
            ));
        }
        $class = new \ReflectionClass($className);

        return $class->newInstanceArgs(array($this));
    }

}
