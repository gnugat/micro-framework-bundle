#!/usr/bin/env sh

rm -rf tests/App/cache/* tests/App/logs/*
composer --quiet update --optimize-autoloader

vendor/bin/phpunit
