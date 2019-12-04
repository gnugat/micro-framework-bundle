#!/usr/bin/env sh

rm -rf tests/App/var
composer --quiet update --optimize-autoloader

vendor/bin/phpunit
