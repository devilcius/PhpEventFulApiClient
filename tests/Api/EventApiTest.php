<?php

namespace EventFul\Test\Api;

/**
 * Tests event api calls
 *
 * @author Marcos Peña
 */
class EventApiTest extends BaseApiTest
{


    public function testSearchEvents()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getEventService();
        $params['page_number'] = 1;
        $params['page_size'] = 10;
        $params['category'] = 'music';
        $params['location'] = 'Madrid';
        
        $concerts = $service->search($params);
        
        $this->assertTrue(is_array($concerts));
    }

}
