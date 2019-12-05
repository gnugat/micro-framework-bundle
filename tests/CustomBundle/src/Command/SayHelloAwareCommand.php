<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Command;

use Gnugat\MicroFrameworkBundle\Console\ExitCode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHello;

class SayHelloAwareCommand extends Command implements ContainerAwareInterface
{
    private const EXIT_SUCCESS = 0;

    use ContainerAwareTrait;

    protected function configure()
    {
        $this->setName('say-hello-aware');
        $this->addArgument('name', InputArgument::OPTIONAL, 'Who should we say hello to?', 'World');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = $this->container->get(
            'tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHelloHandler'
        )->handle(new SayHello($input->getArgument('name')));

        $output->writeln($message);

        return ExitCode::SUCCESS;
    }
}
