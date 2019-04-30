const webpackConfig = require( './webpack.config' );
const gruntNewerLess = require( 'grunt-newer-less' );

module.exports = function( grunt ) {
	// measures the time each task takes
	// require( 'time-grunt' )( grunt );

	// Get the needed modules just in time
	require( 'jit-grunt' )( grunt, {
		// Define private modules
		postcss: '@lodder/grunt-postcss',
	} );

	// Define the initial config for grunt
	grunt.initConfig( {

		// Define variables
		pkg: grunt.file.readJSON( 'package.json' ),

		// LESS TO CSS - Compile the less files to css files
		less: {
			options: {
				optimization: 2,
				sourceMap: true,
				sourceMapFileInline: true,
				process( content ) {
					return grunt.template.process( content );
				},
			},
			default: {
				files: {
					'trunk/style.css': 'build/less/style.less',
				},
			},
			fonts: {
				files: {
					'trunk/webfonts.css': 'build/less/webfonts.less',
				},
			},
		},

		// OPTIMIZE CSS - Take the created CSS files and run some plugins on it
		postcss: {
			default: {
				options: {
					map: {
						inline: false,
					},
					processors: [
						// add vendor prefixes
						require( 'autoprefixer' )( { browsers: 'last 12 versions' } ),
						// minify the result
						require( 'cssnano' )(),
					],
				},
				files: {
					// The files to be optimised and prefixed
					'trunk/style.min.css': 'trunk/style.css',
				},
			},
			fonts: {
				src: 'trunk/webfonts.css',
				options: {
					map: false, // inline sourcemaps
					processors: [
						require( 'postcss-base64' )( {
							extensions: [ '.woff' ],
							excludeAtFontFace: false,
							root: 'build',
						} ),
					],
				},
			},
		},

		// LINT LESS - Lint the less we wrote
		stylelint: {
			all: [ 'build/less/**/*.css', 'build/less/**/*.less' ],
		},

		// PROCESS JS - Use webpack to process the needed js files
		webpack: {
			prod: webpackConfig,
		},

		// SHELL - Run needed shell commands
		shell: {
			lintPHP: 'composer run lint',
		},

		// ESLINT - Make sure our JS follows coding standards
		eslint: {
			target: [ 'build/js/**/*.js' ],
		},

		// COPY FILES - Copy needed files from build to trunk
		copy: {
			options: {
				process( content ) {
					if ( typeof content !== 'string' ) {
						return content;
					}

					return grunt.template.process( content );
				},
			},
			build: { expand: true, cwd: 'build', src: [ '**/*.txt', '**/*.svg', '**/*.po', '**/*.pot', '**/*.tmpl.html', '**/*.php' ], dest: 'trunk/', filter: 'isFile' },
			build_stream: { expand: true, options: { encoding: null }, cwd: 'build', src: [ '**/*.mo', 'img/**/*', 'screenshot.png', 'fonts/**/*' ], dest: 'trunk/', filter: 'isFile' },
		},

		// CLEAN FOLDERS - Before we compile freshly, we want to delete old folder contents
		clean: {
			options: { force: true },
			trunk: {
				expand: true,
				force: true,
				cwd: 'trunk/',
				src: [ '**/*' ],
			},
			zip: {
				expand: true,
				force: true,
				cwd: '<%= pkg.slug %>/',
				src: [ '**/*' ],
			},
		},

		// COMPRESS - Create a zip file from a new trunk
		compress: {
			main: {
				options: {
					archive: 'update/<%= pkg.slug %>.zip',
				},
				files: [
					{ src: [ '**' ], cwd: 'trunk', expand: true, dest: '<%= pkg.slug %>' },
				],
			},
		},

		// NEWER CACHE - Check which files actually got changed and work only on those
		newer: {
			options: {
				override: gruntNewerLess.overrideLess,
			},
		},

		// WATCHER - Watch for changes in files and process those when a change is detected
		watch: {
			js: {
				files: [ 'build/**/*.js', '!build/**/*.min.js', '!build/**/*.bundle.js' ],
				tasks: [ 'newer_handle_js' ],
				options: {
					livereload: true,
				},
			},
			less: {
				files: [ 'build/**/*.less' ], // which files to watch
				tasks: [ 'newer_handle_css' ],
				options: {
					livereload: true,
				},
			},
			php: {
				files: [ 'build/**/*.php' ], // which files to watch
				tasks: [ 'dev_deploy' ],
				options: {
					livereload: true,
				},
			},
			livereload: {
				files: [ 'build/**/*.html', 'build/**/*.txt' ], // Watch all files
				tasks: [ 'dev_deploy' ],
				options: {
					livereload: true,
				},
			},
		},
	} );

	// Handle certain file groups
	grunt.registerTask( 'newer_handle_css', [ 'less:default', 'newer:postcss:default' ] );
	grunt.registerTask( 'handle_css', [ 'less:default', 'postcss:default' ] );

	grunt.registerTask( 'newer_handle_js', [ 'webpack' ] );
	grunt.registerTask( 'handle_js', [ 'webpack' ] );

	grunt.registerTask( 'handle_fonts', [ 'less:fonts', 'postcss:fonts' ] );

	// Deployment strategies
	grunt.registerTask( 'dev_deploy', [ 'newer_handle_css', 'newer_handle_js', 'newer:copy:build' ] );
	grunt.registerTask( 'deploy', [ 'clean:trunk', 'handle_css', 'handle_js', 'handle_fonts', 'copy:build' ] );

	// Linting
	grunt.registerTask( 'lint', [ 'shell:lintPHP', 'eslint', 'stylelint' ] );

	// Releasing
	grunt.registerTask( 'release', [ 'lint', 'deploy', 'compress' ] );
};
