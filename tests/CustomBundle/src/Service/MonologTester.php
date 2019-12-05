<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Service;

use Monolog\Logger;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Service\Monolog\MonologHandlerTester;

class MonologTester
{
    private $logger;
    private $monologHandlerTester;

    public function __construct(
        Logger $logger,
        MonologHandlerTester $monologHandlerTester
    ) {
        $this->logger = $logger;
        $this->monologHandlerTester = $monologHandlerTester;
    }

    public function hasMonolog(): bool
    {
        return $this->logger instanceof Logger;
    }

    public function log(string $message): void
    {
        $this->logger->log(Logger::DEBUG, $message);
    }

    public function getLog(): string
    {
        return $this->monologHandlerTester->getLog();
    }
}
