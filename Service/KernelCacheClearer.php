<?php

namespace Gnugat\MicroFrameworkBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
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
        $filesystem = new Filesystem();
        $filesystem->remove($cacheDir);
    }
}
