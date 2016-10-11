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
        
        $this->setServiceResource('demands');
    }
}
