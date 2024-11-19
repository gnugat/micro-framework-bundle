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

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

/**
 * Removes the cache directory (usually `var/cache/<env>`).
 */
class KernelCacheClearer implements CacheClearerInterface
{
    #[\Override]
    public function clear(string $cacheDir): void
    {
        $filesystem = new Filesystem();
        $filesystem->remove($cacheDir);
    }
}
