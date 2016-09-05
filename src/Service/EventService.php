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
        $method = new Method('search');
        $method->setRequiredParam(array('keywords', 'location', 'category', 'date'));
        $this->addMethod($method);
        $this->setServiceResource('events');
    }
}
