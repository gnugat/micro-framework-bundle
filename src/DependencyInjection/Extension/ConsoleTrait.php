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
use Symfony\Component\Console\Command\Command;

trait ConsoleTrait
{
    private function loadConsole(array $configs, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(Command::class)
            ->addTag('console.command');
    }
}
