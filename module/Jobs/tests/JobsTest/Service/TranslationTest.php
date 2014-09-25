<?php
namespace JobsTest\Service;

use Jobs\Entity\Department;
use Jobs\Entity\Job;
use Jobs\Entity\Language;
use Jobs\Entity\Translation;
use Jobs\Service;
use JobsTest\Bootstrap;
use PHPUnit_Framework_TestCase;

/**
 * Class TranslationTest
 *
 * @package JobsTest\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class TranslationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;
    /**
     * @var Service\TranslationService
     */
    protected $translationService;

    /**
     * Test for requesting translation
     */
    public function testCanGetTranslationById()
    {
        // Call the service requesting translation #1
        $responseTranslation = $this->translationService->getTranslationById(1);

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

    /**
     * Setup
     */
    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();

        // Create a dummy translation entity
        $translation = new Translation();

        // Set translation fields
        $translation->setId(1);

        $language = new Language();
        $language->setId(1);
        $language->setName('en');
        $translation->setLanguage($language);

        // Create a dummy job entity
        $job = new Job();
        $job->setId(1);
        $department = new Department();
        $department->setId(1);
        $department->setName('It Department');
        $job->setDepartment($department);

        $translation->setJob($job);
        $translation->setName('English name');
        $translation->setDescription('English description');

        // Mock the entity manager, find should return our dummy translation
        $emMock = $this->getMock('EntityManager', array('find'));
        $emMock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($translation));

        // Create a new instance of the translation service injecting our mocked entity manager
        $this->translationService = new Service\TranslationService($this->serviceManager, $emMock);
    }

}