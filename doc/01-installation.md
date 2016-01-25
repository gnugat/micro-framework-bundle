# Installation

`MicroFrameworkBundle` can be installed in new applications as well as existing
ones.

We're going to review first the Empty Edition, then the Standard Edition and
we'll see what we need to consider for existing applications.

## Empty Edition

[Symfony](http://symfony.com) applications can be created using distributions,
for example the [Empty Edition](http://github.com/gnugat/symfony-empty-edition):

```
composer create-project gnugat/symfony-empty-edition
cd symfony-empty-edition
```

Then we need to replace `FrameworkBundle` by `MicroFrameworkBundle`, first in the
composer dependencies:

```
composer require 'gnugat/micro-framework-bundle'
composer remove --update-with-dependencies 'symfony/framework-bundle'
```

Then in the `app/AppKernel.php` file by replacing `Symfony\Bundle\FrameworkBundle\FrameworkBundle`
with `Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle`.

Next, the `framework` configuration key needs to be removed from `app/config/config.yml`.

Finally, in the `bin/console` file
replace `Symfony\Bundle\FrameworkBundle\Console\Application`
with `Gnugat\MicroFrameworkBundle\Service\KernelApplication as Application`.

## Standard Edition

There's an official distribution: [Standard Edition](https://github.com/symfony/symfony-standard).
It provides pre-installed libraries, but it can be installed in the same manner:

```
composer create-project symfony/framework-standard-edition
cd framework-standard-edition
composer require 'gnugat/micro-framework-bundle'
```

Then we need to clean `app/AppKernel.php` file by removing the following bundles:

* `Symfony\Bundle\FrameworkBundle\FrameworkBundle`
* `Doctrine\Bundle\DoctrineBundle\DoctrineBundle` (depends on FrameworkBundle specific console Application)
* `Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle` (depends on annotations)
* `Symfony\Bundle\TwigBundle\TwigBundle` (depends on assets)
* `Symfony\Bundle\WebProfilerBundle\WebProfilerBundle` (depends on data collectors)

Don't forget to add `Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle`.

Next remove configuration for the following keys in `app/config/config*.yml`:

* `framework`
* `doctrine` (as well as `database_*` parameters)
* `web_profiler`
* `twig`

Extra steps are required for routing:

1. create a `app/config/routings` directory
2. move `app/config/routing.yml` to `app/config/routings/app.yml`
3. switch from annotation to YAML routing configuration in `app/config/routings/app.yml`:
   ```
   homepage:
    path: /
    defaults:
        _controller: app.default_controller:indexAction
    methods:
        - GET
   ```
4. configure `AppBundle\Controller\DefaultController` as a service in `app/config/services.yml`:
    ```
    services:
        app.default_controller:
            class: AppBundle\Controller\DefaultController
    ```
5. remove `FrameworkBundle` classes from `src/AppBundle/Controller/DefaultController.php`:
    ```php
    <?php

    namespace AppBundle\Controller;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class DefaultController
    {
        public function indexAction(Request $request)
        {
            return new Response('Hello world');
        }
    }
    ```
6. remove `app/config/routing_dev.yml`

Finally, in the `bin/console` file
replace `Symfony\Bundle\FrameworkBundle\Console\Application`
with `Gnugat\MicroFrameworkBundle\Console\KernelApplication as Application`.

> **Note**: Since `symfony/symfony` is specified as a requirement in `composer.json`,
> `FrameworkBundle` and the removed bundles are still present in the vendors.
> To get rid of them, specificy instead the actual list of component and bundles.

## Existing Applications

Replacing `FrameworkBundle` with `MicroFrameworkBundle` might be tricky. Here's
a small guide on how to do so.

The first step is to make sure everything is saved, in case we might need to rollback.
With git we can commit everything or statsh them.

Then we need to install the bundle:

```
composer require 'gnugat/micro-framework-bundle'
```

And register it in `app/AppKernel.php` by replacing `FrameworkBundle`.

The next steps are iterations of "try and debug":

1. remove the cache `rm -rf var/cache`
2. try to run the console: `bin/console`
3. try to browse pages
4. run your tests

If any step fails, then:

* check if there's any configuration to remove
* check if it's a bundle issue and if so if we can remove it
