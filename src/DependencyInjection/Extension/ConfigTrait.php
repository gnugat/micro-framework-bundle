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

use Symfony\Component\Config\ResourceCheckerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

trait ConfigTrait
{
    private function loadConfig(array $configs, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(ResourceCheckerInterface::class)
            ->addTag('config_cache.resource_checker');
    }
}
