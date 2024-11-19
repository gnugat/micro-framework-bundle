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
    #[\Override]
    public function registerBundles(): iterable
    {
        // Taken from symfony/framework-bundle's MicroKernelTrait
        $contents = require __DIR__.'/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    #[\Override]
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        // Configure container
        $configFilename = __DIR__.'/config/services.yaml';
        $configEnvFilename = __DIR__."/config/services_{$this->environment}.yaml";
        if (is_file($configEnvFilename)) {
            $configFilename = $configEnvFilename;
        }
        $loader->load($configFilename);
    }

    #[\Override]
    public function getProjectDir(): string
    {
        // Should point to the app's path where the `composer.json` is.
        // But this is a test application inside a bundle. So points to `tests/App`.
        // An implemenation for this is already provided in `Kernel`, but here we provide a more simple solution.
        return __DIR__;
    }

    #[\Override]
    public function getCacheDir(): string
    {
        // Since this is a test application inside a bundle, points to `var/cache` (at the root of the bundle)
        return __DIR__.'/../../var/cache/'.$this->environment;
    }

    #[\Override]
    public function getLogDir(): string
    {
        // Since this is a test application inside a bundle, points to `var/cache` (at the root of the bundle)
        return __DIR__.'/../../var/logs';
    }
}
