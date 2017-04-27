const { mix } = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        extensions: ['.ts', '.js']
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                loader: 'ts-loader'
            }
        ]
    }
});


mix.js('resources/assets/app.js', 'public/js')
    .js('resources/ts/main.ts', 'public/js');