#!/bin/sh

echo ""

docker container exec app-php composer run tests

echo ""
