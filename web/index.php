<?php

use Sensio\EsiCacheKernel;
use Sensio\SymfonyWrapperKernel;
use Symfony\Component\HttpFoundation\Request;

$projectPath = realpath(__DIR__.'/..');

require_once($projectPath.'/src/autoload.php');

$kernel = new EsiCacheKernel(new SymfonyWrapperKernel($projectPath, 'frontend', 'prod', false), $projectPath);
$kernel->handle(Request::createfromGlobals())->send();
