#!/bin/bash

# Exit if any command fails
set -e

# Include useful functions
. "$(dirname "$0")/includes.sh"

# Install/update package
echo $(status_message "Installing and updating NPM packages..." )
npm install
