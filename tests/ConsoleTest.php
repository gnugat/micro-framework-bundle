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

use Gnugat\MicroFrameworkBundle\Console\ExitCode;
use Gnugat\MicroFrameworkBundle\Service\KernelApplication;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\ApplicationTester;
use tests\Gnugat\MicroFrameworkBundle\App\AppKernel;

class ConsoleTest extends TestCase
{
    private $app;

    protected function setUp(): void
    {
        $kernel = new AppKernel('test', false);
        $application = new KernelApplication($kernel);
        $application->setAutoExit(false);
        $this->app = new ApplicationTester($application);
    }

    /**
     * @test
     */
    public function it_runs_commands()
    {
        $input = [
            'say-hello',
            'name' => 'Igor',
        ];

        $statusCode = $this->app->run($input);

        self::assertSame(
            ExitCode::SUCCESS,
            $statusCode,
            $this->app->getDisplay()
        );
    }

    /**
     * @test
     */
    public function it_runs_container_aware_commands()
    {
        $input = [
            'say-hello-aware',
            'name' => 'Igor',
        ];

        $statusCode = $this->app->run($input);

        self::assertSame(
            ExitCode::SUCCESS,
            $statusCode,
            $this->app->getDisplay()
        );
    }
}
