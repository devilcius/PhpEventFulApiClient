<?php

namespace EventFul\Service;

/**
 * Description of Event
 *
 * @author Marcos Peña
 */
class CategoryService extends BaseService
{
    protected function configure()
    {
        // https://api.eventful.com/docs/categories/list
        $listMethod = new Method('list');      
        $this->addMethod($listMethod);
        
        $this->setServiceResource('categories');
    }
}
