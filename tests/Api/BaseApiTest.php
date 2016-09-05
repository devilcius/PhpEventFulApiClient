<?php

namespace EventFul\Test\Api;

use EventFul\EventFulApiClient;
use Dotenv\Dotenv;

/**
 * Description of BaseApiTest
 *
 * @author Marcos Peña
 */
class BaseApiTest extends \PHPUnit_Framework_TestCase
{
    protected $apiKey;
    protected $username;
    protected $password;
    protected $apiClient;
    
    protected function setUp()
    {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
        $this->apiKey = getenv('eventful_api_key');
        $this->apiClient = new EventFulApiClient($this->apiKey);
    }
    
    public function testDotenvFileExists()
    {
        $this->assertFileExists(__DIR__ . '/.env', 'You must need to setup a .env file to run the tests. https://github.com/vlucas/phpdotenv');
    }
}
