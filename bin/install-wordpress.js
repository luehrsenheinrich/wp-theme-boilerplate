class WordPressInstaller {
	async init() {
		console.log( 'wordpressinstaller' );
		return new Promise( ( res ) => { return res( true ) } );
	}
}

module.exports = WordPressInstaller;
