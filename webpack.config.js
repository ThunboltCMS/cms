const webpack = require('webpack');
const path = require('path');
const fs = require('fs');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');

// paths
const distPath = 'www/dist';

// directories
const appDir = path.join(__dirname, 'app');
const assetsDir = path.join(__dirname, 'assets');
const generated = path.join(appDir, 'var/js');
const distDir = path.join(__dirname, distPath);

module.exports = (env, argv) => {
	const production = argv.mode === 'production';

	const options = {
		entry: {
			src: path.join(assetsDir, 'build.js')
		},
		output: {
			path: distDir,
			filename: production ? '[name].[hash].js' : '[name].js'
		},
		resolve: {
			extensions: [ '.js', '.ts' ]
		},
		module: {
			rules: [
				{
					test: /\.tsx?$/,
					loader: 'babel-loader',
					exclude: /node_modules/,
					query: {
						plugins: [
							'@babel/plugin-proposal-nullish-coalescing-operator',
							'@babel/plugin-proposal-optional-chaining',
							'@babel/plugin-proposal-private-methods',
							'@babel/plugin-proposal-class-properties',
						],
						presets: ['@babel/preset-typescript']
					}
				},
				{
					test: /\.js?$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					query: {
						plugins: [
							'@babel/plugin-proposal-nullish-coalescing-operator',
							'@babel/plugin-proposal-optional-chaining',
							'@babel/plugin-proposal-private-methods',
							'@babel/plugin-proposal-class-properties',
						],
						presets: ['@babel/preset-env']
					},
				},
				{
					test: /\.s?css$/,
					use: ExtractTextPlugin.extract({
						fallback: 'style-loader',
						use: [
							'css-loader',
							'sass-loader',
						]
					})
				},
				{
					test: /\.woff2?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
					use: 'url-loader?limit=10000',
				},
				{
					test: /\.(ttf|eot|svg)(\?[\s\S]+)?$/,
					use: 'file-loader',
				},
				{
					test: /\.(jpe?g|png|gif|svg)$/i,
					use: [
						'file-loader?name=images/[name].[ext]',
					]
				}
			]
		},
		plugins: [
			new ExtractTextPlugin(production ? '[name].[hash].css' : '[name].css'),
			new webpack.ProvidePlugin({
				'window.jQuery': 'jquery',
			}),
			new CleanWebpackPlugin({
				dry: false,
			}),
			function () {
				this.hooks.done.tap('GeneratedPlugin', (stats) => {
					if (fs.existsSync(generated + '/hash.txt')) {
						fs.unlinkSync(generated + '/hash.txt');
					}

					if (!production) {
						return;
					}
					if (!fs.existsSync(generated)) {
						fs.mkdirSync(generated);
					}
					fs.writeFile(generated + '/hash.txt', stats.hash, { flag: 'w' }, (err) => {
						if (err) throw err;
					});
				});
			}
		]
	};

	if (production) {
		options.plugins.push(new OptimizeCssAssetsPlugin());
	}

	return options;
};