<?php

namespace Gnugat\MicroFrameworkBundle\Service;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\Routing\Router;

/**
 * Creates optimized UrlMatcherInterface and UrlGeneratorInterface implementations, using Dumpers.
 */
class RouterCacheWarmer implements CacheWarmerInterface
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function warmUp($cacheDir)
    {
        $this->router->getMatcher();
        $this->router->getGenerator();
    }

    /**
     * {@inheritdoc}
     */
    public function isOptional()
    {
        return true;
    }
}
