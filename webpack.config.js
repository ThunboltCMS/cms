const CleanWebpackPlugin = require('clean-webpack-plugin');
const webpack = require('webpack');
const path = require('path');
const fs = require('fs');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

// directories
const distPath = 'www/dist';
const appDir = path.join(__dirname, 'app');
const varDir = path.join(appDir, 'var');
const assetsDir = path.join(__dirname, 'assets');
const distDir = path.join(__dirname, distPath);

module.exports = (env, argv) => {
	const production = argv.mode === 'production';

	return {
		entry: {
			src: path.join(assetsDir, 'build.js')
		},
		output: {
			path: distDir,
			filename: production ? '[name].[hash].js' : '[name].js'
		},
		resolve: {
			extensions: [ '.tsx', '.ts', '.js' ]
		},
		module: {
			rules: [
				{
					test: /\.tsx?$/,
					loader: 'ts-loader',
					exclude: /node_modules/,
					options: {
						happyPackMode: true,
					},
				},
				{
					test: /\.js?$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					query: {
						cacheDirectory: true,
						presets: ['es2015-without-strict']
					},
				},
				{
					test: /\.s?css$/,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							'options': {
								'minimize': production,
							}
						},
						"sass-loader",
					]
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
			new webpack.ProvidePlugin({
				$: 'jquery',
				jQuery: 'jquery',
				'window.jQuery': 'jquery',
			}),
			new MiniCssExtractPlugin({
				filename: production ? "[name].[hash].css" : '[name].css',
			}),
			new CleanWebpackPlugin([
				distPath
			], {
				root: __dirname,
				dry: false,
			}),
			function () {
				this.plugin('done', (stats) => {
					if (fs.existsSync(varDir + '/webpack-hash')) {
						fs.unlinkSync(varDir + '/webpack-hash');
					}

					if (!production) {
						return;
					}
					fs.writeFile(varDir + '/webpack-hash', stats.hash, { flag: 'w' }, (err) => {
						if (err) throw err;
					});
				});
			}
		]
	}
};