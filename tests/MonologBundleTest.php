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
use Symfony\Component\HttpFoundation\Request;
use tests\Gnugat\MicroFrameworkBundle\App\AppKernel;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Service\MonologTester;

class MonologBundleTest extends TestCase
{
    private const LOG = 'Monolog is working';

    private AppKernel $kernel;

    protected function setUp(): void
    {
        $this->kernel = new AppKernel('test', false);
        $this->kernel->boot();
    }

    /**
     * @test
     */
    public function it_has_logger(): void
    {
        $monologTester = $this->kernel->getContainer()->get(
            MonologTester::class
        );

        self::assertTrue($monologTester->hasMonolog());
    }

    /**
     * @test
     */
    public function it_can_log(): void
    {
        $monologTester = $this->kernel->getContainer()->get(
            MonologTester::class
        );
        $monologTester->log(self::LOG);

        self::assertSame(self::LOG, $monologTester->getLog());
    }
}
