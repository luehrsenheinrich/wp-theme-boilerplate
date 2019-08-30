const exec = require( 'child_process' ).exec;

class WPCSInstaller {
	constructor() {
		// Make sure npm is up-to-date
		console.log( 'Attempting to install WordPress Coding Standards...' );
		this.runExec( 'composer install' );
	}

	runExec( cmd ) {
		exec( cmd,
			( error, stdout, stderr ) => {
				console.log( stdout );

				if ( error !== null ) {
					console.error('exec error: ' + error);
				}
			}
		);
	}
}

module.exports = WPCSInstaller;
