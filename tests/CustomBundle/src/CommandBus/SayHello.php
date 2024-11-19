<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus;

class SayHello
{
    public function __construct(
        public mixed $name,
    ) {
        if (null === $name) {
            $name = 'world';
        }
        $this->name = $name;
    }
}
