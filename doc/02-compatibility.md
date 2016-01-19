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
it expects them to be "micro bundles".
This would typically be bundles registering a third party library services into
the Dependency Injection Container.

> **Note**: Most bundles specify `symfony/framework-bundle` as a composer dependecy,
> when they could instead specify only the components they actually depend on.
>
> They might still be compatible with `MicroFrameworkBundle` (but they'll download
> `symfony/framework-bundle` and add its classes to the autoloader).
>
> This could be solved by contributing to them. Here's an example:
>
> * an empty bundle only requires the `symfony/http-kernel` and `symfony/dependency-injection`
> * a bundle providing Event Listeners also requires `symfony/event-dispacther`
> * a bundle embeding YAML configuration also requires `symfony/yaml`

In the next sub-sections we're going to review `FrameworkBundle` specific features
that third party bundles might depend on, and see how this can affect compatibility
as well as how to fix it.

### Annotations

`MicroFrameworkBundle` doesn't provide support for annotations, but by manually
setting up we can still be compatible with bundles that use this configuration format:

1. register an implementation of `Doctrine\Common\Annotations\Reader` as a service named `annotation_reader`
2. register `AnnotationLoader` for the related components (e.g. Validator, Routing, Serializer, etc)

While their main strength is to reduce the distance between configuration and code
as well as enabling AOP, annotations aren't supported here because they tightly
couple application code with third party libraries.

We'd recommend to switch to another configuration format.

### Controllers and Routings

`MicroFrameworkBundle` forces applications to configure their controller as services,
since it's the only routing configuration format it supports.

Third party bundles that provide controllers are excluded from the "micro bundle"
category as it might indicate that they try to solve too many use cases.

Those bundles might still be compatible and their controllers might be or might
not be able to be registered.

> **Note**: `FrameworkBundle` prodives a Base Controller that contains shortcut
> methods.
> By creating instead a controller as a service, we make its dependencies explicit.
> If there's many of them, the controller might do too much work (it should only be a glue)
> or it might needs to be split.

### Debug Toolbar and Profiler

The debug toolbar isn't embeded provided by `MicroFrameworkBundle` as it would
add a dependency on frontend tools.

It is still possible to install it by registering `DataCollectors` as well as the
`Profiler`.

> **Note**: The `Debug` component is still present as it is a `HttpKernel` dependency.

### HttpCache

No extensions for HttpCache are provided and ESI/fragements are not registered.

### Console

`FrameworkBundle` prodives a `ContainerAwareCommand`. Any bundle providing
commands that extend it won't be compatible with `MicroFrameworkBundle`.

We recommend to register those commands as services instead, as they will be
supported in the future by `MicroFrameworkBundle`.

Finally, `FrameworkBundle` provides its own Console `Application` that wraps the
Kernel to access its registered bundles. This is planned to be supported.

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

A micro framework requires micro bundles. Most third party bundles might not be
compatible with `MicroFrameworkBundle` because of:

* their hard dependency on `FrameworkBundle` specific classes (`Controller`, `ContainerAwareCommand`, etc)
* their tendency to try to solve 80% of most use cases, instead of following a "add what you need" philosophy

But with a bit of work they can be used.

Good bundle candidates would be ones that simply integrate a library into Symfony's
Dependency Injection Container, for example `symfony/monolog-bundle`.
