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

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use tests\Gnugat\MicroFrameworkBundle\App\AppKernel;

class ApplicationTest extends TestCase
{
    private AppKernel $kernel;

    protected function setUp(): void
    {
        $this->kernel = new AppKernel('test', false);
        $this->kernel->boot();
    }

    #[Test]
    public function it_can_load_app_controllers_using_route_attribute(): void
    {
        $request = Request::create('/fizz-buzz?index=15');

        $response = $this->kernel->handle($request);

        self::assertSame(
            200,
            $response->getStatusCode(),
            $response->getContent(),
        );
    }
}
