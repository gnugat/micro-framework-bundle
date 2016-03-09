<?php

namespace Gnugat\MicroFrameworkBundle\Service;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

/**
 * Removes the cache directory (usually `var/cache/<env>`)
 */
class KernelCacheClearer implements CacheClearerInterface
{
    /**
     * {@inheritDoc}
     */
    public function clear($cacheDir)
    {
        exec("rm -rf $cacheDir");
    }
}
