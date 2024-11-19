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

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

class CacheWarmupCommand extends Command
{
    public function __construct(
        private CacheWarmerInterface $cacheWarmer,
        private string $cacheDir,
    ) {
        parent::__construct();
    }

    #[\Override]
    protected function configure(): void
    {
        $this->setName('cache:warmup');
        $this->setDescription('Warms up an empty cache');
        $this->setHelp(<<<'HELP'
            Executes all <info>CacheWarmerInterface</info> implementations registered with the <info>kernel.cache_warmer</info> tag.
            It will for example create an optimized <info>UrlMatcherInterface</info> and <info>UrlGeneratorInterface</info>.

            To run it, make sure the cache is empty first:

                php bin/console cache:clear
                php bin/console cache:warmup

            HELP
        );
    }

    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Warming up the cache (<info>{$this->cacheDir}</info>)");

        $this->cacheWarmer->warmup($this->cacheDir);

        $io->success('Cache warmed up');

        return Command::SUCCESS;
    }
}
