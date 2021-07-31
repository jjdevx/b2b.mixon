const path = require('path')

module.exports = {
  resolve: {
    alias: {
      '@': path.resolve('resources/js'),
      'mixon': path.resolve('resources/js/helpers/mixon.ts'),
    },
  }
}
