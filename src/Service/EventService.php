<?php

namespace EventFul\Service;

/**
 * Description of Event
 *
 * @author Marcos Peña
 */
class EventService extends BaseService
{
    protected function configure()
    {
        // https://api.eventful.com/docs/events/search
        $searchMethod = new Method('search');
        $searchMethod->setRequiredParam(array('keywords', 'location', 'category', 'date'));
        $this->addMethod($searchMethod);
        // https://api.eventful.com/docs/events/get
        $getMethod = new Method('get');
        $getMethod->setRequiredParam(array('id'));
        $this->addMethod($getMethod);
        // https://api.eventful.com/docs/events/going/list
        $goingListMethod = new Method('goingList');
        $goingListMethod->setRequiredParam(array('id'));
        $this->addMethod($goingListMethod);
        // http://api.evdb.com/docs/events/tags/list
        $tagsListMethod = new Method('tagsList');
        $tagsListMethod->setRequiredParam(array('id'));
        $this->addMethod($tagsListMethod);
        // http://api.evdb.com/docs/events/dates/resolve
        $datesResolveMethod = new Method('datesResolve');
        $datesResolveMethod->setRequiredParam(array('date'));
        $this->addMethod($datesResolveMethod);
        
        $this->setServiceResource('events');
    }
}
