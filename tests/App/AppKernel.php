<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\App;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new \Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle(),

            // CustomBundle, similar to your own bundles
            new \tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\GnugatCustomBundle(),

            // Officially supported third party bundles
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
        );
    }

    public function getProjectDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return __DIR__.'/var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return __DIR__.'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yaml');
    }
}
