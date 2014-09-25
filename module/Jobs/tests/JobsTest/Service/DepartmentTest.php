<?php
namespace JobsTest\Service;
use Jobs\Service;
use JobsTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class DepartmentTest extends \PHPUnit_Framework_TestCase
{
    protected $serviceManager;
    protected $departmentService;

    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();

        // Create a dummy department entity
        $department = new \Jobs\Entity\Department();

        // Set department fields
        $department->setId(1);
        $department->setName('It Department');

        // Mock the entity manager, find should return our dummy department
        $emMock = $this->getMock('EntityManager', array('find'));

        $emMock->expects( $this->any() )
            ->method( 'find' )
            ->will( $this->returnValue( $department ) );

        // Create a new instance of the department service injecting our mocked entity manager
        $this->departmentService = new \Jobs\Service\DepartmentService($this->serviceManager, $emMock);
    }

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
}