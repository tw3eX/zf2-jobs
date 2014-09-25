<?php
namespace JobsTest\Service;

use Jobs\Entity\Language;
use Jobs\Service;
use JobsTest\Bootstrap;
use PHPUnit_Framework_TestCase;

/**
 * Class LanguageTest
 *
 * @package JobsTest\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class LanguageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;
    /**
     * @var \Jobs\Service\DepartmentService
     */
    protected $languageService;

    /**
     * Test for requesting language
     */
    public function testCanGetLanguageById()
    {
        // Create a dummy language entity
        $language = new Language();

        // Set language fields
        $language->setId(1);
        $language->setName('fr');

        // Mock the entity manager, find should return our dummy language
        $emMock = $this->getMock('EntityManager', array('find'));
        $emMock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($language));

        // Create a new instance of the language service injecting our mocked entity manager
        $languageService = new Service\LanguageService($this->serviceManager, $emMock);

        // Call the service requesting language #1
        $responseLanguage = $languageService->getLanguageById(1);

        // Check the response is a language entity
        $this->assertInstanceOf('Jobs\Entity\Language', $responseLanguage);

        // Check that the returned entity is our dummy language
        $this->assertEquals(1, $responseLanguage->getId());
        $this->assertEquals('fr', $responseLanguage->getName());
    }

    /**
     * Setup
     */
    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();
    }

}