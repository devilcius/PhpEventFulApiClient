<?php
namespace EventFul\Transport;

/**
 * Description of TransportInterface
 *
 * @author Marcos Peña
 */
interface TransportInterface
{

    const HTTP_METHOD_GET  = 'GET';
    const HTTP_METHOD_POST = 'POST';
    
    /**
     * Performs a request and returns the response
     *
     * @param  string $httpMethod The HTTP method (one of the HTTP_METHOD_* constants)
     * @param  string $service  The API service
     * @param  string $apiMethod  The API method 
     * @param  array  $parameters An array of parameters
     * @param  array  $options    An array of options for this request only
     */
    function request($httpMethod, $service, $apiMethod, array $parameters = array(), array $options = array());
    
    /**
     * sets api endpoint
     * 
     * @param string $endPoint
     */
    function setEndPoint($endPoint);
    
    /**
     * 
     * @return string api's endpoint
     */
    function getEndPoint();
}
