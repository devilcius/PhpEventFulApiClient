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
    
    public function testSearchVenue()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getVenueService();
        $params['location'] = 'Madrid';        
        $params['keywords'] = 'Moby Dick';
        $venues = $service->search($params);

        
        $this->assertTrue(intval($venues->total_items) > 0);
    }    
    
    public function testTagsListVenue()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getVenueService();
        $venueId = 'V0-001-000311874-3';
        $params['id'] = $venueId;        
        $result = $service->tagsList($params);

        $this->assertTrue($result->id === $venueId);
    }    
    
    
    public function testResolveVenue()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getVenueService();
        $city = 'Madrid';
        $params['location'] = $city;
        $params['city'] = $city;
        $result = $service->resolve($params);
        
        $this->assertTrue($result->original === $city);
    }    
    
    
    public function testPropertiesListVenue()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getVenueService();
        $venueId = 'V0-001-000311874-3';
        $params['id'] = $venueId;        
        $result = $service->propertiesList($params);

        $this->assertTrue($result->id === $venueId);
    }      
    
}
