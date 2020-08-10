#!/bin/bash

php composer.phar update;
rm -f var/cache/dev/*
rm -f var/cache/prod/*