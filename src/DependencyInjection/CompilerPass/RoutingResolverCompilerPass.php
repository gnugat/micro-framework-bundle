<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * `config/routing.yaml` defines a `routing.resolver` service (which is a Config LoaderResolver).
 * `config/services/routing/routing_loader.yaml` defines services with the `routing.loader` tag.
 * This adds them to the routing's config loader resolver.
 */
class RoutingResolverCompilerPass implements CompilerPassInterface
{
    #[\Override]
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->hasDefinition('routing.resolver')) {
            return;
        }
        $routingResolver = $container->getDefinition('routing.resolver');
        $taggedServices = $container->findTaggedServiceIds('routing.loader');
        foreach ($taggedServices as $id => $attributes) {
            $routingResolver->addMethodCall('addLoader', [new Reference($id)]);
        }
    }
}
