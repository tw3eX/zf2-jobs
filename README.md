ZendJobsApplication
=======================

Introduction
------------
Veeam PHP Test

Installation
------------

    git clone https://github.com/tw3eX/zf2-jobs.git

    php composer.phar self-update
    php composer.phar install


Then:
=======================

Database config
---------------
Create 'config/autoload/doctrine.local.php' with this:

    <?php
    return array(
        'doctrine' => array(
            'connection' => array(
                'orm_default' => array(
                    'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host'     => 'localhost',
                        'port'     => '3306',
                        'user'     => 'root',
                        'password' => 'pass',
                        'dbname'   => 'zend',
                        'charset' => 'utf8',
                        'driverOptions' => array(
                            1002=>'SET NAMES utf8'
                        )
                    )
                )
            ),
        ),
    );

Sync db schema
--------------

    vendor/bin/doctrine-module orm:schema-tool:update --force

Demo Content
------------
    
    INSERT INTO `departments` (`id`, `name`) VALUES
    (1, 'IT Department'),
    (2, 'Support Department');

    INSERT INTO `jobs` (`id`, `department_id`) VALUES
    (1, 1),
    (2, 1),
    (3, 1),
    (6, 1),
    (4, 2),
    (5, 2),
    (7, 2);

    INSERT INTO `languages` (`id`, `name`) VALUES
    (1, 'en'),
    (2, 'ru'),
    (3, 'fr');

    INSERT INTO `translations` (`id`, `language_id`, `job_id`, `name`, `description`) VALUES
    (1, 1, 1, 'PHP Developer', 'English description'),
    (2, 1, 2, 'C++ Developer', 'English description'),
    (3, 1, 3, 'Frontend Developer', 'English description'),
    (4, 1, 4, 'Supporter', 'English description'),
    (5, 1, 5, 'Caller   ', 'English description'),
    (6, 1, 6, 'Middle PHP Developer', 'English description'),
    (7, 1, 7, 'Manager', 'English description'),
    (8, 2, 1, 'PHP разработчик', 'Русское описание'),
    (9, 2, 2, 'C++ разработчик', 'Русское описание'),
    (10, 2, 3, 'Фронтенд разработчик', 'Русское описание'),
    (11, 2, 4, 'Сотрудник поддержки', 'Русское описание'),
    (12, 2, 5, 'Холодные звонки', 'Русское описание'),
    (13, 2, 6, 'Middle PHP разработчик', 'Русское описание'),
    (14, 2, 7, 'Менеджер', 'Русское описание'),
    (15, 3, 6, 'Moyen développeur PHP', 'Description français'),
    (16, 3, 7, 'Directeur', 'Description français');

and configure your server(apache2, nginx etc.)

Pictures
-----
![alt tag](http://s017.radikal.ru/i409/1409/53/d60d233e62ca.png)
![alt tag](http://i069.radikal.ru/1409/07/e5b8d2f884d6.png)
![alt tag](http://s019.radikal.ru/i640/1409/3c/d3dd1bc3513b.png)
