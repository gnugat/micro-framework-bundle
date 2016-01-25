# Symfony Micro Framework Bundle

A replacement of the official FrameworkBundle allowing Symfony to be used as a
micro-framework which follows the "add what you need" philosophy.

## Installation

First install it using [Composer](https://getcomposer.org/download):

    composer require gnugat/micro-framework-bundle:^0.4

Then enable it in your application's kernel (e.g. `app/AppKernel.php`):

    new Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle()

[More information](doc/01-installation.html)

## Features

* compatible with most third party bundles, [more information](doc/02-compatibility.md)
* micro framework spirit, including:
    * "add what you need" philosohpy
    * few dependencies
    * small API
    * small footprint for better performance
    * [more information](doc/03-benchmark.md)

## Want to know more?

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/micro-framework-bundle/releases)
* the file listing the [changes between versions](CHANGELOG.md)

And finally some meta documentation:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)

> **Note**: Some logic has been taken from Symfony FrameworkBundle and modified,
> all attributions go to Fabien Potencier and the contributors.
