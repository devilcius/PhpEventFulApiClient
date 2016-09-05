<?php

namespace EventFul\Transport;

/**
 * Description of Curl
 *
 * @author Marcos Peña
 */
class CurlTransport implements TransportInterface
{

    private $endPoint;
    private $timeout;
    private $userAgent;

    /**
     * Constructor
     *
     * @param  string  $endPoint
     * @param  integer $timeout
     * @param  string  $userAgent
     */
    public function __construct($endPoint = null, $timeout = null, $userAgent = null)
    {
        if(null === $endPoint) {
            $endPoint = 'http://api.evdb.com';
        }
        if(null === $timeout) {
            $timeout = 10;
        }
        if(null === $userAgent) {
            $userAgent = 'EventFul PHP Client';
        }
        $this->setEndPoint($endPoint);
        $this->setTimeout($timeout);
        $this->setUserAgent($userAgent);
    }

    /**
     * {@inheritDoc}
     */
    public function request($httpMethod, $service, $apiMethod, array $parameters = array(), array $options = array())
    {
        // define the common options
        $curlOptions = array(
                CURLOPT_USERAGENT => $this->userAgent,
                CURLOPT_TIMEOUT => $this->timeout,
        );
        // define other options depending on the HTTP method
        switch($httpMethod) {
            case TransportInterface::HTTP_METHOD_GET:
                $curlOptions[CURLOPT_URL] = $this->buildUrl($service, $apiMethod, $options['format'], $parameters);
                break;
            case TransportInterface::HTTP_METHOD_POST:
                $curlOptions[CURLOPT_URL] = $this->endPoint;
                $curlOptions[CURLOPT_POST] = true;
                $curlOptions[CURLOPT_POSTFIELDS] = $parameters;
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unsupported HTTP method (%s).', $httpMethod));
        }
        
        return $this->doRequest($curlOptions);
    }

    /**
     * Does the cURL request with the given cURL options
     *
     * @param  array $curlOptions The request cURL options
     *
     * @return string
     */
    protected function doRequest($curlOptions)
    {
        $curlSession = curl_init();
        curl_setopt_array($curlSession, $curlOptions);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curlSession);
        if(false === $result) {
            $errno = curl_errno($curlSession);
            $error = curl_error($curlSession);
            curl_close($curlSession);
            throw new \RuntimeException(sprintf('cUrl error (%d): %s', $errno, $error));
        }
        $httpCode = curl_getinfo($curlSession, CURLINFO_HTTP_CODE);
        if(200 !== $httpCode) {
            throw new \RuntimeException(sprintf('The API responded with status code %d.', $httpCode));
        }
        curl_close($curlSession);
        
        return $result;
    }

    /**
     * Builds url with params
     * 
     * @param string $service
     * @param string $method
     * @param array $parameters
     * @return string complete url
     * @throws \RuntimeException
     */
    protected function buildUrl($service, $method, $format, array $parameters)
    {
        $parts = parse_url($this->endPoint);
        $parts['path'] = '/' . $format . '/' . $service . '/' . $method;
        if(false === $parts) {
            throw new \RuntimeException(sprintf('Unable to parse end point url (%s).', $this->endPoint));
        }
        if(empty($parts['query'])) {
            $parts['query'] = http_build_query($parameters);
        } else {
            $parts['query'] = $parts['query'] . '&' . http_build_query($parameters);
        }
        $url = isset($parts['scheme']) ? $parts['scheme'] . '://' : '';
        $url.= isset($parts['user']) ? $parts['user'] . (isset($parts['pass']) ? ':' . $parts['pass'] : '') . '@' : '';
        $url.= isset($parts['host']) ? $parts['host'] : '';
        $url.= isset($parts['port']) ? ':' . $parts['port'] : '';
        $url.= isset($parts['path']) ? $parts['path'] : '';
        $url.= isset($parts['query']) ? '?' . $parts['query'] : '';
        $url.= isset($parts['fragment']) ? '#' . $parts['fragment'] : '';
        
        return $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * {@inheritDoc}
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
    }

    /**
     * Defines the timeout
     *
     * @param  integer $timeout The timeout in seconds
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Returns the timeout in seconds
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
    /**
     * Defines the user-agent
     *
     * @param  string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }
    /**
     * Returns the user-agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
}
