<?php

namespace EventFul\Service;

/**
 * Description of Event
 *
 * @author Marcos Peña
 */
class PerformerService extends BaseService
{
    protected function configure()
    {
        // https://api.eventful.com/docs/performers/search
        $searchMethod = new Method('search');
        $searchMethod->setRequiredParam(array('keywords', 'category'));        
        $this->addMethod($searchMethod);
        // https://api.eventful.com/docs/performers/get
        $getMethod = new Method('get');
        $getMethod->setRequiredParam(array('id'));        
        $this->addMethod($getMethod);
        
        $this->setServiceResource('performers');
    }
}
