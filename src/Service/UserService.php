<?php

namespace EventFul\Service;

/**
 * Description of Event
 *
 * @author Marcos Peña
 */
class UserService extends BaseService
{  
    protected function configure()
    {
        // https://api.eventful.com/docs/users/search
        $searchMethod = new Method('search');
        $searchMethod->setRequiredParam(array('keywords', 'location'));        
        $this->addMethod($searchMethod);
        // https://api.eventful.com/docs/users/get
        $method = new Method('get');
        //$method->setRequiredParam(array('keywords', 'location'));        
        $this->addMethod($method);
        
        $this->setServiceResource('users');
    }
}
