let mix = require('laravel-mix');
const fs = require("fs");

//mix.js('src/app.js', 'dist').setPublicPath('dist');


fs.readdirSync("scss/").forEach(fileName =>
    mix.sass(`scss/${fileName}`, "dist/css"));
