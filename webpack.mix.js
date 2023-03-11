
const mix = require('laravel-mix');
const path = require('path');

const webpackConfig = mix.webpackConfig({
    devtool: process.env.npm_lifecycle_script === 'mix --production' ? false : 'eval-source-map',
    //devtool: false,
    output: {
        libraryExport: 'default',
        path: path.join(__dirname, 'public/'),
    },
    resolve: {
        extensions: ['.js', '.scss'],
        alias: {
            '@': path.resolve(__dirname, './resources'),
            '@js': path.resolve(__dirname, './resources/js'),
            '@scss': path.resolve(__dirname, './resources/scss'),
        },
        modules: ["node_modules"]
    },
    target: ['web', 'es6'],

}).disableNotifications()
.js('resources/js/main.js', 'js/main.js')
    .sourceMaps()
    .sass('resources/scss/main.scss', 'css/main.css').options({
        processCssUrls: false
    })