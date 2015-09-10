var elixir = require('laravel-elixir');
var paths = {'bootstrap': './node_modules/bootstrap-sass/assets/'};

elixir(function(mix) {
    mix.scripts([
            'respond.js'
        ], 'public/js/respond.js')
        .scripts([
            'jquery.js',
            'bootstrap.js',
            'app.js'
        ])
      .sass("main.scss", 'public/css/', {includePaths: [paths.bootstrap + 'stylesheets/']})
      .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts/bootstrap/')
      .version(['public/js/all.js', 'public/css/main.css']);
});
