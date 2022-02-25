<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHello;
use tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\CommandBus\SayHelloHandler;

class MyController
{
    private $sayHelloHandler;

    public function __construct(SayHelloHandler $sayHelloHandler)
    {
        $this->sayHelloHandler = $sayHelloHandler;
    }

    public function helloWorld(Request $request): Response
    {
        $message = $this->sayHelloHandler->handle(new SayHello(
            $request->query->get('name'),
        ));

        return new Response($message);
    }
}
