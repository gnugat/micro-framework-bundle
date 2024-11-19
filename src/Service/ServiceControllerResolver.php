<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

/**
 * Resolves controllers defined as services (service:method notation).
 */
class ServiceControllerResolver implements ControllerResolverInterface
{
    public function __construct(
        private ContainerInterface $container,
        private ControllerResolverInterface $controllerResolver,
    ) {
    }

    #[\Override]
    public function getController(Request $request): callable|false
    {
        $parts = explode(':', $request->attributes->get('_controller', ''));
        if (2 !== count($parts)) {
            return $this->controllerResolver->getController($request);
        }

        return [$this->container->get($parts[0]), $parts[1]];
    }
}
