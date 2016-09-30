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
        // http://api.evdb.com/docs/venues/resolve
        $datesResolveMethod = new Method('resolve');
        $datesResolveMethod->setRequiredParam(array('location', 'city'));
        $this->addMethod($datesResolveMethod);        
        // http://api.evdb.com/docs/venues/properties/list
        $propertiesListMethod = new Method('propertiesList');
        $propertiesListMethod->setRequiredParam(array('id'));
        $this->addMethod($propertiesListMethod);        
        
        $this->setServiceResource('venues');
    }
}
