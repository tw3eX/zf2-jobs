<?php
namespace JobsTest\Service;
use Jobs\Service;
use JobsTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class LanguageTest extends \PHPUnit_Framework_TestCase
{
    protected $serviceManager;
    protected $languageService;

    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();
    }

    public function testCanGetLanguageById()
    {
        // Create a dummy language entity
        $language = new \Jobs\Entity\Language();

        // Set language fields
        $language->setId(1);
        $language->setName('fr');

        // Mock the entity manager, find should return our dummy language
        $emMock = $this->getMock('EntityManager',
            array('getRepository', 'getClassMetadata', 'persist', 'flush', 'find'), array(), '', false);
        $emMock->expects( $this->any() )
            ->method( 'find' )
            ->will( $this->returnValue( $language ) );

        // Create a new instance of the language service injecting our mocked entity manager
        $languageService = new \Jobs\Service\LanguageService($this->serviceManager, $emMock);

        // Call the service requesting language 123
        $responseLanguage = $languageService->getLanguageById( 123 );

        // Check the response is a language entity
        $this->assertInstanceOf('Jobs\Entity\Language', $responseLanguage);

        // Check that the returned entity is our dummy language
        $this->assertEquals(1, $responseLanguage->getId());
        $this->assertEquals('fr', $responseLanguage->getName());
    }
}