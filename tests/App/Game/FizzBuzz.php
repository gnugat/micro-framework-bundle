<?php

/*
 * This file is part of the gnugat/micro-framework-bundle package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Gnugat\MicroFrameworkBundle\App\Game;

/**
 * This service tests autowiring.
 */
class FizzBuzz
{
    public function __invoke(int $index): array
    {
        $value = (string) $index;
        if (0 === $index % 3) {
            $value = 'fizz';
        }
        if (0 === $index % 5) {
            $value = 'buzz';
        }
        if (0 === $index % 3 && 0 === $index % 5) {
            $value = 'fizz buzz';
        }

        return [
            'index' => $index,
            'value' => $value,
        ];
    }
}
