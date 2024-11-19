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

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new \Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle(),

            // CustomBundle, similar to your own bundles
            new \tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\GnugatCustomBundle(),

            // Officially supported third party bundles
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    public function getCacheDir(): string
    {
        return __DIR__.'/../../var/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return __DIR__.'/../../var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/config/config.yaml');
    }
}
