<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Service;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\Routing\Router;

/**
 * Creates optimized UrlMatcherInterface and UrlGeneratorInterface implementations, using Dumpers.
 */
class RouterCacheWarmer implements CacheWarmerInterface
{
    public function __construct(
        private Router $router
    ) {
    }

    public function warmUp(string $cacheDir)
    {
        $this->router->getMatcher();
        $this->router->getGenerator();
    }

    public function isOptional()
    {
        return true;
    }
}
