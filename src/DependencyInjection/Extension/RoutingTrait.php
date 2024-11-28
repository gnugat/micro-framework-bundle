<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;

trait RoutingTrait
{
    private function loadRouting(array $configs, ContainerBuilder $container): void
    {
        if (false === $container->hasParameter('router.resource')) {
            $container->setParameter(
                'router.resource',
                '%kernel.project_dir%/config/routings',
            );
        }
        if (false === $container->hasParameter('router.resource_type')) {
            $container->setParameter('router.resource_type', 'directory');
        }
        $kernelEnvironment = $container->getParameter('kernel.environment');
        $kernelContainerClass = $container->getParameter(
            'kernel.container_class',
        );
        $container->setParameter(
            'router.cache_class_prefix',
            $kernelContainerClass.ucfirst($kernelEnvironment),
        );
    }
}
