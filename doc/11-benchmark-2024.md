# Benchmark - 2024

> **TD;DR**: [Symfony](http://symfony.com) has always been able to be used as a micro framework.
> For more "add what you need" micro-framework like spirit, use the [Empty Edition](http://github.com/gnugat/symfony-empty-edition)
> and the [MicroFrameworkBundle](http://github.com/gnugat/micro-framework-bundle).

There are many definitions out there to qualify a framework as being "micro", among
them the following criterias often appear:

* small API (usage of framework's code in your application)
* few Lines Of Code (LOC)
* few dependencies (how many third party libraries are used)
* small footprint (framework loading time)

Is Symfony a micro framework as well? Let's find out.

> **Note**: To know more about how to determine if a framework is micro, read
> [Igor Wiedler](https://igor.io/archive.html) article: [How heavy is Silex?](https://igor.io/2013/09/02/how-heavy-is-silex.html).

## Measuring

While "Hello World" examples rarely reflect real world applications, it's going
to be good enough to serve the purpose of this article: getting a good measure of
Symfony's API, LOC, dependencies and footprint.

Since dependencies and footprint are easy to measure, we're going to rely on it.
However, all benchmarks are relative to the computer that executes them, so we need
a point of reference: a flat PHP "Hello World" application:

```php
<?php
// index.php

echo 'Hello World';
```

Let's run the benchmark:

```
php -S localhost:2501 &
ab -t 10 'http://localhost:2501/index.php'
killall php
```

Result: **1 188.73** Requests per second.

## Symfony Flex

Let's use Symfony Flex to create a new application:

```console
symfony new my_project_directory --version="7.1.*"
cd my_project_directory
```

> Note: we're not installing a "webapp" application, as this would install even more packages.
> The purpose here is to see what an official barebone symfony app compares to a custom stripped down version.

The official Symfony application follows a "solve 80% of use cases out of the box" philosohpy,
it's almost ready, we just need to tweak the given controller:

```php
<?php
// src/App/Controller/DefaultController.php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    #[Route('/hello-world', name: 'app_hello_world')]
    public function index(Request $request)
    {
        return new Response('Hello World');
    }
}
```

Let's run the benchmark:

```
composer update -o --no-dev
php bin/console cache:clear --env=prod --no-debug
php -S localhost:2502 -t public &
ab -t 10 'http://localhost:2502/index.php/hello-world'
killall php
```

Result: **39.12** Requests per second.

We're also going to list the dependencies:

```
find vendor -mindepth 2 -maxdepth 2 -type d | wc -l
```

We get 31, so to sum up:

* API: 1 step to add a new route
* footprint: 30x slower than flat PHP
* size: 31 dependencies

## Empty Edition

As stated above, Symfony Flex has a "solve 80% of use cases out of the box"
philosophy, so it comes with many dependencies that might not fit our use. Micro
framework usually follow a "add what you need philosophy", which is exactly what
the Empty Edition is all about.

Let's see if we can get more micro with it:

```
composer create-project gnugat/symfony-empty-edition
cd symfony-empty-edition
```

The first step is to create a controller:

```php
<?php
// src/App/Controller/HelloController.php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    #[Route('/hello-world', name: 'app_hello_world')]
    public function world(Request $request)
    {
        return new Response('Hello World');
    }
}
```

Let's run the benchmark:

```
composer update -o --no-dev
bin/console cache:clear -e prod --no-debug
php -S localhost:2503 -t web &
ab -t 10 'http://localhost:2503/app.php/hello-world'
killall php
```

Result: **63.52** Requests per second.

We're also going to list the dependencies:

```
find vendor -mindepth 2 -maxdepth 2 -type d | wc -l
```

We get 29.

So to sum up:

* API: 1 step to add a new route
* footprint: 18x slower than flat PHP
* size: 29 dependencies

## Micro Framework Bundle

By reducing the number of dependencies, we also drastically reduced the framework
footprint. This is not surprising as:

* we've reduced the number of classes to autoload
* we've reduced the number of configuration (parameters and service definition) to set up
* we've reduced the bootload time of the Dependency Injection Container (less services to instantiate)
* we've reduced the number of event listeners called

Can we go further? Certainly: the FrameworkBundle also follows a
"solve 80% of use cases out of the box" (includes Forms, Security, Templating, Translation, Assets, annotations, etc).

By using a MicroFrameworkBundle that would provide the strict minimum and follow
the micro framework philosophy of "add what you need" we can surely reduce further
the number of dependencies. Hence `gnugat/micro-framework-bundle`:

```
composer require 'gnugat/micro-framework-bundle'
composer remove 'symfony/framework-bundle'
```

Then we need to swap the Framework bundles in `config/bundles.php:

```php
<?php

return [
    \Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle::class => ['all' => true],
];
```

Next we need to update the console:

```php
#!/usr/bin/env php
<?php
// bin/console

set_time_limit(0);

require_once __DIR__.'/../app/autoload.php';

use Gnugat\MicroFrameworkBundle\Service\KernelApplication as Application;
use Symfony\Component\Console\Input\ArgvInput;

$input = new ArgvInput();
$env = $input->getParameterOption(array('--env', '-e'), 'dev');
$debug = !$input->hasParameterOption(array('--no-debug', '')) && $env !== 'prod';

$kernel = new AppKernel($env, $debug);
$application = new Application($kernel);
$application->run($input);
```

Finally we can get rid of all `framework` configuration in the file `config/services.yaml`.

Let's benchmark our trimmed application:

```
rm -rf var/*
composer update -o --no-dev
bin/console cache:clear -e prod --no-debug
php -S localhost:2504 -t web &
ab -t 10 'http://localhost:2504/app.php/hello-world'
killall php
```

Result: **85.81** Requests per second.

We're also going to list the dependencies:

```
find vendor -mindepth 2 -maxdepth 2 -type d | wc -l
```

We get 26.

So to sum up:

* API: 1 step to add a new route
* footprint: 14x slower than flat PHP
* size: 26 dependencies

## Conclusion

Symfony has always been able to be used as a micro framework bundle.

The [Official micro installation](https://symfony.com/doc/current/setup.html) and the
[FrameworkBundle](https://github.com/symfony/symfony/tree/master/src/Symfony/Bundle/FrameworkBundle)
follow a "solve 80% of use cases out of the box" philosohpy, which is better for new comers.

However for experimented developers who're looking for a "add what you need" philosophy,
which is what micro-framework usually follow, using the [Empty Edition](http://github.com/gnugat/symfony-empty-edition)
and [MicroFrameworkBundle](http://github.com/gnugat/micro-framework-bundle) can
be a viable alternative (they are slimer in term of dependencies and faster).

> **Note**: At the time of writing, MicroFrameworkBundle is still under development
> (version `0.9.3`). Use it at your own risk and contribute to it :) .
