let project_folder = "public";
//let project_folder = require("path").basename(__dirname);   //имя папки совпадает с названием проекта
let source_folder = "src";
let fs = require('fs');                                       //для подключения шрифтов

let path = {
    build: {
        html: project_folder + "/",
        php: project_folder + "/",
        css: project_folder + "/css/",
        js: project_folder + "/javascript/",
        img: project_folder + "/images/",
        fonts: project_folder + "/fonts/",
    },
    src: {
        html: [source_folder + "/*.html", "!" + source_folder + "/_*.html"],
        php: [source_folder + "/index.php"],
        css: source_folder + "/scss/style.scss",
        js: source_folder + "/javascript/script.js",
        img: source_folder + "/images/**/*.{jpg,png,gif,ico}",
        fonts: source_folder + "/fonts/*.ttf",
    },
    watch: {
        html: source_folder + "/**/*.html",
        php: source_folder + "/**/*.php",
        css: source_folder + "/scss/**/*.scss",
        js: source_folder + "/javascript/**/*.js",
        img: source_folder + "/images/**/*.{jpg,png,gif,ico}",
    },
    clean: "./" + project_folder + "/"
}

const { src, dest, series, parallel, watch } = require('gulp'),
    gulp         = require('gulp'),
    browsersync  = require('browser-sync').create(),
    fileinclude  = require('gulp-file-include'),                         //подключает файлы с помощью @@include('_header.html')
    del          = require('del'),
    scss         = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    group_media  = require('gulp-group-css-media-queries'),              //собирает media в один скоп и размещает в конце файла
    clean_css    = require('gulp-clean-css'),
    rename       = require('gulp-rename'),
    uglify       = require('gulp-uglify-es').default,
    // плагин babel для работы скриптов в старых браузерах
    imagemin     = require('gulp-imagemin'),
    // webp         = require('gulp-webp'),                                  //конвертация изображений в формат webp
    // webphtml     = require('gulp-webp-html'),                             //подключение изображений webp к html, функция добавляется к html
    // webpcss      = require('gulp-webpcss'),                               //задание стилей для изображения webp, функция добавляется к css
    //для правильной работы webpcss нужен npm install webp-converter@2.2.3 --save-dev
    //для подключения webp, в js находится код
    svgSprite    = require('gulp-svg-sprite'),
    ttf2woff     = require('gulp-ttf2woff'),
    ttf2woff2    = require('gulp-ttf2woff2'),
    fonter       = require('gulp-fonter'),                                //для шрифтов .otf
    concat       = require('gulp-concat'),
    newer        = require('gulp-newer'),
    svgmin       = require('gulp-svgmin'),
    cheerio      = require('gulp-cheerio'),
    replace      = require('gulp-replace');

function browserSync() {
    browsersync.init({
        server: {
            baseDir: "./" + project_folder + "/"
        },
        port: 3000,
        browser: 'chrome',
        notify: false
    })
}

function html() {
    return src(path.src.html)
        .pipe(fileinclude())
        .pipe(dest(path.build.html))
        .pipe(browsersync.stream())
}

function php() {
    return src(path.src.php)
        .pipe(fileinclude())
        .pipe(dest(path.build.php))
        .pipe(browsersync.stream())
}

function css() {
    return src(path.src.css)
        .pipe(
            scss({
                outputStyle: "expanded"
            })
        )
        .pipe(group_media())
        .pipe(autoprefixer({
            overrideBrowserslist: ["last 5 version"],
            cascade: true
        }))
        .pipe(dest(path.build.css))
        .pipe(clean_css())
        .pipe(rename({
            extname: '.min.css'
        }))
        .pipe(dest(path.build.css))
        .pipe(browsersync.stream())
}
function copy() {
    src([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/bootstrap/dist/css/bootstrap.min.css.map',
    ])
    .pipe(dest(path.build.css))
    return src([
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map',
        path.src.js
    ])
    .pipe(dest(path.build.js))
}

function js() {
    src(path.src.js)
    .pipe(dest(path.build.js))
    return src([
            'node_modules/jquery/dist/jquery.min.js',
            path.src.js
        ])
        .pipe(concat('script.min.js'))
        .pipe(uglify())
        .pipe(dest(path.build.js))
        .pipe(browsersync.stream())
}

function img() {
    return src(path.src.img)
        .pipe(newer(path.build.img))
        .pipe(imagemin({}))
        .pipe(dest(path.build.img))
        .pipe(browsersync.stream())
}

function fonts() {
    src(path.src.fonts)
        .pipe(ttf2woff())
        .pipe(dest(path.build.fonts))
    return src(path.src.fonts)
        .pipe(ttf2woff2())
        .pipe(dest(path.build.fonts))
}

gulp.task('otf2ttf', function () {
    return src([source_folder + '/fonts/*.otf'])
        .pipe(fonter({
            formats: ['ttf']
        }))
        .pipe(dest(source_folder + '/fonts/'))
})

function svg() {
    return src(source_folder + '/images/**/*.svg')
        .pipe(svgmin({
            js2svg: {
                pretty: true
            }
        }))
        .pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
                $('[stroke]').removeAttr('stroke');
                $('[style]').removeAttr('style');
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(replace('&gt;', '>'))
        // build svg sprite
        .pipe(svgSprite({
            mode: {
                symbol: {
                    sprite: "sprite.svg"
                }
            }
        }))
        .pipe(dest(path.build.img));
};

function fontsStyle() {                                                        //необходимо создать файл fonts.scss, подключить его, создать миксин
    let file_content = fs.readFileSync(source_folder + '/scss/fonts.scss');    //после сборки нужно в файле fonts.scss исправить названия, жирность
    if (file_content == '') {                                                  //курсор в файле fonts.scc должен стоять на 1 строчке
        fs.writeFile(source_folder + '/scss/fonts.scss', '', cb);
        return fs.readdir(path.build.fonts, function (err, items) {
            if (items) {
                let c_fontname;
                for (var i = 0; i < items.length; i++) {
                    let fontname = items[i].split('.');
                    fontname = fontname[0];
                    if (c_fontname != fontname) {
                        fs.appendFile(source_folder + '/scss/fonts.scss', '@include font("' + fontname + '", "' + fontname + '", "400", "normal");\r\n', cb);
                    }
                    c_fontname = fontname;
                }
            }
        })
    }
}

function cb() {

}

function watchFiles() {
    watch([path.watch.html], html);
    watch([path.watch.php], php);
    watch([path.watch.css], css);
    watch([path.watch.js], js);
    watch([path.watch.img], img);
}

function clean() {
    return del(path.clean);
}

exports.js          = js;
exports.browserSync = browserSync;
exports.css         = css;
exports.img         = img;
exports.svg         = svg;
exports.clean       = clean;

let build = series(clean,parallel(js, html, php, css, copy, img, fonts, svg), fontsStyle)
exports.default = parallel(build, watchFiles, browserSync)










