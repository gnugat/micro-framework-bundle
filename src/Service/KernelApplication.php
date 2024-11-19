<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Service;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelInterface;

class KernelApplication extends Application
{
    private bool $commandsRegistered = false;
    private array $registrationErrors = [];

    public function __construct(
        private KernelInterface $kernel,
    ) {
        parent::__construct('Micro Symfony', Kernel::VERSION);

        $this->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', $kernel->getEnvironment()));
        $this->getDefinition()->addOption(new InputOption('--no-debug', null, InputOption::VALUE_NONE, 'Switches off debug mode.'));
    }

    public function getKernel(): KernelInterface
    {
        return $this->kernel;
    }

    #[\Override]
    public function doRun(InputInterface $input, OutputInterface $output): int
    {
        $this->kernel->boot();

        $this->setDispatcher($this->kernel->getContainer()->get('event_dispatcher'));

        if ($this->registrationErrors) {
            $this->renderRegistrationErrors($input, $output);
        }

        return parent::doRun($input, $output);
    }

    #[\Override]
    public function find(string $name): Command
    {
        $this->registerCommands();

        return parent::find($name);
    }

    #[\Override]
    public function get(string $name): Command
    {
        $this->registerCommands();

        $command = parent::get($name);

        return $command;
    }

    #[\Override]
    public function all(?string $namespace = null): array
    {
        $this->registerCommands();

        return parent::all($namespace);
    }

    #[\Override]
    public function add(Command $command): ?Command
    {
        $this->registerCommands();

        return parent::add($command);
    }

    private function registerCommands(): void
    {
        if ($this->commandsRegistered) {
            return;
        }

        $this->commandsRegistered = true;

        $this->kernel->boot();

        $container = $this->kernel->getContainer();

        foreach ($this->kernel->getBundles() as $bundle) {
            if ($bundle instanceof Bundle) {
                try {
                    $bundle->registerCommands($this);
                } catch (\Exception $e) {
                    $this->registrationErrors[] = $e;
                } catch (\Trowable $e) {
                    $this->registrationErrors[] = new FatalThrowableError($e);
                }
            }
        }

        if ($container->has('console.command_loader')) {
            $this->setCommandLoader($container->get('console.command_loader'));
        }

        if ($container->hasParameter('console.command.ids')) {
            $lazyCommandIds = [];
            if ($container->hasParameter('console.lazy_command.ids')) {
                $lazyCommandIds = $container->getParameter('console.lazy_command.ids');
            }
            foreach ($container->getParameter('console.command.ids') as $id) {
                if (!isset($lazyCommandIds[$id])) {
                    try {
                    } catch (\Exception $e) {
                        $this->registrationErrors[] = $e;
                    } catch (\Throwable $e) {
                        $this->registrationErrors[] = new FatalThrowableError($e);
                    }
                }
            }
        }
    }

    private function renderRegistrationErrors(InputInterface $input, OutputInterface $output): void
    {
        if ($output instanceof ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }

        (new SymfonyStyle($input, $output))->warning('Some commands could not be registered:');

        foreach ($this->registrationErrors as $error) {
            $this->doRenderException($error, $output);
        }

        $this->registrationErrors = [];
    }
}
