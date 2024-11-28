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

use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\AsTargetedValueResolver;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

trait HttpKernelTrait
{
    private function loadHttpKernel(array $configs, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(ValueResolverInterface::class)
            ->addTag('controller.argument_value_resolver');
        $container->registerForAutoconfiguration(DataCollectorInterface::class)
            ->addTag('data_collector');
        $container->registerForAutoconfiguration(CacheClearerInterface::class)
            ->addTag('kernel.cache_clearer');
        $container->registerForAutoconfiguration(CacheWarmerInterface::class)
            ->addTag('kernel.cache_warmer');

        $container->registerAttributeForAutoconfiguration(AsController::class, static function (ChildDefinition $definition, AsController $attribute): void {
            $definition->addTag('controller.service_arguments');
        });
        $container->registerAttributeForAutoconfiguration(AsTargetedValueResolver::class, static function (ChildDefinition $definition, AsTargetedValueResolver $attribute): void {
            $definition->addTag('controller.targeted_value_resolver', $attribute->name ? ['name' => $attribute->name] : []);
        });
    }
}
