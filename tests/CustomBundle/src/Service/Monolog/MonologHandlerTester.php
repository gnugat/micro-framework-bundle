<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Service\Monolog;

use Monolog\Handler\Handler;

class MonologHandlerTester extends Handler
{
    private const NO_LOG = '';

    private $log = self::NO_LOG;

    public function isHandling(array $record): bool
    {
        return true;
    }

    public function handle(array $record): bool
    {
        $this->log = $record['message'];

        return true;
    }

    public function handleBatch(array $records): void
    {
    }

    public function close(): void
    {
        $this->log = self::NO_LOG;
    }

    public function getLog(): string
    {
        return $this->log;
    }
}
