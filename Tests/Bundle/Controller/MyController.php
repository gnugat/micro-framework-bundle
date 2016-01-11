<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\MicroFrameworkBundle\Tests\Bundle\Controller;

use Gnugat\MicroFrameworkBundle\Tests\Bundle\CommandBus\SayHello;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function helloWorld(Request $request)
    {
        $message = $this->commandBus->handle(new SayHello(
            $request->query->get('name')
        ));

        return new Response($message);
    }
}
