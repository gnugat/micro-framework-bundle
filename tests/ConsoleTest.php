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

use Gnugat\MicroFrameworkBundle\Service\KernelApplication;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\ApplicationTester;
use tests\Gnugat\MicroFrameworkBundle\App\AppKernel;

class ConsoleTest extends TestCase
{
    private ApplicationTester $app;

    protected function setUp(): void
    {
        $kernel = new AppKernel('test', false);
        $application = new KernelApplication($kernel);
        $application->setAutoExit(false);
        $this->app = new ApplicationTester($application);
    }

    #[Test]
    public function it_runs_commands(): void
    {
        $input = [
            'say-hello',
            'name' => 'Igor',
        ];
        $statusCode = $this->app->run($input);

        self::assertSame(
            Command::SUCCESS,
            $statusCode,
            $this->app->getDisplay(),
        );
    }
}
