<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Controller\MyController' shared service.

return $this->services['tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Controller\MyController'] = new \tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Controller\MyController(($this->services['tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHelloHandler'] ?? $this->load(__DIR__.'/getSayHelloHandlerService.php')));
