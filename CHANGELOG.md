# CHANGELOG

## 09.4: dropped controller methord arguments

* controller methods now can only receive a Request argument

## 0.9.3: fixed missing logger

* removed `ContainerControllerResolver`'s dependency on `@logger`
  (we don't have a logger set up, by default)

## 0.9.2: autowiring

* added support for autowiring (including Controller as autowired services)

## 0.9.1: routing attributes

* added support for routing attributes (`#[Route()]`)

## 0.9.0: Symfony 7 support

* Upgraded support to Symfony 6
* Upgraded support to PHP 8.2 (accordingly with Symfony 7)
* Upgraded tests to PHPUnit 11

- Removed ExitCode (use Symfony\Component\Console\Command constants instead)
- Removed support for `ContainerAwareCommand`, as it's been removed from Symfony 7

## 0.8.0: Symfony 6 support

* Upgraded support to Symfony 6
* Upgraded support to PHP 8.0 (accordingly with Symfony 6)
* Upgraded tests to PHPUnit 9
* Added PHP CS Fixer for development purposes

## 0.7.0: Symfony 5 support

* Upgraded support to Symfony 5
* Upgraded support to PHP 7.2 (accordingly with Symfony 5)
* Upgraded tests to PHPUnit 8
* added `Gnugat\MicroFrameworkBundle\Console\ExitCode`

> **BC breaks**:
>
> * dropped support for Symfony 4
> * dropped support for `league/tactician-bundle`
> * dropped support for PHP 7.1 (accordingly with Symfony 5)

## 0.6.0: Symfony 4 support

## 0.5.2: OS X cache clear

* Used `Filesystem` to make cache clear compatible with OS X (thanks @Edwin-Luijten)

## 0.5.1: Get Kernel

* added `getKernel()` to `KernelApplication` (thanks @Edwin-Luijten)

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
