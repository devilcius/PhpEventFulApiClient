<?php

namespace EventFul\Service;

/**
 * Description of Event
 *
 * @author Marcos Peña
 */
class DemandService extends BaseService
{
    protected function configure()
    {
        // https://api.eventful.com/docs/demands/get
        $getMethod = new Method('get');
        $getMethod->setRequiredParam(array('id'));        
        $this->addMethod($getMethod);
        // https://api.eventful.com/docs/demands/search
        $searchMethod = new Method('search');
        $searchMethod->setRequiredParam(array('keywords', 'category', 'location'));        
        $this->addMethod($searchMethod);
        
        $this->setServiceResource('demands');
    }
}
