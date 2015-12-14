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

class ThirdPartyBundleTest extends \PHPUnit_Framework_TestCase
{
    private $container;

    protected function setUp()
    {
        $kernel = new \AppKernel('test', false);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }

    /**
     * @test
     */
    public function it_can_load_bundle_services()
    {
        $myService = $this->container->get('app.my_service');

        $this->assertInstanceOf('Gnugat\MicroFrameworkBundle\Tests\Bundle\Service\MyService', $myService);
    }
}
