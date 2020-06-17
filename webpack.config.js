const path = require('path');
const webpack = require('webpack');
const TerserPlugin = require('terser-webpack-plugin');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

module.exports = {
	entry: {
		'script.min': path.resolve(__dirname, './build/js/script.js'),
		'script.bundle': path.resolve(__dirname, './build/js/script.js'),
	},
	mode: 'none',
	output: {
		path: path.resolve(__dirname, './trunk'),
		filename: '[name].js',
	},
	plugins: [
		new webpack.ProvidePlugin({
			jQuery: 'jquery',
			$: 'jquery',
			wp: 'wp',
		}),
		new TerserPlugin({
			include: /\.min\.js$/,
		}),
		new DependencyExtractionWebpackPlugin(),
	],
	externals: {
		jquery: 'jQuery',
		wp: 'wp',
		react: 'React',
		'react-dom': 'ReactDOM',
	},
	resolve: {
		modules: ['node_modules'],
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader',
				include: path.resolve(__dirname, 'build'),
			},
		],
	},
};
