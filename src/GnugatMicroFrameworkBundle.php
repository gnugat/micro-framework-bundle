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
use Gnugat\MicroFrameworkBundle\DependencyInjection\CompilerPass\ConsoleCommandCompilerPass;
use Gnugat\MicroFrameworkBundle\DependencyInjection\CompilerPass\RoutingResolverCompilerPass;
use Symfony\Component\Config\Resource\ClassExistenceResource;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GnugatMicroFrameworkBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CacheClearerCompilerPass());
        $container->addCompilerPass(new CacheWarmerCompilerPass());
        $container->addCompilerPass(new ConsoleCommandCompilerPass());
        $container->addCompilerPass(new RoutingResolverCompilerPass());
        $container->addCompilerPass(
            new RegisterListenersPass(),
            PassConfig::TYPE_BEFORE_REMOVING,
        );
        $this->addCompilerPassIfExists(
            $container,
            AddConsoleCommandPass::class,
            PassConfig::TYPE_BEFORE_REMOVING,
        );
    }

    private function addCompilerPassIfExists(
        ContainerBuilder $container,
        string $class,
        string $type = PassConfig::TYPE_BEFORE_OPTIMIZATION,
        int $priority = 0,
    ) {
        $container->addResource(new ClassExistenceResource($class));

        if (class_exists($class)) {
            $container->addCompilerPass(new $class(), $type, $priority);
        }
    }
}
