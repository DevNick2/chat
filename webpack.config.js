const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

module.exports = {
    entry: {
        babelpolyfill: "@babel/polyfill",
        core: "./Source/core.js",
        style: "./Source/styles.js"
            // ... 
    },
    output: {
        filename: '[name].bundle.js',
        path: path.join(__dirname, 'App/Bundles'),
        chunkFilename: '[name].bundle.js',
        publicPath: '/Chat/App/Bundles/'

    },
    optimization: {
        /*splitChunks: {
        	chunks: 'all'
        },*/
        minimizer: [
            new UglifyJsPlugin({ // Limpando e organizando o css e o js
                include: /\.js$/,
                uglifyOptions: {
                    output: {
                        comments: false, // removendo os comentarios
                    }
                }
            }),
            new OptimizeCSSAssetsPlugin({}) // otimizando o css
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({ // minificando o css
            filename: "core.css"
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        })
    ],
    module: {
        rules: [
            { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" },
            {
                test: /\.css$/,
                use: [
                    { loader: MiniCssExtractPlugin.loader }, //style-loader
                    { loader: "css-loader" }
                ]
            },
            {
                test: /\.(scss)$/,
                use: [
                    { loader: MiniCssExtractPlugin.loader, }, // Injetando o css 'style-loader'
                    { loader: 'css-loader', }, // Transformando o css em modulo CommonJs
                    {
                        loader: 'postcss-loader', // Rodando os comandos CSs
                        options: {
                            plugins: function() { // Permite exportar o css como config.js
                                return [
                                    require('precss'),
                                    require('autoprefixer')
                                ];
                            }
                        }
                    },
                    { loader: 'sass-loader' } // Compila Sass para CSS
                ]
            },
            {
                test: require.resolve('jquery'),
                use: [{
                    loader: 'expose-loader',
                    options: '$'
                }]
            }
        ]
    },
};