# Compatibility

> **TL;DR**: Bundles that only integrate libraries are recommended.

[Symfony](http://symfony.com) has a large community which is very keen at contributing,
resulting in a considerable number of bundles.

Those usually embed any of the following:

* Controllers, along with their routing configuration
* Commands
* DependencyInjection configuration, including CompilerPass
* EventListeners

They can also include resources such as templates, assets and schema.

Are they all compatible with `MicroFrameworkBundle`?

> **Note**: To find Symfony bundles, have a look at [knpbundles](http://knpbundles.com/)
> or [packagist](https://packagist.org/search/?q=Symfony%20Bundle).

## Officially Supported Bundles

First of all, here's a list of bundles `MicroFrameworkBundle` commits to support:

* [league/tactician-bundle](https://tactician.thephpleague.com/)
* [symfony/monolog-bundle](http://symfony.com/doc/current/cookbook/logging/monolog.html)

These may change in the future.

## Criterias of compatibility

`MicroFrameworkBundle` has a highly opinionated take on third party bundles:
it expects them to be "micro bundles", meaning:

* an empty bundle only requires the `symfony/http-kernel` and `symfony/dependency-injection` composer packages
* a bundle providing Event Listeners should also depend on `symfony/event-dispacther`
* a bundle embeding YAML configuration should finally depend on `symfony/yaml`

Most bundles specify a hard dependency on the `symfony/framework-bundle` composer package
meaning that a vast majority of bundles aren't compatible, including the so-called
[30 Most Useful Symfony Bundles](http://symfony.com/blog/the-30-most-useful-symfony-bundles-and-making-them-even-better).

This limitation could be leveraged by contributing to these bundes and replacing
their hard dependency by the components they're actually depending on.

However there is another limitation, some bundles actually rely on FrameworkBundle.

### Base Controller

`FrameworkBundle` prodives a Base Controller. Any bundle providing controllers that
extend it won't be compatible with `MicroFrameworkBundle`.

Base Controllers provide shortcut methods for different responsibilities (from
routing to security, alongside with templates and forms). Those can easily be
implemented directly in a controller ([have a look](https://github.com/symfony/symfony/blob/master/src/Symfony/Bundle/FrameworkBundle/Controller/Controller.php)).

By creating instead a controller as a service, we make explicit its dependencies.
If there's many of them, the controller might do too much work (it should only be a glue)
or it might needs to be split.

To make them compatible again, those controllers should be converted to services.

### Debug Toolbar and Profiler

Since the debug toolbar is mainly usefull on fullstack websites, it isn't embeded
in `MicroFrameworkBundle`. This means that none of the `DataCollectors` are registered,
and the `Profiler` is disabled.

> **Note**: The `Debug` component is still present as it is a `HttpKernel` dependency.

### HttpCache

No extensions for HttpCache are provided and ESI/fragements are not registered.

### Console

Most console features are currently absent from `MicroFrameworkBundle`.

#### Container Aware Command

`FrameworkBundle` also prodives a Container Aware Command. Any bundle providing
commands that extend it won't be compatible with `MicroFrameworkBundle`.

As for controllers, we should make dependencies explicit for commands.

To make them compatible again, those commands should be converted to services.

#### Commands as a service

`FrameworkBundle` provides a compiler pass to register commands as a service.

This might be supported in the future.

#### Console Application

`FrameworkBundle` provides a Console Application that works with the Kernel and bundles.

This might be supported in the future.

### Missing Dependencies

To follow the "add what you need" micro framework philosohpy, there are many components
present in `FrameworkBundle` that are absent from `MicroFrameworkBundle`:

* `symfony/asset`
* `symfony/finder`
* `symfony/security-core`
* `symfony/security-csrf`
* `symfony/stopwatch`
* `symfony/templating`
* `symfony/translation`

No configuration is provided for `FrameworkBundle` "optional" dependencies:

* `symfony/browser-kit`
* `symfony/expression-language`
* `symfony/form`
* `symfony/process`
* `symfony/property-access`
* `symfony/property-info`
* `symfony/security`
* `symfony/serializer`
* `symfony/validator`

Finally, some third party libraries have also been removed:

* `doctrine/annotations`
* `doctrine/cache`

## Conclusion

A micro framework requires micro bundles. Most third party bundles won't be
compatible with `MicroFrameworkBundle` because of:

* their hard dependency on `FrameworkBundle` specific classes (`Controller`, `ContainerAwareCommand`, etc)
* their tendency to try to solve 80% of most use cases, instead of following a "add what you need" philosophy

Good bundle candidates would be ones that integrate a library into Symfony's
Dependency Injection Container, for example `symfony/monolog-bundle`.
