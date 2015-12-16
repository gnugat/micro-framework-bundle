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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function helloWorld(Request $request)
    {
        $name = $request->query->get('name', 'world');

        return new Response("Hello $name!");
    }
}
