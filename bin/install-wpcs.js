const exec = require( 'child_process' ).exec;

class WPCSInstaller {
	async init() {
		console.log( 'Attempting to install WordPress Coding Standards...' );
		const result = await this.runExec( 'composer install' );
		return result;
	}

	async runExec( cmd ) {
		return new Promise( ( res ) => {
			exec( cmd, async ( error, stdout, stderr ) => {
					console.log( stdout );
					return res( true );

					if ( error !== null ) {
						console.error('exec error: ' + error);
						process.exit(0);
					}
				}
			);
		} );
	}
}

module.exports = WPCSInstaller;
