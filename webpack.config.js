const { join } = require('path')
const Encore = require('@symfony/webpack-encore')

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment('dev');
}

Encore.setOutputPath('./../../public/assets/')

Encore.setPublicPath('/assets/')

Encore.addEntry('app', './src/UI/Resources/js/app.js')

Encore.disableSingleRuntimeChunk()

Encore.cleanupOutputBeforeBuild()

Encore.enableSourceMaps(!Encore.isProduction())

Encore.enableVersioning(Encore.isProduction())

Encore.configureDevServerOptions((options) => {
    /**
     * Normalize "options.static" property to an array
     */
    if (!options.static) {
      options.static = []
    } else if (!Array.isArray(options.static)) {
      options.static = [options.static]
    }
  
    /**
     * Enable live reload and add views directory
     */
    options.liveReload = true
    options.static.push({
      directory: join(__dirname, '../src/UI/Resources/views'),
      watch: true,
    })
  })

Encore.enablePostCssLoader();

const config = Encore.getWebpackConfig()
config.infrastructureLogging = {
  level: 'warn',
}
config.stats = 'errors-warnings'

module.exports = config
