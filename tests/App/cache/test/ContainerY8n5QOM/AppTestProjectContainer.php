<?php

namespace ContainerY8n5QOM;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/*
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class AppTestProjectContainer extends Container
{
    private $parameters;
    private $targetDirs = array();
    private $privates = array();

    public function __construct()
    {
        $dir = $this->targetDirs[0] = dirname(__DIR__);
        for ($i = 1; $i <= 5; ++$i) {
            $this->targetDirs[$i] = $dir = dirname($dir);
        }
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = array();
        $this->syntheticIds = array(
            'kernel' => true,
        );
        $this->fileMap = array(
            'cache_clear_command' => __DIR__.'/getCacheClearCommandService.php',
            'cache_warmup_command' => __DIR__.'/getCacheWarmupCommandService.php',
            'console.command_loader' => __DIR__.'/getConsole_CommandLoaderService.php',
            'event_dispatcher' => __DIR__.'/getEventDispatcherService.php',
            'http_kernel' => __DIR__.'/getHttpKernelService.php',
            'logger' => __DIR__.'/getLoggerService.php',
            'request_stack' => __DIR__.'/getRequestStackService.php',
            'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\CommandBus\\SayHelloHandler' => __DIR__.'/getSayHelloHandlerService.php',
            'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Command\\SayHelloAwareCommand' => __DIR__.'/getSayHelloAwareCommandService.php',
            'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Command\\SayHelloCommand' => __DIR__.'/getSayHelloCommandService.php',
            'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Controller\\MyController' => __DIR__.'/getMyControllerService.php',
            'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Service\\MyService' => __DIR__.'/getMyServiceService.php',
        );

        $this->aliases = array();
    }

    public function reset()
    {
        $this->privates = array();
        parent::reset();
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function getRemovedIds()
    {
        return require __DIR__.'/removed-ids.php';
    }

    protected function load($file, $lazyLoad = true)
    {
        return require $file;
    }

    public function getParameter($name)
    {
        $name = (string) $name;

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
        $name = (string) $name;

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = array(
        'kernel.root_dir' => false,
        'kernel.project_dir' => false,
        'kernel.cache_dir' => false,
        'kernel.logs_dir' => false,
        'kernel.bundles_metadata' => false,
        'router.options' => false,
        'router.resource' => false,
    );
    private $dynamicParameters = array();

    /*
     * Computes a dynamic parameter.
     *
     * @param string The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        switch ($name) {
            case 'kernel.root_dir': $value = $this->targetDirs[2]; break;
            case 'kernel.project_dir': $value = $this->targetDirs[4]; break;
            case 'kernel.cache_dir': $value = $this->targetDirs[0]; break;
            case 'kernel.logs_dir': $value = ($this->targetDirs[2].'/logs'); break;
            case 'kernel.bundles_metadata': $value = array(
                'GnugatMicroFrameworkBundle' => array(
                    'path' => ($this->targetDirs[4].'/src'),
                    'namespace' => 'Gnugat\\MicroFrameworkBundle',
                ),
                'GnugatCustomBundle' => array(
                    'path' => ($this->targetDirs[3].'/CustomBundle/src'),
                    'namespace' => 'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src',
                ),
                'MonologBundle' => array(
                    'path' => ($this->targetDirs[4].'/vendor/symfony/monolog-bundle'),
                    'namespace' => 'Symfony\\Bundle\\MonologBundle',
                ),
            ); break;
            case 'router.options': $value = array(
                'cache_dir' => $this->targetDirs[0],
                'debug' => false,
                'resource_type' => 'directory',
                'generator_cache_class' => 'AppTestUrlGenerator',
                'matcher_cache_class' => 'AppTestUrlMatcher',
            ); break;
            case 'router.resource': $value = ($this->targetDirs[2].'/config/routings'); break;
            default: throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
        }
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
    }

    /*
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.environment' => 'test',
            'kernel.debug' => false,
            'kernel.name' => 'App',
            'kernel.bundles' => array(
                'GnugatMicroFrameworkBundle' => 'Gnugat\\MicroFrameworkBundle\\GnugatMicroFrameworkBundle',
                'GnugatCustomBundle' => 'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\GnugatCustomBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'AppTestProjectContainer',
            'router.resource_type' => 'directory',
            'router.cache_class_prefix' => 'AppTest',
            'monolog.use_microseconds' => true,
            'monolog.swift_mailer.handlers' => array(

            ),
            'monolog.handlers_to_channels' => array(
                'monolog.handler.main' => NULL,
            ),
            'console.command.ids' => array(
                'console.command.gnugat_microframeworkbundle_command_cacheclearcommand' => 'cache_clear_command',
                'console.command.gnugat_microframeworkbundle_command_cachewarmupcommand' => 'cache_warmup_command',
                'console.command.tests_gnugat_microframeworkbundle_custombundle_src_command_sayhellocommand' => 'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Command\\SayHelloCommand',
                'console.command.tests_gnugat_microframeworkbundle_custombundle_src_command_sayhelloawarecommand' => 'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Command\\SayHelloAwareCommand',
            ),
            'console.lazy_command.ids' => array(
                'cache_clear_command' => true,
                'cache_warmup_command' => true,
                'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Command\\SayHelloCommand' => true,
                'tests\\Gnugat\\MicroFrameworkBundle\\CustomBundle\\src\\Command\\SayHelloAwareCommand' => true,
            ),
        );
    }
}
