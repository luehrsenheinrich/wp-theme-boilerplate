const DockerInstaller = require( './install-docker.js' )
const WPCSInstaller = require( './install-wpcs.js' );
const WordPressInstaller = require( './install-wordpress.js' );
const eventEmitter = require('events').EventEmitter;

const ee = new eventEmitter();
const installers = [ DockerInstaller, WPCSInstaller, WordPressInstaller ];
let installer_index = 0;

console.log( 'Starting the Luehrsen // Heinrich development enviroment...' );

ee.on( 'nextInstaller', runInstaller );

function runInstaller() {
	new installers[ installer_index ]().init()
		.then(result => {
			installer_index++;

			if ( installers.length === installer_index ) {
				console.log( 'Welcome to your WordPress' );
				console.log( 'Run "grunt watch", then open https://localhost to get started!' );
				process.exit(0);
			}

			ee.emit( 'nextInstaller' );
		})
		.catch(err => {
			console.error(err);
			process.exit(0);
		})
	;
}

runInstaller();

// Install wordpress and needed components
// . "$(dirname "$0")/install-wordpress.sh"
//
// CURRENT_URL=$(docker-compose run -T --rm cli option get siteurl)
//
// echo "\nWelcome to your WordPress\n"
// echo "Run $(action_format "grunt watch"), then open $(action_format "$CURRENT_URL") to get started!"
