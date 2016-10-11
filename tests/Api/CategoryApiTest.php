<?php

namespace EventFul\Test\Api;

/**
 * Tests performer api calls
 *
 * @author Marcos Peña
 */
class CategoryApiTest extends BaseApiTest
{

    public function testListCategories()
    {
        if (!$this->apiKey) {
            $this->markTestSkipped(
              'Api key needed for this kind of test'
            );
        }                
        $service = $this->apiClient->getCategoryService();
        $categories = $service->list(array());

        $this->assertTrue(sizeof($categories->category) > 0);
    }

}
