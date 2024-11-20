<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\DependencyInjection;

use Gnugat\MicroFrameworkBundle\DependencyInjection\Extension\ConfigTrait;
use Gnugat\MicroFrameworkBundle\DependencyInjection\Extension\ConsoleTrait;
use Gnugat\MicroFrameworkBundle\DependencyInjection\Extension\DependencyInjectionTrait;
use Gnugat\MicroFrameworkBundle\DependencyInjection\Extension\EventDispatcherTrait;
use Gnugat\MicroFrameworkBundle\DependencyInjection\Extension\HttpKernelTrait;
use Gnugat\MicroFrameworkBundle\DependencyInjection\Extension\RoutingTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\DirectoryLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GnugatMicroFrameworkExtension extends Extension
{
    use ConfigTrait;
    use ConsoleTrait;
    use DependencyInjectionTrait;
    use EventDispatcherTrait;
    use HttpKernelTrait;
    use RoutingTrait;

    public function load(array $configs, ContainerBuilder $container): void
    {
        $fileLocator = new FileLocator(__DIR__.'/../../config');
        $loader = new DirectoryLoader($container, $fileLocator);
        $loader->setResolver(new LoaderResolver([
            new YamlFileLoader($container, $fileLocator),
            $loader,
        ]));
        $loader->load('services/');

        $this->loadConfig($configs, $container);
        $this->loadConsole($configs, $container);
        $this->loadDependencyInjection($configs, $container);
        $this->loadEventDispatcher($configs, $container);
        $this->loadHttpKernel($configs, $container);
        $this->loadRouting($configs, $container);
    }
}
