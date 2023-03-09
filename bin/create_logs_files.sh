#!/bin/bash

# Navigate to the directory where the script is located
cd "$(dirname "$0")"

# Create the log directory if it doesn't exist
mkdir -p ../log

# Create the access log file if it doesn't exist
if [ ! -e ../log/access.log ]; then
    touch ../log/access.log
    echo "Access log file created"
fi

# Create the error log file if it doesn't exist
if [ ! -e ../log/error.log ]; then
    touch ../log/error.log
    echo "Error log file created"
fi
