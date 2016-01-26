var elixir = require('laravel-elixir');
var paths = {'bootstrap': './node_modules/bootstrap-sass/assets/'};

elixir(function(mix) {
  mix.browserify('app.js', 'public/js/app.js');
   mix.scripts([
            'respond.js'
        ], 'public/js/respond.js')
      .sass("main.scss", 'public/css/', {includePaths: [paths.bootstrap + 'stylesheets/']})
      .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts/bootstrap/')
      .version(['public/js/all.js', 'public/css/main.css'])
      .browserSync({
        proxy: 'homestead.app'
      });
});
