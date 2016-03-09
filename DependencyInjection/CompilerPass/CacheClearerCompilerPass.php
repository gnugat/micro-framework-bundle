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

class CacheClearerCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('cache_clearer')) {
            return;
        }
        $cacheClearer = $container->getDefinition('cache_clearer');
        $taggedServices = $container->findTaggedServiceIds('kernel.cache_clearer');
        foreach ($taggedServices as $id => $attributes) {
            $cacheClearer->addMethodCall('add', array(new Reference($id)));
        }
    }
}
