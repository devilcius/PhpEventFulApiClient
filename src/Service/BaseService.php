<?php

namespace EventFul\Service;

use EventFul\Common\Collection;
use EventFul\EventFulApiClient;
use EventFul\Exception\MethodNotFoundException;
use EventFul\Exception\ServiceNotFoundException;

/**
 * Description of BaseService
 *
 * @author Marcos Peña
 */
abstract class BaseService
{

    private $client;
    /**
     *
     * @var Collection 
     */
    private $methods;
    private $serviceResource;

    /**
     * Constructor
     *
     * @param  Client $client
     */
    public function __construct(EventFulApiClient $client)
    {
        $this->client = $client;
        $this->methods = new Collection();

        $this->configure();
    }

    /**
     * 
     * @param type $methodName
     * @param type $methodParams
     * @return type
     * @throws MethodNotFoundException
     * @throws ServiceNotFoundException
     */
    public function __call($methodName, $methodParams)
    {
        if(!$this->hasMethod($methodName)) {
            
            throw new MethodNotFoundException(sprintf('Call to undefined method %s::%s.', get_class($this), $methodName));
        }
        if($this->getServiceResource() === null) {
            
            throw new ServiceNotFoundException('Service resource not set!');
        }
        $method = $this->getMethod($methodName);
        $method->setParams($methodParams[0]);

        return $this->client->request($method->getHttpMethod(), $this->getServiceResource(), $methodName, $method->getParams());
    }

    /**
     * Configures the service methods
     *
     * @see Service::addMethod()
     */
    abstract protected function configure();

    
    /**
     * sets the service resource, to be used as a segment in the url
     * 
     * @param string $resource
     */
    protected function setServiceResource($resource)
    {
        $this->serviceResource = $resource;
    }
    
    /**
     * Returns the service segment of the api url
     * 
     * @return string
     */
    protected function getServiceResource()
    {
        return $this->serviceResource;
    }


    /**
     * 
     * @param \EventFul\Service\Method $method
     */
    protected function addMethod(Method $method)
    {
        $this->methods->addItem($method, $method->getName());
    }
    
    /**
     * Indicates whether the specified method is defined
     *
     * @param  string $name
     *
     * @return boolean
     */
    protected function hasMethod($name)
    {
        return $this->methods->keyExists($name);
    }

    /**
     * 
     * @param type $name
     * @return Method
     */
    public function getMethod($name)
    {
        return $this->methods->getItem($name);
    }
    /**
     * Returns all the defined methods
     *
     * @return Collection
     */
    protected function getMethods()
    {
        return $this->methods;
    }

    /**
     * Returns the name of the service. By default, it is the short class name
     *
     * @return string
     */
    protected function getName()
    {
        preg_match('/\\\\(\w+?)$/', strtolower(get_class($this)), $matches);

        if(empty($matches)) {
            throw new \RuntimeException(sprintf(
                'Unable to compute service name for class \'%s\'. Please override the ->getName() method.', get_class($this)
            ));
        }

        return end($matches);
    }

}
