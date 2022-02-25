#!/usr/bin/env sh

rm -rf tests/App/var
composer --quiet update --optimize-autoloader

vendor/bin/phpunit && \
  PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix --allow-risky=yes
