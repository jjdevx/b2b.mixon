const mix = require('laravel-mix')
const webpack = require('webpack')
const path = require('path')
const VueTsCheckerPlugin = require('@juit/vue-ts-checker').VueTsCheckerPlugin
require('laravel-mix-eslint-config')

mix.browserSync({
  proxy: 'mixon.loc',
  files: '../../public/dist/**/*'
})

mix.alias({
  '@': path.join(__dirname, 'resources/js'),
  'mixon': path.join(__dirname, 'resources/js/core/facade')
})

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
          transpileOnly: true,
          appendTsSuffixTo: [/\.vue$/]
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
}).setPublicPath('../../public/dist/')

mix.options({
  processCssUrls: false,
  terser: {
    extractComments: false,
  }
})

mix.ts('resources/js/app.ts', 'js/app.js')
  .vue({version: 3})
  .extract([
    'vue', '@vue/composition-api', 'vue-router', 'vue-i18n', 'vee-validate', 'vue-axios',
    '@inertiajs/inertia-vue3', '@inertiajs/progress',
    'axios', 'apexcharts', 'sweetalert2', 'i18n', 'popper.js'
  ])
  .eslint({extensions: ['js', 'ts', 'vue']})

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
