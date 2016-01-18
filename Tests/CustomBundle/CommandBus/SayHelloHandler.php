<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Tests\CustomBundle\CommandBus;

use Psr\Log\LoggerInterface;

class SayHelloHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param SayHello $sayHello
     *
     * @return string
     */
    public function handle(SayHello $sayHello)
    {
        $this->logger->debug('Said hello', array(
            'name' => $sayHello->name,
        ));

        return "Hello {$sayHello->name}!";
    }
}
