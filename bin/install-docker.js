const path = require( 'path' );
const Docker = require('dockerode');
const compose = require('docker-compose');
const docker = new Docker();
const yml = path.join(__dirname) + '/../';

class DockerInstaller {
	async init() {
		const result = await this.dockerInfo();
		return result;
	}

	/**
	 * Check that Docker is installed and running.
	 */
	async dockerInfo() {
		return new Promise( ( res ) => {
			docker.info()
				.then( async () => {
					const resp = await this.composeStop();
					return res( resp );
				} )
				.catch( ( err ) => { this.onDockerError( err ) } );
		} );
	}

	/**
	 * Stop existing containers.
	 * This stops all running containers, including those on port 80.
	 */
	async composeStop() {
		return new Promise( ( res ) => {
			console.log( 'Stopping Docker containers...' );
			compose.stop( '>/dev/null 2>&1' ).then( async () => {
				const resp = await this.composePull();
				return res( resp );
			} )
			.catch( ( err ) => { this.onDockerError( err ) } );;
		} );
	}

	/**
	 * Download image update.
	 */
	async composePull() {
		return new Promise( ( res ) => {
			console.log( 'Downloading Docker image updates...' );
			compose.pullAll( { cwd: yml, log: true } ).then( async () => {
				const resp = await this.composeUp();
				return res( resp );
			} )
			.catch( ( err ) => { this.onDockerError( err ) } );;
		} );
	}

	/**
	 * Starting docker Containers.
	 */
	async composeUp() {
		return new Promise( ( res ) => {
			console.log( 'Starting Docker containers...' );
			compose.pullAll( { cwd: yml, log: true } ).then( () => {
				return res( true );
			} )
			.catch( ( err ) => { this.onDockerError( err ) } );;
		} );
	}

	/**
	 * Errorhandling.
	 */
	onDockerError( err ) {
		if ( 'undefined' !== typeof err.code ) {
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

		console.error( err );
		process.exit(0);
	}
}

module.exports = DockerInstaller;
