#!/bin/bash
BUILD_DIRECTORY="$( cd "$(dirname "$0")" ; pwd -P )"
PROJECT_DIRECTORY="$( cd "$(dirname "$BUILD_DIRECTORY")" ; pwd -P )"

pushd "${PROJECT_DIRECTORY}"

vendor/bin/typo3cms install:fixfolderstructure
chgrp -R www-data public/fileadmin public/typo3temp var
chmod -R g+w public/fileadmin public/typo3temp var

# Wait for db to become available
until mysqladmin ping -h ${TYPO3_DB_HOST} > /dev/null 2>&1
do
    echo "Waiting 5sec for db to become available";
    sleep 5;
done

echo "DB available"

vendor/bin/typo3cms database:updateschema "*"
vendor/bin/typo3cms extension:setupactive

# Create be admin
echo "INSERT INTO be_users SET username=\"${TYPO3_ADMIN_USER}\", password = \"${TYPO3_ADMIN_PASSWORD}\", admin = 1" | vendor/bin/typo3cms database:import

vendor/bin/typo3cms cache:flush

popd
