<?php

namespace EventFul;

use EventFul\Transport;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $client = new EventFulApiClient('theApiKey');
        $this->assertNotNull($client->getTransport());
        $this->assertNotNull($client->getApiKey());
        $this->assertEquals('theApiKey', $client->getApiKey());
        $this->assertInstanceOf('EventFul\Transport\TransportInterface', $client->getTransport());
        $transport = $this->getMock('EventFul\Transport\CurlTransport');
        $client = new EventFulApiClient('theApiKey', $transport);
        $this->assertEquals($transport, $client->getTransport());
    }

    public function testSetTransport()
    {
        $client = new EventFulApiClient('theApiKey');
        $transport = $this->getMock('EventFul\Transport\TransportInterface');
        $client->setTransport($transport);
        $this->assertEquals($transport, $client->getTransport());
    }

    public function testSetApiKey()
    {
        $client = new EventFulApiClient('theApiKey');
        $this->assertEquals('theApiKey', $client->getApiKey());
    }

    public function testRequest()
    {
        $transport = $this->getMock('EventFul\Transport\CurlTransport', array('request'));
        $transport
                ->expects($this->once())
                ->method('request')
                ->with(
                        $this->equalTo(Transport\TransportInterface::HTTP_METHOD_GET), $this->equalTo('Foo.bar'), $this->equalTo('Foo.bar'), $this->equalTo(array('foo' => 'bar', 'app_key' => 'theApiKey')))
        ;
        $client = new EventFulApiClient('theApiKey', $transport);
        $this->assertEquals(array(), $client->request(Transport\TransportInterface::HTTP_METHOD_GET, 'Foo.bar', 'Foo.bar', array('foo' => 'bar'), false));
    }

    public function testGet()
    {
        $client = $this->getMock('EventFul\EventFulApiClient', array('request'), array('theApiKey'));
        $client
                ->expects($this->once())
                ->method('request')
                ->with(
                        $this->equalTo(Transport\TransportInterface::HTTP_METHOD_GET), 
                        $this->equalTo('Foo.bar'), 
                        $this->equalTo('Foo.bar'), 
                        $this->equalTo(array('foo' => 'bar')), 
                        $this->equalTo(false)
                )
                ->will($this->returnValue('THE_REQUEST_RETURN_VALUE'))
        ;

        $this->assertEquals('THE_REQUEST_RETURN_VALUE', $client->get('Foo.bar', 'Foo.bar', array('foo' => 'bar')));
    }

    public function testPost()
    {
        $client = $this->getMock('EventFul\EventFulApiClient', array('request'), array('theApiKey'));
        $client
                ->expects($this->once())
                ->method('request')
                ->with(
                        $this->equalTo(Transport\TransportInterface::HTTP_METHOD_POST), 
                        $this->equalTo('Foo.bar'), 
                        $this->equalTo('Foo.bar'), 
                        $this->equalTo(array('foo' => 'bar')), 
                        $this->equalTo(false)
                )
                ->will($this->returnValue('THE_REQUEST_RETURN_VALUE'))
        ;

        $this->assertEquals('THE_REQUEST_RETURN_VALUE', $client->post('Foo.bar', 'Foo.bar', array('foo' => 'bar')));
    }

    /**
     * @dataProvider dataForGetService
     */
    public function testGetService($name, $className)
    {
        $client = new EventFulApiClient('theApiKey');
        $method = sprintf('get%sService', ucfirst($name));

        $r = new \ReflectionMethod($client, $method);

        $this->assertInstanceOf($className, $r->invoke($client));
    }

    public function dataForGetService()
    {
        return array(
            array('event', 'EventFul\Service\EventService'),
            array('user', 'EventFul\Service\UserService'),
            array('performer', 'EventFul\Service\PerformerService'),
        );
    }

}
