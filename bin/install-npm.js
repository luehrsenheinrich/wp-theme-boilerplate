const exec = require( 'child_process' ).exec;

class NPMInstaller {
	constructor() {
		// Make sure npm is up-to-date
		console.log( 'Installing and updating NPM packages...' );
		this.runExec( 'npm install npm -g' );
	}

	runExec( cmd, exit = false ) {
		exec( cmd,
			( error, stdout, stderr ) => {
				console.log( 'stdout: ' + stdout );

				if ( error !== null ) {
					console.error('exec error: ' + error);
				} else if ( ! exit ) {
					// Install/update package
					this.runExec( 'npm install', true );
				}
			}
		);
	}
}

module.exports = NPMInstaller;
