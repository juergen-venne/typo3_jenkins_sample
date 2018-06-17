#!/bin/bash
BUILD_DIRECTORY="$( cd "$(dirname "$0")" ; pwd -P )"
APP_DIRECTORY="$( cd "$(dirname "$BUILD_DIRECTORY")" ; pwd -P )"

set -e

pushd ${APP_DIRECTORY}

# Add fe build commands here

popd
