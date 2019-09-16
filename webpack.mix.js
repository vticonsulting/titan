/* eslint-env node */
/* eslint-disable no-console, no-sync, array-bracket-newline, no-process-env */

const autoprefixer = require('autoprefixer')
const calc = require('postcss-calc')
const extend = require('extend')
const fs = require('fs')
const glob = require('glob')
const mix = require('laravel-mix')
const path = require('path')
const tailwindcss = require('tailwindcss')

/* -------------------------------------------------------------------------- */
const ENV = process.env.NODE_ENV

/* Load user config if exists */
const defaultConfig = JSON.parse(fs.readFileSync('./config.default.json'))
let config = {}
if (fs.existsSync(path.resolve(__dirname, './config.json'))) {
  config = extend(defaultConfig, JSON.parse(fs.readFileSync('./config.json'))) // eslint-disable-line global-require
} else {
  config = defaultConfig
}

/**
 * 1. Make $ENV variable globally available in SASS.
 */
const sassSettings = {
  data: `$ENV: ${ENV};`, /* 1 */
  precision: 10
}

/**
 * 1. Deactivate integrated autoprefixer, because configuration is
 *    hardcoded (May 28th, 2018) and cannot be changed via
 *    configuration.
 */
mix.options({
  autoprefixer: false, /* 1 */
  processCssUrls: false,
  postCss: [
    tailwindcss(),
    calc({ precision: 10 }),
    autoprefixer({
      browsers: [
        'last 2 versions',
        'not IE < 11',
        'not IE_mob <= 11',
        'not BB <= 10'
      ],
      grid: false
    })
  ]
})

/* -------------------------------------------------------------------------- */


mix.js('resources/titan/js/titan.js', 'titan/js')
// mix.js('resources/default/js/main.js', 'default/js')
mix.js('resources/js/index.js', 'js')
mix.js('resources/js/polyfills/respimage.js', 'js/polyfills')
mix.js('resources/js/polyfills/promise.js', 'js/polyfills') 

/* Search for template-specific JavaScript files */
const templateJS = glob.sync("./resources/js/templates/*.js");
for (let i = 0, l = templateJS.length; i < l; i++) {
  mix.js(templateJS[i], "js/templates");
}

mix.sass('resources/default/sass/styles.scss', 'default/css')
mix.sass('resources/titan/sass/titan.scss', 'titan/css')
mix.sass('resources/sass/index.scss', 'css', sassSettings)

/* Search for template-specific CSS files */
const templateCSS = glob.sync("./resources/sass/templates/*.scss");
for (let i = 0, l = templateCSS.length; i < l; i++) {
  mix.sass(templateCSS[i], "css/templates", sassSettings);
}

/* -------------------------------------------------------------------------- */

mix.browserSync({
  open: false,
  proxy: config.host,
  ghostMode: false,
  files: [
    'content/**/*',
    'site/snippets/**/*.php',
    'site/templates/**/*.php',
    'www/assets/css/**/*.css',
    'www/assets/titan/css/**/*.css',
    'www/assets/js/**/*.js',
    'www/assets/titan/js/**/*.js'
  ]
})

mix.sourceMaps()
mix.disableNotifications()
mix.setPublicPath("www/assets")
mix.setResourceRoot("/assets/")

mix.webpackConfig({
  resolve: {
    alias: {
      // Resources Root
      '@@': path.resolve('resources'),
      // Javascript Root
      '@': path.resolve('resources/js')
      // vue$: mix.inProduction() ? 'vue/dist/vue.min' : 'vue/dist/vue.js',
    }
  },
  output: {
    publicPath: '/assets/',
    chunkFilename: 'js/bundle-[name].js?id=[chunkhash]'
  },
  plugins: [
  ],
  stats: {
    assets: false,
    chunks: false,
    hash: false
  }
})

mix.version()

// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
