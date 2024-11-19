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

use Psr\Log\LoggerInterface;

class SayHelloHandler
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function handle(SayHello $sayHello): string
    {
        $this->logger->debug('Said hello', [
            'name' => $sayHello->name,
        ]);

        return "Hello {$sayHello->name}!";
    }
}
