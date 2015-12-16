#!/usr/bin/env sh

rm -rf Tests/app/cache/* Tests/app/logs/*
composer --quiet update --optimize-autoloader

vendor/bin/phpunit
