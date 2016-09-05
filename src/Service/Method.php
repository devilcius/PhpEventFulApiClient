<?php

namespace EventFul\Service;

use EventFul\Exception\MissingParameterException;
use EventFul\Transport\TransportInterface;


/**
 * Method used by an EventFul service
 *
 * @author Marcos Peña
 */
class Method
{
    /**
     *
     * @var string name
     */
    private $name;

    /**
     *
     * @var array params
     */
    private $params = array();

    /**
     * At least onne of the these parameters must exist
     * 
     * @var array params
     */
    private $requiredParamKey = array();

    /**
     *
     * @var boolean requires authentication
     */
    private $requiresAuthentication = true;

    /**
     *
     * @var string http method 
     */
    private $httpMethod = TransportInterface::HTTP_METHOD_GET;

    
    public function __construct($name = null)
    {
        if($name !== null) {
            
            $this->name = $name;
        }
    }
    /**
     * 
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @param string $name
     * @return \EventFul\Service\Method
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * 
     * @return boolean if method requires authentication
     */
    public function requiresAuthentication()
    {
        return $this->requiresAuthentication;
    }

    /**
     * 
     * @param boolean  $requires
     * @return \EventFul\Service\Method
     */
    public function setRequiresAuthentication($requires)
    {
        $this->requiresAuthentication = $requires;

        return $this;
    }

    /**
     * 
     * @return string http method
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * 
     * @param string http method
     * @return \EventFul\Service\Method
     */
    public function setHttpMethod($httpMethod)
    {
        $this->name = $httpMethod;

        return $this;
    }
    /**
     * 
     * @return array params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * 
     * @param array $params
     * @return \EventFul\Service\Method
     */
    public function setParams($params)
    {
        $this->params = $params;
        
        if(!$this->validate()) {
            
            throw new MissingParameterException(sprintf("One of these params is mandatory: %s", implode(', ', $this->requiredParamKey)));
        }
        
        return $this;
    }

    /**
     * 
     * @param array $params
     * @return \EventFul\Service\Method
     */
    public function setRequiredParam($params)
    {
        $this->requiredParamKey = $params;
        
        return $this;
    }    
    
    private function validate()
    {
        if(count($this->requiredParamKey) === 0) {
            
            return true;
        }
        foreach($this->params as $key => $value) {

            if(in_array($key, $this->requiredParamKey)) {
                
                return true;
            }
        }
        
        return false;
    }
}
