<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle;

use PHPUnit\Framework\TestCase;
use tests\Gnugat\MicroFrameworkBundle\App\AppKernel;

class ServiceTest extends TestCase
{
    private AppKernel $kernel;

    protected function setUp(): void
    {
        $this->kernel = new AppKernel('test', false);
        $this->kernel->boot();
    }

    /**
     * @test
     */
    public function it_provides_event_dispatcher(): void
    {
        self::assertTrue(
            $this->kernel->getContainer()->has('event_dispatcher'),
        );
    }

    /**
     * @test
     */
    public function it_provides_http_kernel(): void
    {
        self::assertTrue(
            $this->kernel->getContainer()->has('http_kernel'),
        );
    }

    /**
     * @test
     */
    public function it_provides_request_stack(): void
    {
        self::assertTrue(
            $this->kernel->getContainer()->has('request_stack'),
        );
    }
}
