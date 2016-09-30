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
        $getMethod = new Method('get');
        $getMethod->setRequiredParam(array('id'));        
        $this->addMethod($getMethod);
        // http://api.evdb.com/docs/users/groups/list
        $groupListMethod = new Method('groupsList');
        $groupListMethod->setRequiredParam(array('id'));        
        $this->addMethod($groupListMethod);
        
        $this->setServiceResource('users');
    }
}
