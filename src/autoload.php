<?php

require_once __DIR__.'/vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$autoloader = new Symfony\Component\ClassLoader\UniversalClassLoader();

$autoloader->registerNamespaces(array(
  'Sensio'  => __DIR__,
  'Symfony' => __DIR__.'/vendor/symfony/src'
));

$autoloader->register();

