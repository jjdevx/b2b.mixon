const mix = require('laravel-mix')
const webpack = require('webpack')
const path = require('path')
const VueTsCheckerPlugin = require('@juit/vue-ts-checker').VueTsCheckerPlugin
require('laravel-mix-eslint-config')

mix.browserSync('mixon.loc')

mix.webpackConfig({
  output: {
    publicPath: '/dist/',
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
  resolve: {
    alias: {
      'vue-i18n': 'vue-i18n/dist/vue-i18n.runtime.esm-bundler.js'
    }
  },
  plugins: [
    new webpack.DefinePlugin({
      __VUE_OPTIONS_API__: true,
      __VUE_PROD_DEVTOOLS__: true,
      __VUE_I18N_FULL_INSTALL__: true,
      __VUE_I18N_LEGACY_API__: true,
      __INTLIFY_PROD_DEVTOOLS__: false
    }),
    new VueTsCheckerPlugin()
  ],
  devtool: 'source-map',
}).setPublicPath('../../public/dist/')

mix.alias({
  '@': path.join(__dirname, 'resources/js')
})

const options = {
  processCssUrls: false,
  terser: {
    extractComments: false,
  }
}

mix.options(options)

mix.ts('resources/js/app.ts', 'js/app.js')
  .vue({version: 3})
  .extract(['vue', '@vue/composition-api', '@inertiajs/inertia-vue', '@inertiajs/progress', 'axios'])
  .eslint({
    extensions: ['js', 'ts', 'vue']
  })

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

mix.disableSuccessNotifications()
