<?php

namespace Jobs\Service;

/**
 * Class ServiceBaseAbstract
 * Abstract base class for all services
 * @package JobTest\Service
 */
abstract class ServiceBaseAbstract
{
    // Doctrine Entity Manager
    protected $em;
    // Service Manageer
    protected $sm;

    public function __construct( $sm, $em )
    {
        // Make the service manager available to all services
        $this->sm = $sm;
        // Make the entity manager available to all services
        $this->em = $em;
    }
}