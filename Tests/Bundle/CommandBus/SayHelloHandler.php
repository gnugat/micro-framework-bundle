<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Tests\Bundle\CommandBus;

class SayHelloHandler
{
    /**
     * @param SayHello $sayHello
     *
     * @return string
     */
    public function handle(SayHello $sayHello)
    {
        return "Hello {$sayHello->name}!";
    }
}
