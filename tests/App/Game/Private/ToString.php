<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\App\Game\Private;

/**
 * This service tests autowiring, as a private service.
 */
class ToString
{
    public function __invoke(mixed $value): string
    {
        return (string) $value;
    }
}
