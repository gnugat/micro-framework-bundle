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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Resolves controllers defined as services (service:method notation).
 */
class ServiceControllerResolver implements ControllerResolverInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ControllerResolverInterface
     */
    private $controllerResolver;

    /**
     * @param ContainerInterface          $container
     * @param ControllerResolverInterface $parser
     */
    public function __construct(ContainerInterface $container, ControllerResolverInterface $controllerResolver)
    {
        $this->container = $container;
        $this->controllerResolver = $controllerResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function getController(Request $request)
    {
        $parts = explode(':', $request->attributes->get('_controller', ''));
        if (2 !== count($parts)) {
            return $this->controllerResolver->getController($request);
        }

        return array($this->container->get($parts[0]), $parts[1]);
    }

     /**
     * {@inheritdoc}
     */
    public function getArguments(Request $request, $controller)
    {
        return $this->controllerResolver->getArguments($request, $controller);
    }
}
