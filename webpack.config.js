const ExtractTextPlugin = require('extract-text-webpack-plugin');

const extractFrontendStyles = new ExtractTextPlugin("built-frontend-styles.css");
const extractBackendStyles = new ExtractTextPlugin("built-backend-styles.css");
module.exports = {
    entry: ['./block.js'], // Webpack
    output: {
        path: __dirname+'/build',
        filename: 'block.build.js',
    },
    module: {
        loaders: [
            {
                test: /.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            },
            {
              test: /(\.backend)\.scss$/,
              use: extractBackendStyles.extract({
                fallback: 'style-loader',
                use: [require.resolve('css-loader'), require.resolve('sass-loader')],
              })
            },

            {
              test: /^(.(?!\.backend))*\.scss$/,
              use: extractFrontendStyles.extract({
                fallback: 'style-loader',
                use: [require.resolve('css-loader'), require.resolve('sass-loader')],
              })
            },
        ],
    },
    plugins: [
      extractFrontendStyles,
      extractBackendStyles,
    ]
};
