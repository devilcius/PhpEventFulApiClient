<?php
use EventFul\Exception\ResponseException;

namespace EventFul\Test\Api;

/**
 * Tests event api calls
 *
 * @author Marcos Peña
 */
class EventApiTest extends BaseApiTest
{


    public function testSearchEvent()
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
        
        $result = $service->search($params);

        $this->assertTrue($result->total_items > 0);
    }

    public function testGetEvent()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getEventService();
        $eventId = 'E0-001-085924924-0';
        $params['id'] = $eventId;        
        $result = $service->get($params);
        $this->assertTrue($result->id === $eventId);
    }
    
    public function testGoingListEvent()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getEventService();
        $eventId = 'E0-001-085924924-0';
        $params['id'] = $eventId;        
        $result = $service->goingList($params);
        $this->assertTrue($result->id === $eventId);
    }
    
    public function testTagsListEvent()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getEventService();
        $eventId = 'E0-001-085924924-0';
        $params['id'] = $eventId;        
        $result = $service->tagsList($params);
        $this->assertTrue($result->id === $eventId);
    }
    
    public function testPropertiesListEvent()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getEventService();
        $eventId = 'E0-001-085924924-0';
        $params['id'] = $eventId;        
        $result = $service->propertiesList($params);

        $this->assertTrue($result->id === $eventId);
    }      
    
    public function testDatesResolveEvent()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getEventService();
        $params['date'] = '2016-09-30';        
        $result = $service->datesResolve($params);
        $this->assertTrue($result->status === 'ok');
    }

}
