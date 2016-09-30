<?php

namespace EventFul\Test\Api;

/**
 * Tests performer api calls
 *
 * @author Marcos Peña
 */
class VenueApiTest extends BaseApiTest
{

    public function testGetVenue()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $mobyDickVenueId = 'V0-001-000311874-3';
        $service = $this->apiClient->getVenueService();
        $params['id'] = $mobyDickVenueId;
        $params['location'] = 'Madrid';
        $venue = $service->get($params);
        $this->assertTrue($venue->id === $mobyDickVenueId);
    }
}
