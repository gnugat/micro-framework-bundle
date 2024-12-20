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

### Debug Toolbar and Profiler

The debug toolbar isn't provided by `MicroFrameworkBundle` as it would add a
dependency on frontend tools (which we might not need if we're only creating APIs).

It is still possible to install it by registering `DataCollectors` as well as the
`Profiler`.

> **Note**: The `Debug` component is still present as it is a `HttpKernel` dependency.

### HttpCache

No extensions for HttpCache are provided and ESI/fragements are not registered.

### Console

`FrameworkBundle` provides its own Console `Application` that wraps the
Kernel to access its registered bundles.

> **Note**: Some bundles, like `DoctrineBundle`, have a direct dependency on
> `FrameworkBundle`'s console `Application` making them incompatible with `MicroFrameworkBundle`.

### Missing Dependencies

To follow the "add what you need" micro framework philosohpy, there are many components
present in `FrameworkBundle` that are absent from `MicroFrameworkBundle`:

* `symfony/asset`
* `symfony/cache`
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
