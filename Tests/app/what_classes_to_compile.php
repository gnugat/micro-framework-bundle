<?php

/**
 * Displays classes that are loaded for every request.
 * Used to select the ones that are added to the classes to compile.
 */

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../../vendor/autoload.php';

$kernel = new \AppKernel('prod', false);
$kernel->loadClassCache();
Request::enableHttpMethodParameterOverride();

$before = get_declared_classes();

$request = Request::create('/?name=igor');
$response = $kernel->handle($request);
$kernel->terminate($request, $response);

$response->send();

$after = get_declared_classes();

$classes = array_diff($after, $before);
$total = count($classes);

echo "\n";
echo "\n";
echo "// Classes to compile ($total):\n";
echo "\n";

foreach ($classes as $class) {
    echo "  $class\n";
}

echo "\n";
echo " [OK]\n";
echo "\n";
