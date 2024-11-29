# Incompatibility

Symfony's official FrameworkBundle offers a couple of features that we have chosen not to implement in this MicroFrameworkBundle,
at least not out of the box.

## Controller method arguments

With the Micro Framework Bundle, your controller actions can only have a `Request` argument:

```php
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\MyService;

class MyController
{
    public function __construct(
        private MyService $myService,
    ) {
    }

    #[Route('/my-path', methods: ['GET'], name: self::class)]
    public function myAction(Request $request): Response
    {
        $result = $this->myService->doesSometing(
            $request->query->get('query_argument', 'default'),
        );

        return new Response(json_encode($result), 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}
```

This is in contrast with Symfony's official Framework Bundle,
which allows you to either inject services, or route parameters.

> **Note**: Symfony's official Framework Bundle also provides an `AbstractController`,
> which provides shortcut methods. There are no such class in the Micro Framework Bundle.
