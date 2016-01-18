<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Tests;

use Gnugat\MicroFrameworkBundle\Tests\Bundle\CommandBus\SayHello;
use Symfony\Component\HttpFoundation\Request;

class MonologBundleTest extends \PHPUnit_Framework_TestCase
{
    private $kernel;

    protected function setUp()
    {
        $this->kernel = new \AppKernel('test', false);
        $this->kernel->boot();
    }

    /**
     * @test
     */
    public function it_has_logger()
    {
        self::assertTrue($this->kernel->getContainer()->has('logger'));
    }

    /**
     * @test
     */
    public function it_can_log()
    {
        $this->kernel->getContainer()->get('logger')->debug('Checked logger');

        self::assertTrue(true, 'Failed to log');
    }
}
