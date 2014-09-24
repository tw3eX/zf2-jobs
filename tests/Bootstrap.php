<?php
namespace JobsTest;

use Zend\Mvc;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;

class bootstrap
{
    static $serviceManager;

    static function go()
    {
        // Make everything relative to the root
        chdir(dirname(__DIR__));

        // Setup autoloading
        require_once(__DIR__ . '/../init_autoloader.php');

        // Run application
        $config = require('config/application.config.php');
        \Zend\Mvc\Application::init($config);

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        self::$serviceManager = $serviceManager;
    }

    static public function getServiceManager()
    {
        return self::$serviceManager;
    }
}

bootstrap::go();
