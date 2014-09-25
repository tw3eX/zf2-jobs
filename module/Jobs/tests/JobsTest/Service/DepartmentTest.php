<?php
namespace JobsTest\Service;

use Jobs\Entity\Department;
use Jobs\Service;
use JobsTest\Bootstrap;
use PHPUnit_Framework_TestCase;

/**
 * Class DepartmentTest
 *
 * @package JobsTest\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class DepartmentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var \Jobs\Service\DepartmentService
     */
    protected $departmentService;

    /**
     * Test for requesting department
     */
    public function testCanGetDepartmentById()
    {
        // Call the service requesting department #1
        $responseDepartment = $this->departmentService->getDepartmentById(1);

        // Check the response is a department entity
        $this->assertInstanceOf('Jobs\Entity\Department', $responseDepartment);

        // Check that the returned entity is our dummy department
        $this->assertEquals(1, $responseDepartment->getId());
        $this->assertEquals('It Department', $responseDepartment->getName());

    }

    /**
     * Setup
     */
    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();

        // Create a dummy department entity
        $department = new Department();

        // Set department fields
        $department->setId(1);
        $department->setName('It Department');

        // Mock the entity manager, find should return our dummy department
        $emMock = $this->getMock('EntityManager', array('find'));

        $emMock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($department));

        // Create a new instance of the department service injecting our mocked entity manager
        $this->departmentService = new Service\DepartmentService($this->serviceManager, $emMock);
    }

}