#!/bin/bash
if [ -e /tmp/initialized ]
then
    echo "Already initialized"
else
    echo "Initializing"
    /app/Build/initialize.sh
    touch /tmp/initialized
fi

# Start apache
apache2-foreground
