<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Command;

use Gnugat\MicroFrameworkBundle\Console\ExitCode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class CacheClearCommand extends Command
{
    public function __construct(
        private CacheClearerInterface $cacheClearer,
        private string $cacheDir,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('cache:clear');
        $this->setDescription('Clears the cache');
        $this->setHelp(<<<'HELP'
Executes all <info>CacheClearerInterface</info> implementations registered with the <info>kernel.cache_clearer</info> tag.
It will for example remove the cache directry.

After running it, you might want to warm up the cache:

    php bin/console cache:clear
    php bin/console cache:warmup
HELP
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Clearing the cache (<info>{$this->cacheDir}</info>)");

        $this->cacheClearer->clear($this->cacheDir);

        $io->success('Cache cleared');

        return ExitCode::SUCCESS;
    }
}
