const webpack = require('webpack');
const path = require('path');
const fs = require('fs');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

// paths
const distPath = 'www/dist';

// directories
const assetsDir = path.join(__dirname, 'assets');
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
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader'
						},
						{
							loader: 'sass-loader'
						},
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
				'window.jQuery': 'jquery',
			}),
			new MiniCssExtractPlugin({
				filename: production ? '[name].[hash].css' : '[name].css',
			}),
			new CleanWebpackPlugin({
				dry: false,
			}),
			new ManifestPlugin(),
		]
	};

	if (production) {
		options.plugins.push(new OptimizeCssAssetsPlugin());
	}

	return options;
};