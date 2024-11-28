<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use tests\Gnugat\MicroFrameworkBundle\App\Game\Public\FizzBuzz;

/**
 * This autowired controller tests the routing configuration by attributes.
 */
class FizzBuzzController
{
    public function __construct(
        private FizzBuzz $fizzBuzz,
    ) {
    }

    #[Route('/fizz-buzz', methods: ['GET'], name: self::class)]
    public function __invoke(Request $request): Response
    {
        $result = ($this->fizzBuzz)(
            (int) $request->query->get('index', 1),
        );

        return new Response(json_encode($result), 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}
