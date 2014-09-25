<?php
namespace Jobs;

/**
 * Class Module
 * @package Jobs
 */
class Module
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DepartmentService' =>  function($sm)
                    {
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new \Jobs\Service\DepartmentService($sm, $em);
                    },
                'LanguageService' =>  function($sm)
                    {
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new \Jobs\Service\LanguageService($sm, $em);
                    },
                'JobService' =>  function($sm)
                    {
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new \Jobs\Service\JobService($sm, $em);
                    },
                'TranslationService' =>  function($sm)
                    {
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new \Jobs\Service\TranslationService($sm, $em);
                    }
            ),
        );
    }

}
