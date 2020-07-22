const config = require("@wordpress/browserslist-config");
const opn = require('opn')

opn("https://browserl.ist/?q=" + encodeURIComponent(config.join(' OR ')));
