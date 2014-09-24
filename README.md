ZendJobsApplication
=======================

Introduction
------------
Veeam PHP Test

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

    curl -s https://getcomposer.org/installer | php --
    php composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" zendframework/skeleton-application path/to/install

Alternately, clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Then:
-----

    vendor/bin/doctrine-module orm:schema-tool:update --force

Pictures
-----
![alt tag](http://s017.radikal.ru/i409/1409/53/d60d233e62ca.png)
![alt tag](http://i069.radikal.ru/1409/07/e5b8d2f884d6.png)
![alt tag](http://s019.radikal.ru/i640/1409/3c/d3dd1bc3513b.png)
