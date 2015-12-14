#!/usr/bin/env sh

composer --quiet update --optimize-autoloader

vendor/bin/phpunit
