# CHANGELOG

## 0.5.0: Cache clear & warmup

* added `cache:warmup` command
* added `cache:clear` command

## 0.4.0: Commands

* added support for `ContainerAwareCommand`
* added support for `Command` not registered as services

> **BC breaks**:
>
> * `Gnugat\MicroFrameworkBundle\Console\KernelApplication` has been
>   moved to `Gnugat\MicroFrameworkBundle\Service\KernelApplication`

## 0.3.0: Console

* added support for `console.command` tag
* added `KernelApplication`

## 0.2.0: Supported Bundles

* added support for `league/tactician-bundle`
* added support for `symfony/monolog-bundle`

## 0.1.0: HttpKernel
