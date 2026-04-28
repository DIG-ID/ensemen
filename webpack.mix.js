// webpack.mix.js

const os = require('os');
const path = require('path');

// Caminho para os certificados do Local by WPEngine
const certPath = path.join(
  os.homedir(),
  os.platform() === 'win32'
    ? 'AppData/Roaming/Local/run/router/nginx/certs'
    : 'Library/Application Support/Local/run/router/nginx/certs'
);

const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix
  .setResourceRoot('./')
  .setPublicPath('dist')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
  })

  .js('assets/js/main.js', 'js')
  .sass('assets/sass/main.sass', 'css')
  .sass('assets/sass/admin-login.sass', 'css')
  .options({
    postCss: [ tailwindcss('./tailwind.config.js') ],
    processCssUrls: false,
  })

  .browserSync({
    proxy: "https://ensemen.digid/",
    host: "ensemen.digid",
    open: "external",
    port: 3000,
    ws: true,
    https: {
      key: path.join(certPath, 'ensemen.digid.key'),
      cert: path.join(certPath, 'ensemen.digid.crt'),
    },
    files: ["./**/*.php", "./dist/js/*.js", "./dist/css/*.css"]
  })
  .disableNotifications();
  

if (!mix.inProduction()) {
  mix
    .webpackConfig({
      devtool: "source-map"
    })
    .sourceMaps();
}

if (mix.inProduction()) {
  mix.version();
}