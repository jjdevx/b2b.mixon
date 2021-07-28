const mix = require('laravel-mix')
const path = require('path')
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin')

mix.browserSync('mixon.loc')

mix.webpackConfig({
  output: {
    publicPath: '/dist/',
  },
  resolve: {
    alias: {
      '@': path.resolve('resources/js')
    }
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: 'ts-loader',
        exclude: /node_modules/,
        options: {
          transpileOnly: true
        }
      }
    ]
  },
  plugins: [new ForkTsCheckerWebpackPlugin(
    {
      eslint: {
        files: 'resources/js/**/*.{ts,tsx,js,jsx,vue}'
      }
    },
  )],
}).setPublicPath('../../public/dist/')

const options = {
  processCssUrls: false,
  terser: {
    extractComments: false,
  }
}

mix.options(options)

mix.ts('resources/js/app.ts', 'js/app.js')
  .vue({version: 3})
  .extract([
    'vue', '@vue/composition-api', '@inertiajs/inertia-vue', '@inertiajs/progress', 'axios'
  ])

mix.sass('resources/scss/app.scss', 'css/app.css', {
  sassOptions: {
    quietDeps: true
  }
})

mix.copyDirectory('resources/assets/img', '../../public/dist/img')

if (mix.inProduction()) {
  mix.version()
} else {
  mix.sourceMaps()
}

mix.disableNotifications()
