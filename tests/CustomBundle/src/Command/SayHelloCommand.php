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

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHello;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHelloHandler;

class SayHelloCommand extends Command
{
    public function __construct(
        private SayHelloHandler $sayHelloHandler,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('say-hello');
        $this->addArgument(
            'name',
            InputArgument::OPTIONAL,
            'Who should we say hello to?',
            'World',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = $this->sayHelloHandler->handle(new SayHello(
            $input->getArgument('name'),
        ));

        $output->writeln($message);

        return Command::SUCCESS;
    }
}
