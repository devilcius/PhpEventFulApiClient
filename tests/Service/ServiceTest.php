<?php
namespace EventFul;

use EventFul\Common\Collection;
use EventFul\Service\Method;
use EventFul\Transport\TransportInterface;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testAddMethod()
    {
        $service = $this->getMockForAbstractClass('EventFul\Service\BaseService', array($this->getClientMock()));

        $addMethodMethod = new \ReflectionMethod($service, 'addMethod');
        $addMethodMethod->setAccessible(true);
        $addMethodMethod->invokeArgs($service, array(new Method('foo')));

        $getMethodsMethod = new \ReflectionMethod($service, 'getMethods');
        $getMethodsMethod->setAccessible(true);
        $collection = new Collection();
        $collection->addItem(new Method('foo'), 'foo');
        $this->assertEquals(
            $collection,
            $getMethodsMethod->invoke($service)
        );
    }

    public function testHasMethod()
    {
        $service = $this->getMockForAbstractClass('EventFul\Service\BaseService', array($this->getClientMock()));

        $addMethodMethod = new \ReflectionMethod($service, 'addMethod');
        $addMethodMethod->setAccessible(true);

        $addMethodMethod->invokeArgs($service, array(new Method('foo')));

        $hasMethodMethod = new \ReflectionMethod($service, 'hasMethod');
        $hasMethodMethod->setAccessible(true);

        $this->assertTrue($hasMethodMethod->invokeArgs($service, array('foo')));
        $this->assertFalse($hasMethodMethod->invokeArgs($service, array('bar')));

        $addMethodMethod->invokeArgs($service, array(new Method('bar')));

        $this->assertTrue($hasMethodMethod->invokeArgs($service, array('foo')));
        $this->assertTrue($hasMethodMethod->invokeArgs($service, array('bar')));
    }

    public function testCall()
    {
        $client = $this->getClientMock();
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                    $this->equalTo(TransportInterface::HTTP_METHOD_GET), 
                    $this->equalTo('TheService'), 
                    $this->equalTo('theMethod'), 
                    $this->equalTo(array('foo' => 'bar'))
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
        $addMethodMethod->invokeArgs($service, array(new Method('theMethod')));

        $setServiceResourceMethod = new \ReflectionMethod($service, 'setServiceResource');
        $setServiceResourceMethod->setAccessible(true);
        $setServiceResourceMethod->invokeArgs($service, array('TheService'));        
        $this->assertEquals('TheClientReturnValue', $service->theMethod(array('foo' => 'bar')));

        $message = '->__call() raises an exception when an undefined method is called';
        try {
            $service->badMethod(array('foo' => 'bar'));
            $exception = false;
        } catch (\Exception $e) {
            $exception = true;
        }

        if (true === $exception) {
            $this->anything($message);
        } else {
            $this->fail($message);
        }
    }

    public function getClientMock()
    {
        return $this->getMock('EventFul\EventFulApiClient', array('request'), array('theAppKey'));
    }
}
