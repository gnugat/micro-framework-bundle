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

use Gnugat\MicroFrameworkBundle\Tests\CustomBundle\CommandBus\SayHello;
use Symfony\Component\HttpFoundation\Request;

class TacticianBundleTest extends \PHPUnit_Framework_TestCase
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
    public function it_has_command_bus()
    {
        self::assertTrue($this->kernel->getContainer()->has('tactician.commandbus'));
    }

    /**
     * @test
     */
    public function it_can_handle_commands()
    {
        $this->kernel->getContainer()->get('tactician.commandbus')->handle(new SayHello(
            'Igor'
        ));

        self::assertTrue(true, 'Failed to handle command');
    }
}
