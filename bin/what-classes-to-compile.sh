#!/usr/bin/env sh

rm -rf Tests/app/cache/* Tests/app/logs/*
composer --quiet update --optimize-autoloader

# Run it twice to generate the cache
php Tests/app/what_classes_to_compile.php > /dev/null
php Tests/app/what_classes_to_compile.php
