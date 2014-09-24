<?php
// module/Jobs/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Jobs\Controller\Jobs' => 'Jobs\Controller\JobsController',
        ),
    ),

    'job_module_config' => array(
        'default_translation' => 'en'
    ),


    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'jobs' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/jobs[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Jobs\Controller\Jobs',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'jobs_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Jobs/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Jobs\Entity' => 'jobs_entity',
                )
            )
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);