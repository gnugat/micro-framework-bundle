#!/usr/bin/env sh

rm -rf var
composer --quiet dump --optimize

vendor/bin/phpunit && \
  PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix --allow-risky=yes
