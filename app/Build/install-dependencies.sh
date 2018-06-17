#!/bin/bash
BUILD_DIRECTORY="$( cd "$(dirname "$0")" ; pwd -P )"
APP_DIRECTORY="$( cd "$(dirname "$BUILD_DIRECTORY")" ; pwd -P )"

set -e

pushd ${APP_DIRECTORY}

echo "Start composer install"
composer install --no-interaction

popd
