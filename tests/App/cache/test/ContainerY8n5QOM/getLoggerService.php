<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'logger' shared service.

$a = new \Monolog\Handler\NullHandler(400, true);
$a->pushProcessor(new \Monolog\Processor\PsrLogMessageProcessor());

$this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');

$instance->useMicrosecondTimestamps(true);
$instance->pushHandler($a);

return $instance;
