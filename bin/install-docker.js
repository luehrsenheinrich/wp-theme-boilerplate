const path = require( 'path' );
const Docker = require('dockerode');
const compose = require('docker-compose');
const docker = new Docker();

// Check that Docker is installed and running.
docker.info()
	.then( ( resp ) => installDocker() )
	.catch( ( err ) => onDockerError( err ) );

function onDockerError( err ) {
	switch ( err.code ) {
		case 'ENOENT':
			// If Docker is not installed.
			console.error( 'Docker doesn\'t seem to be installed. Please head on over to the Docker site to download it: "https://www.docker.com/community-edition#/download"' );
			break;
		case 'ECONNREFUSED':
			// If Docker is not running.
			console.error( 'Docker isn\'t running. Please check that you\'ve started your Docker app, and see it in your system tray.' );
			break;
		default:
			console.error( 'Error: ' + err.code );
	}
}

function installDocker() {
	const yml = path.join(__dirname) + '/../';

	// Stop existing containers.
	// This stops all running containers, including those on port 80.
	console.log( 'Stopping Docker containers...' );
	compose.stop( '>/dev/null 2>&1' );

	// Download image update
	console.log( 'Downloading Docker image updates...' );
	compose.pullAll({ cwd: yml, log: true }).then(
		() => {
			// Starting docker Containers.
			console.log( 'Starting Docker containers...' );
			compose.upAll({ cwd: yml, log: true })
				.then(
					() => { console.log( 'done' ) },
					err => { console.log( 'something went wrong:', err.message ) }
			);
		},
		err => { console.log( 'something went wrong:', err.message ) }
	);


}
