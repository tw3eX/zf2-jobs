<?php
namespace JobsTest\Service;
use Jobs\Service;
use JobsTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class TranslationTest extends \PHPUnit_Framework_TestCase
{
    protected $serviceManager;
    protected $translationService;

    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();

        // Create a dummy translation entity
        $translation = new \Jobs\Entity\Translation();

        // Set translation fields
        $translation->setId(1);

        $language = new \Jobs\Entity\Language();
        $language->setId(1);
        $language->setName('en');
        $translation->setLanguage($language);

        // Create a dummy job entity
        $job = new \Jobs\Entity\Job();
        $job->setId(1);
        $department = new \Jobs\Entity\Department();
        $department->setId(1);
        $department->setName('It Department');
        $job->setDepartment($department);

        $translation->setJob($job);
        $translation->setName('English name');
        $translation->setDescription('English description');

        // Mock the entity manager, find should return our dummy translation
        $emMock = $this->getMock('EntityManager',
            array('getRepository', 'getClassMetadata', 'persist', 'flush', 'find'), array(), '', false);
        $emMock->expects( $this->any() )
            ->method( 'find' )
            ->will( $this->returnValue( $translation ) );

        // Create a new instance of the translation service injecting our mocked entity manager
        $this->translationService = new \Jobs\Service\TranslationService($this->serviceManager, $emMock);

    }

    public function testCanGetTranslationById()
    {
        // Call the service requesting translation 123
        $responseTranslation = $this->translationService->getTranslationById( 1 );

        // Check the response is a translation entity
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseTranslation);
        $this->assertInstanceOf('Jobs\Entity\Language', $responseTranslation->getLanguage());
        $this->assertInstanceOf('Jobs\Entity\Job', $responseTranslation->getJob());

        // Check that the returned entity is our dummy translation
        $this->assertEquals(1, $responseTranslation->getId());
        $this->assertEquals('English name', $responseTranslation->getName());
        $this->assertEquals('English description', $responseTranslation->getDescription());
        $this->assertEquals(1, $responseTranslation->getLanguage()->getId());
        $this->assertEquals('en', $responseTranslation->getLanguage()->getName());
        $this->assertEquals(1, $responseTranslation->getJob()->getId());
        $this->assertEquals(1, $responseTranslation->getJob()->getDepartment()->getId());
        $this->assertEquals('It Department', $responseTranslation->getJob()->getDepartment()->getName());
    }
}