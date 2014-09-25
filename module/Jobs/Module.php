<?php
namespace Jobs;

/**
 * Class Module
 *
 * @package Jobs
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class Module
{

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DepartmentService'  => function ($sm) {
                        /** @var $sm \Zend\ServiceManager\ServiceManager */
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new Service\DepartmentService($sm, $em);
                    },
                'LanguageService'    => function ($sm) {
                        /** @var $sm \Zend\ServiceManager\ServiceManager */
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new Service\LanguageService($sm, $em);
                    },
                'JobService'         => function ($sm) {
                        /** @var $sm \Zend\ServiceManager\ServiceManager */
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new Service\JobService($sm, $em);
                    },
                'TranslationService' => function ($sm) {
                        /** @var $sm \Zend\ServiceManager\ServiceManager */
                        $em = $sm->get('Doctrine\ORM\EntityManager');
                        return new  Service\TranslationService($sm, $em);
                    }
            ),
        );
    }

}
