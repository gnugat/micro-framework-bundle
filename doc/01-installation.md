# Installation

`MicroFrameworkBundle` can be installed in new and existing applications.

Here's how to create a new Symfony project, using the Empy Edition:

```
composer create-project gnugat/symfony-empty-edition
cd symfony-empty-edition
```

Or alternatively, using Symfony Flex:

```
symfony new my_project_directory
cd my_project_directory
```

Now we need to replace `FrameworkBundle` by `MicroFrameworkBundle`, first in the
composer dependencies:

```
composer require 'gnugat/micro-framework-bundle'
composer remove --update-with-dependencies 'symfony/framework-bundle'
```

> **Note**: With Symfony Flex, the `symfony/symfony` global package is installed,
> and it contains the `symfony/framework-bundle package`.

Then in the `config/bundles.php` file by replacing:

- `Symfony\Bundle\FrameworkBundle\FrameworkBundle`
- with `Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle`

Next, the `framework` configuration key needs to be removed:

- from `config/services.yml`
- or in `config/packages/`

Finally in the `bin/console` file, replace:

- `Symfony\Bundle\FrameworkBundle\Console\Application`
- with `Gnugat\MicroFrameworkBundle\Service\KernelApplication as Application`.

Make sure to try and debug your application after that:

1. remove the cache `rm -rf var/cache`
2. try to run the console: `bin/console`
3. try to browse pages
4. run your tests

If any step fails, then:

* check if there's any configuration to remove
* check if it's a bundle issue and if so if we can remove it
