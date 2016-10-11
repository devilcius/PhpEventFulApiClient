<?php

namespace EventFul\Test\Api;

/**
 * Tests performer api calls
 *
 * @author Marcos Peña
 */
class PerformerApiTest extends BaseApiTest
{


    public function testSearchPerformer()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getPerformerService();
        $params['page_number'] = 1;
        $params['page_size'] = 1;
        $params['category'] = 'music';
        $params['keywords'] = 'descendents';

        $performers = $service->search($params);
        $this->assertTrue(is_object($performers));
    }

    public function testGetPerformer()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $descendentsId = 'P0-001-000045907-4';
        $service = $this->apiClient->getPerformerService();
        $params['id'] = $descendentsId;
        $params['show_events'] = false;
        $performer = $service->get($params);

        $this->assertTrue($performer->id === $descendentsId);
    }

    public function testEventsListPerformer()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $decendentsId = 'P0-001-000045907-4';
        $service = $this->apiClient->getPerformerService();
        $params['id'] = $decendentsId;
        $performer = $service->eventsList($params);

        $this->assertTrue(is_object($performer));
    }

    public function testGetPerformerFromExternalId()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $facebookId = '201362846550542';
        $service = $this->apiClient->getPerformerService();
        $params['ids'] = $facebookId;
        $params['source'] = 'fb_uid';
        $performers = $service->xidsList($params);
        
        $this->assertTrue($facebookId === $performers->performer->xid);
    }
}
