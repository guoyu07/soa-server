<?php

use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;
//use Doctrine\Common\Cache\ApcCache as Cache;

$loader = require_once __DIR__.'/vendor/autoload.php';
$loader->add('model', __DIR__ . '/library');

if(!getenv('APPLICATION_ENV'))
    $env = 'testing';
else
    $env = getenv('APPLICATION_ENV');

if ($env == 'testing')
    include __DIR__.'/config/config.testing.php';
elseif ($env == 'development')
    include __DIR__.'/config/config.development.php';
else
    include __DIR__.'/config/config.php';

//doctrine
$config = new Configuration();
//$cache = new Cache();
//$config->setQueryCacheImpl($cache);
$config->setProxyDir('/tmp');
$config->setProxyNamespace('EntityProxy');
$config->setAutoGenerateProxyClasses(true);

$driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    new Doctrine\Common\Annotations\AnnotationReader(),
    array(__DIR__ .'/library/model')
);
$config->setMetadataDriverImpl($driver);
//$config->setMetadataCacheImpl($cache);

$em = EntityManager::create(
  $dbOptions,
  $config
);