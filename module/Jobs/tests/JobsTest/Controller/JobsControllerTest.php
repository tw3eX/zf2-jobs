<?php
namespace JobsTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class JobsControllerTest
 *
 * @package JobsTest\Controller
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class JobsControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * @var bool
     */
    protected $traceError = true;

    /**
     *  Setup
     */
    public function setUp()
    {
        $this->setApplicationConfig(
            include 'config/application.config.php'
        );
    }

    /**
     *  Test for Jobs Controller Index Action
     */
    public function testControllerIndexAction()
    {
        $this->dispatch('/jobs');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('jobs');
        $this->assertControllerName('jobs\controller\jobs');
        $this->assertControllerClass('jobscontroller');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('jobs');
    }

}