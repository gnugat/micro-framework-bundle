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

use Gnugat\MicroFrameworkBundle\Console\KernelApplication;
use Symfony\Component\Console\Tester\ApplicationTester;

class ConsoleTest extends \PHPUnit_Framework_TestCase
{
    private $app;

    protected function setUp()
    {
        $kernel = new \AppKernel('test', false);
        $application = new KernelApplication($kernel);
        $application->setAutoExit(false);
        $this->app = new ApplicationTester($application);
    }

    /**
     * @test
     */
    public function it_runs_commands()
    {
        $input = array(
            'say-hello',
            'name' => 'Igor',
        );

        $statusCode = $this->app->run($input);

        self::assertSame(0, $statusCode, $this->app->getDisplay());
    }
}
