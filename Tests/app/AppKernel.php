<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle(),
            new Gnugat\MicroFrameworkBundle\Tests\Bundle\GnugatThirdPartyBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}
