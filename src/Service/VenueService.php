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
        // http://api.evdb.com/docs/venues/search
        $searchMethod = new Method('search');
        $searchMethod->setRequiredParam(array('keywords', 'location'));        
        $this->addMethod($searchMethod);  
        // http://api.evdb.com/docs/venues/tags/list
        $tagsListMethod = new Method('tagsList');
        $tagsListMethod->setRequiredParam(array('id'));
        $this->addMethod($tagsListMethod);        
        
        $this->setServiceResource('venues');
    }
}
