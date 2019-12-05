<?php

namespace Gnugat\MicroFrameworkBundle\Command;

use Gnugat\MicroFrameworkBundle\Console\ExitCode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

class CacheWarmupCommand extends Command
{
    private $cacheWarmer;
    private $cacheDir;

    public function __construct(CacheWarmerInterface $cacheWarmer, $cacheDir)
    {
        $this->cacheWarmer = $cacheWarmer;
        $this->cacheDir = $cacheDir;
        parent::__construct();
    }

    protected function configure()
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Warming up the cache (<info>{$this->cacheDir}</info>)");

        $this->cacheWarmer->warmup($this->cacheDir);

        $io->success('Cache warmed up');

        return ExitCode::SUCCESS;
    }
}
