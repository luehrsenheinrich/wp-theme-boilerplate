const DockerInstaller = require( './install-docker.js' )
const WPCSInstaller = require( './install-wpcs.js' );

console.log( 'Starting the Luehrsen // Heinrich development enviroment...' );

// Check Docker is installed and running
//new DockerInstaller();

// Install WPCS
// . "$(dirname "$0")/install-wpcs.sh"
new WPCSInstaller();

// Install wordpress and needed components
// . "$(dirname "$0")/install-wordpress.sh"
//
// CURRENT_URL=$(docker-compose run -T --rm cli option get siteurl)
//
// echo "\nWelcome to your WordPress\n"
// echo "Run $(action_format "grunt watch"), then open $(action_format "$CURRENT_URL") to get started!"
