<?php

namespace EventFul;

use EventFul\Exception\MissingParameterException;
use EventFul\Service\Method;
use EventFul\Transport\TransportInterface;

class MethodTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $method = new Method('theMethod');
        $this->assertNotNull($method->getName());
        $this->assertEquals('theMethod', $method->getName());
        $method = new Method();
        $this->assertNull($method->getName());
    }

    public function testRequiredParams()
    {
        $client = $this->getMock('EventFul\EventFulApiClient', array('request'), array('theAppKey'));
        $client
                ->expects($this->once())
                ->method('request')
                ->with(
                        $this->equalTo(TransportInterface::HTTP_METHOD_GET), $this->equalTo('TheService'), $this->equalTo('the/method'), $this->equalTo(array('foo' => 'buh'))
                )
                ->will($this->returnValue('TheClientReturnValue'))
        ;

        $service = $this->getMock('EventFul\Service\BaseService', array('configure', 'getName'), array($client), 'TheService');
        $service
                ->expects($this->any())
                ->method('getName')
                ->will($this->returnValue('TheService'))
        ;

        $addMethodMethod = new \ReflectionMethod($service, 'addMethod');
        $addMethodMethod->setAccessible(true);
        $method = new Method('theMethod');
        $method->setRequiredParam(array('foo', 'bar'));
        $addMethodMethod->invokeArgs($service, array($method));
        $setServiceResourceMethod = new \ReflectionMethod($service, 'setServiceResource');
        $setServiceResourceMethod->setAccessible(true);
        $setServiceResourceMethod->invokeArgs($service, array('TheService'));
        $this->assertEquals('TheClientReturnValue', $service->theMethod(array('foo' => 'buh')));
        $this->expectException(MissingParameterException::class);
        $this->assertEquals('TheClientReturnValue', $service->theMethod(array('boo' => 'buh')));
    }

    public function testHttpMethod()
    {
        $method = new Method('theMethod');
        $this->assertEquals(TransportInterface::HTTP_METHOD_GET, $method->getHttpMethod());
        $method->setHttpMethod(TransportInterface::HTTP_METHOD_POST);
        $this->assertEquals(TransportInterface::HTTP_METHOD_POST, $method->getHttpMethod());
    }

}
