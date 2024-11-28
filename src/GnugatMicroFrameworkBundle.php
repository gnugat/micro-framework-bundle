<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle;

use Gnugat\MicroFrameworkBundle\DependencyInjection\CompilerPass\CacheClearerCompilerPass;
use Gnugat\MicroFrameworkBundle\DependencyInjection\CompilerPass\CacheWarmerCompilerPass;
use Gnugat\MicroFrameworkBundle\DependencyInjection\CompilerPass\RoutingResolverCompilerPass;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GnugatMicroFrameworkBundle extends Bundle
{
    #[\Override]
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new CacheClearerCompilerPass());
        $container->addCompilerPass(new CacheWarmerCompilerPass());
        $container->addCompilerPass(new RoutingResolverCompilerPass());
        $container->addCompilerPass(
            new RegisterListenersPass(),
            PassConfig::TYPE_BEFORE_REMOVING,
        );
        $container->addCompilerPass(
            new AddConsoleCommandPass(),
            PassConfig::TYPE_BEFORE_REMOVING,
        );
    }
}
