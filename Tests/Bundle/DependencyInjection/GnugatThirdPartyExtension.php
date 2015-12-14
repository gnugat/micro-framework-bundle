<?php

namespace Gnugat\MicroFrameworkBundle\Tests\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GnugatThirdPartyExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $fileLocator = new FileLocator(__DIR__.'/../Resources/config');
        $loader = new YamlFileLoader($container, $fileLocator);
        $loader->import('services.yml');
    }
}
