<?php

namespace EventFul\Test\Api;

/**
 * Tests performer api calls
 *
 * @author Marcos Peña
 */
class DemandApiTest extends BaseApiTest
{

    public function testGetDemand()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $descendentsDemandId = 'D0-001-006853712-3';
        $service = $this->apiClient->getDemandService();
        $params['id'] = $descendentsDemandId;
        $demand = $service->get($params);

        $this->assertTrue($demand->id === $descendentsDemandId);
    }

}
