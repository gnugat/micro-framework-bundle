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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\DirectoryLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GnugatMicroFrameworkExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $fileLocator = new FileLocator(__DIR__.'/../Resources/config');
        $loader = new DirectoryLoader($container, $fileLocator);
        $loader->setResolver(new LoaderResolver(array(
            new YamlFileLoader($container, $fileLocator),
            $loader,
        )));
        $loader->load('services/');

        $this->configureRoutingParameters($container);
        $this->configureClassesToCompile();
    }

    /**
     * @param ContainerBuilder $container
     */
    private function configureRoutingParameters(ContainerBuilder $container)
    {
        if (false === $container->hasParameter('router.resource')) {
            $container->setParameter('router.resource', '%kernel.root_dir%/config/routings');
        }
        if (false === $container->hasParameter('router.resource_type')) {
            $container->setParameter('router.resource_type', 'directory');
        }
        $container->setParameter('router.cache_class_prefix', $container->getParameter('kernel.name').ucfirst($container->getParameter('kernel.environment')));
    }

    /**
     * Run `bin/what-classes-to-compile.sh` to have an idea of what to add here.
     */
    private function configureClassesToCompile()
    {
        $this->addClassesToCompile(array(
            'Gnugat\\MicroFrameworkBundle\\GnugatMicroFrameworkBundle',
            'Gnugat\\MicroFrameworkBundle\\Service\\ServiceControllerResolver',

            'Symfony\\Component\\ClassLoader\\ClassCollectionLoader',

            'Symfony\\Component\\Config\\ConfigCache',
            'Symfony\\Component\\Config\\FileLocator',
            'Symfony\\Component\\Config\\Loader\\DelegatingLoader',
            'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'Symfony\\Component\\Config\\Loader\\Loader',
            'Symfony\\Component\\Config\\Loader\\FileLoader',
            'Symfony\\Component\\Config\\Resource\\SelfCheckingResourceChecker',
            'Symfony\\Component\\Config\\ResourceCheckerConfigCache',
            'Symfony\\Component\\Config\\ResourceCheckerConfigCacheFactory',

            'Symfony\\Component\\DependencyInjection\\Container',

            'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'Symfony\\Component\\EventDispatcher\\Event',
            'Symfony\\Component\\EventDispatcher\\EventDispatcher',

            'Symfony\\Component\\HttpFoundation\\FileBag',
            'Symfony\\Component\\HttpFoundation\\HeaderBag',
            'Symfony\\Component\\HttpFoundation\\ServerBag',
            'Symfony\\Component\\HttpFoundation\\ParameterBag',
            'Symfony\\Component\\HttpFoundation\\Request',
            'Symfony\\Component\\HttpFoundation\\RequestStack',
            'Symfony\\Component\\HttpFoundation\\Response',
            'Symfony\\Component\\HttpFoundation\\ResponseHeaderBag',

            'Symfony\\Component\\HttpKernel\\Bundle\\Bundle',
            'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'Symfony\\Component\\HttpKernel\\Controller\\ControllerResolver',
            'Symfony\\Component\\HttpKernel\\HttpKernel',
            'Symfony\\Component\\HttpKernel\\Event\\FilterControllerEvent',
            'Symfony\\Component\\HttpKernel\\Event\\FilterResponseEvent',
            'Symfony\\Component\\HttpKernel\\Event\\FinishRequestEvent',
            'Symfony\\Component\\HttpKernel\\Event\\GetResponseEvent',
            'Symfony\\Component\\HttpKernel\\Event\\KernelEvent',
            'Symfony\\Component\\HttpKernel\\Event\\PostResponseEvent',
            'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'Symfony\\Component\\HttpKernel\\KernelEvents',

            'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'Symfony\\Component\\Routing\\Loader\\DirectoryLoader',
            'Symfony\\Component\\Routing\\Loader\\ObjectRouteLoader',
            'Symfony\\Component\\Routing\\Loader\\DependencyInjection\\ServiceRouterLoader',
            'Symfony\\Component\\Routing\\RequestContext',
            'Symfony\\Component\\Routing\\Router',
            'Symfony\\Component\\Routing\\Matcher\\UrlMatcher',
        ));
    }
}
