<?php

use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ApcCache as Cache;

$loader = require_once __DIR__.'/vendor/autoload.php';
// $loader->add('Model', __DIR__ . '/library');

$classLoaderModel = new \Doctrine\Common\ClassLoader('Model', __DIR__ . '/library' );
$classLoaderModel->register(); 

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
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Leme\EntityProxy');
$config->setAutoGenerateProxyClasses(true);

$driver = $config->newDefaultAnnotationDriver(__DIR__."/library/Model");
// Caching Configuration (5)
if ($env == "development" || "testing") {
  $cache = new \Doctrine\Common\Cache\ArrayCache();
} else {
  $cache = new \Doctrine\Common\Cache\ApcCache();
}
$config->setMetadataCacheImpl($cache);
$config->setMetadataDriverImpl($driver);

$em = EntityManager::create(
  $dbOptions,
  $config
);