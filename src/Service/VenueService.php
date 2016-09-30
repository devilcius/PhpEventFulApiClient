<?php

namespace EventFul\Service;

/**
 * Description of Event
 *
 * @author Marcos Peña
 */
class VenueService extends BaseService
{
    protected function configure()
    {
        // http://api.evdb.com/docs/venues/get
        $getMethod = new Method('get');
        $getMethod->setRequiredParam(array('id'));        
        $this->addMethod($getMethod);
        
        $this->setServiceResource('venues');
    }
}
