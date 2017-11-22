<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'router_listener' shared service.

$a = ($this->services['kernel'] ?? $this->get('kernel'));

$b = new \Symfony\Component\HttpKernel\Config\FileLocator($a, ($this->targetDirs[2].'/Resources'));

$c = new \Symfony\Component\Config\Loader\LoaderResolver();
$c->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($b));
$c->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($b));
$c->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($b));
$c->addLoader(new \Symfony\Component\Routing\Loader\DirectoryLoader($b));
$c->addLoader(new \Symfony\Component\Routing\Loader\DependencyInjection\ServiceRouterLoader($this));

$d = new \Symfony\Component\Routing\RequestContext();

$e = new \Symfony\Component\Routing\Router(new \Symfony\Component\Config\Loader\DelegatingLoader($c), ($this->targetDirs[2].'/config/routings'), $this->getParameter('router.options'), $d);
$e->setConfigCacheFactory(new \Symfony\Component\Config\ResourceCheckerConfigCacheFactory());

return $this->privates['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($e, ($this->services['request_stack'] ?? $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()), $d);
