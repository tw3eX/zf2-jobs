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
 * Class JobTest
 *
 * @package JobsTest\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class JobTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test for requesting job of translation job ;)
     */
    public function testIsTranslationForJob()
    {
        // Call the service requesting job #1
        $responseJob = $this->jobService->getJobById(1);

        $this->assertEquals(1, $responseJob->getTranslation('en')->getJob()->getId());
        $this->assertEquals(1, $responseJob->getTranslation('fr')->getJob()->getId());
        $this->assertEquals(1, $responseJob->getTranslation('must_be_default_en')->getJob()->getId());

    }

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var Service\JobService
     */
    protected $jobService;

    /**
     * Test for requesting job
     */
    public function testCanGetJobById()
    {
        // Call the service requesting job #1
        $responseJob = $this->jobService->getJobById(1);

        // Check the response is a job entity
        $this->assertInstanceOf('Jobs\Entity\Job', $responseJob);
        $this->assertInstanceOf('Jobs\Entity\Department', $responseJob->getDepartment());

        // Check that the returned entity is our dummy job
        $this->assertEquals(1, $responseJob->getId());
        $this->assertEquals(1, $responseJob->getDepartment()->getId());

    }

    /**
     * Test for requesting translation of job
     */
    public function testCanGetTranslation()
    {
        // Call the service requesting job #1
        $responseJob = $this->jobService->getJobById(1);

        // Check the response is a Translation entity
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslation('en'));
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslation('fr'));
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslation('must_be_default_en'));

        $this->assertEquals(1, $responseJob->getTranslation('en')->getId());
        $this->assertEquals(2, $responseJob->getTranslation('fr')->getId());
        $this->assertEquals(1, $responseJob->getTranslation('must_be_default_en')->getId());

        $this->assertEquals('English name', $responseJob->getTranslation('en')->getName());
        $this->assertEquals('Fr name', $responseJob->getTranslation('fr')->getName());
        $this->assertEquals('English name', $responseJob->getTranslation('must_be_default_en')->getName());

        $this->assertEquals('English description', $responseJob->getTranslation('en')->getDescription());
        $this->assertEquals('Fr description', $responseJob->getTranslation('fr')->getDescription());
        $this->assertEquals(
            'English description', $responseJob->getTranslation('must_be_default_en')->getDescription()
        );

    }

    /**
     * Test for requesting translations ArrayCollection
     */
    public function testCanGetTranslations()
    {
        // Call the service requesting job #1
        $responseJob = $this->jobService->getJobById(1);

        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $responseJob->getTranslations());
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslations()->first());
        $this->assertEquals(2, $responseJob->getTranslations()->count());

    }

    /**
     * Test for requesting translation if default translation is empty
     */
    public function testIsEmptyDefaultTranslation()
    {
        // Create a dummy job entity
        $job = new Job();

        // Set job fields
        $job->setId(1);

        $department = new Department();
        $department->setId(1);
        $department->setName('It Department');
        $job->setDepartment($department);

        // Create a dummy translation entity
        $translation_fr = new Translation();
        // Set translation fields
        $translation_fr->setId(2);
        $language = new Language();
        $language->setId(1);
        $language->setName('fr');
        $translation_fr->setLanguage($language);
        $translation_fr->setJob($job);
        $translation_fr->setName('Fr name');
        $translation_fr->setDescription('Fr description');
        $job->addTranslation($translation_fr);

        // Mock the entity manager, find should return our dummy job
        $emMock = $this->getMock('EntityManager', array('find'));
        $emMock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($job));

        // Create a new instance of the department service injecting our mocked entity manager
        $jobService = new Service\JobService($this->serviceManager, $emMock);

        // Call the service requesting job #1
        $responseJob = $jobService->getJobById(1);

        // Check the response is a Translation entity
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslation('en'));
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslation('fr'));
        $this->assertInstanceOf('Jobs\Entity\Translation', $responseJob->getTranslation('must_be_default_en'));

        $this->assertEquals(2, $responseJob->getTranslation('en')->getId());
        $this->assertEquals(2, $responseJob->getTranslation('fr')->getId());
        $this->assertEquals(2, $responseJob->getTranslation('must_be_default_en')->getId());

        $this->assertEquals('Fr name', $responseJob->getTranslation('en')->getName());
        $this->assertEquals('Fr name', $responseJob->getTranslation('fr')->getName());
        $this->assertEquals('Fr name', $responseJob->getTranslation('must_be_default_en')->getName());

        $this->assertEquals('Fr description', $responseJob->getTranslation('en')->getDescription());
        $this->assertEquals('Fr description', $responseJob->getTranslation('fr')->getDescription());
        $this->assertEquals('Fr description', $responseJob->getTranslation('must_be_default_en')->getDescription());

    }

    /**
     * Setup
     */
    protected function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();

        // Create a dummy job entity
        $job = new Job();

        // Set job fields
        $job->setId(1);

        $department = new Department();
        $department->setId(1);
        $department->setName('It Department');
        $job->setDepartment($department);

        // Create a dummy translation entity
        $translation_en = new Translation();
        // Set translation fields
        $translation_en->setId(1);
        $language = new Language();
        $language->setId(1);
        $language->setName('en');
        $translation_en->setLanguage($language);
        $translation_en->setJob($job);
        $translation_en->setName('English name');
        $translation_en->setDescription('English description');
        $job->addTranslation($translation_en);

        // Create a dummy translation entity
        $translation_fr = new Translation();
        // Set translation fields
        $translation_fr->setId(2);
        $language = new Language();
        $language->setId(1);
        $language->setName('fr');
        $translation_fr->setLanguage($language);
        $translation_fr->setJob($job);
        $translation_fr->setName('Fr name');
        $translation_fr->setDescription('Fr description');
        $job->addTranslation($translation_fr);

        // Mock the entity manager, find should return our dummy job
        $emMock = $this->getMock('EntityManager', array('find'));
        $emMock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($job));

        // Create a new instance of the department service injecting our mocked entity manager
        $this->jobService = new Service\JobService($this->serviceManager, $emMock);
    }

}