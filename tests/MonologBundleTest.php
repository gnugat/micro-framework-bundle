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

use Gnugat\MicroFrameworkBundle\Tests\Bundle\CommandBus\SayHello;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use tests\Gnugat\MicroFrameworkBundle\App\AppKernel;

class MonologBundleTest extends TestCase
{
    private $kernel;

    protected function setUp()
    {
        $this->kernel = new AppKernel('test', false);
        $this->kernel->boot();
    }

    /**
     * @test
     */
    public function it_has_logger()
    {
        self::assertTrue($this->kernel->getContainer()->has('is_monolog_bundle_registered'));
    }

    /**
     * @test
     */
    public function it_can_log()
    {
        $this->kernel->getContainer()->get('is_monolog_bundle_registered')->debug('Checked logger');

        self::assertTrue(true, 'Failed to log');
    }
}
