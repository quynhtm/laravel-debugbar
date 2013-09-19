<?php

namespace Barryvdh\Debugbar;
use DebugBar\HttpDriverInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
/**
 * HTTP driver for Symfony Request/Session
 */
class SymfonyHttpDriver implements HttpDriverInterface
{
    /** @var \Symfony\Component\HttpFoundation\Session\Session  */
    protected $session;
    /** @var \Symfony\Component\HttpFoundation\Response  */
    protected $response;

    public function __construct(Session $session, Response $response = null){
        $this->session = $session;
        $this->response = $response;
    }

    public function setSession(Session $session){
        $this->session = $session;
    }

    public function setResponse(Response $response){
        $this->response = $response;
    }
    /**
     * {@inheritDoc}
     */
    function setHeaders(array $headers)
    {
        if(!is_null($this->response)){
            $this->response->headers->add($headers);
        }

    }

    /**
     * {@inheritDoc}
     */
    function isSessionStarted()
    {
        return !is_null($this->session);
    }

    /**
     * {@inheritDoc}
     */
    function setSessionValue($name, $value)
    {
        $this->session->set($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    function hasSessionValue($name)
    {
        return $this->session->has($name);
    }

    /**
     * {@inheritDoc}
     */
    function getSessionValue($name)
    {
        return $this->session->get($name);
    }

    /**
     * {@inheritDoc}
     */
    function deleteSessionValue($name)
    {
        $this->session->remove($name);
    }
}