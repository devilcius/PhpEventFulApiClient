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
        $method = new Method('search');
        $method->setRequiredParam(array('keywords', 'location'));        
        $this->addMethod($method);
        $this->setServiceResource('users');
    }
}
