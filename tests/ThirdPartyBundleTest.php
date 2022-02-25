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
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Service\MyService;

class ThirdPartyBundleTest extends TestCase
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
    public function it_can_load_bundle_services(): void
    {
        self::assertTrue($this->kernel->getContainer()->has(
            MyService::class
        ));
    }

    /**
     * @test
     */
    public function it_can_load_bundle_controllers(): void
    {
        $request = Request::create('/?name=igor');

        $response = $this->kernel->handle($request);

        self::assertSame(
            200,
            $response->getStatusCode(),
            $response->getContent()
        );
    }
}
