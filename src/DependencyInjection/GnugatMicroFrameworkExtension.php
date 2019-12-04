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
        $fileLocator = new FileLocator(__DIR__.'/../../config');
        $loader = new DirectoryLoader($container, $fileLocator);
        $loader->setResolver(new LoaderResolver(array(
            new YamlFileLoader($container, $fileLocator),
            $loader,
        )));
        $loader->load('services/');

        $this->configureRoutingParameters($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    private function configureRoutingParameters(ContainerBuilder $container)
    {
        if (false === $container->hasParameter('router.resource')) {
            $container->setParameter(
                'router.resource',
                '%kernel.project_dir%/config/routings'
            );
        }
        if (false === $container->hasParameter('router.resource_type')) {
            $container->setParameter('router.resource_type', 'directory');
        }
        $kernelEnvironment = $container->getParameter('kernel.environment');
        $kernelContainerClass = $container->getParameter(
            'kernel.container_class'
        );
        $container->setParameter(
            'router.cache_class_prefix',
            $kernelContainerClass.ucfirst($kernelEnvironment)
        );
    }
}
