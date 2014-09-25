<?php

namespace Jobs\Service;

/**
 * Class ServiceBaseAbstract
 * Abstract base class for all services
 *
 * @package JobTest\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
abstract class ServiceBaseAbstract
{

    /**
     * @var \PhpUnit_Framework_MockObject_MockObject
     */
    protected $em;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $sm;

    /**
     * @param \Zend\ServiceManager\ServiceManager $sm
     * @param \PhpUnit_Framework_MockObject_MockObject $em
     */
    public function __construct( $sm, $em )
    {
        // Make the service manager available to all services
        $this->sm = $sm;
        // Make the entity manager available to all services
        $this->em = $em;
    }

}