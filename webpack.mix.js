const mix = require('laravel-mix');
const lodash = require("lodash");
const folder = {
    src: "resources/", // source files
    dist: "public/", // build files
    dist_assets: "public/assets/" //build assets files
};


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


var assets = {
    js: [
        "./node_modules/jquery/dist/jquery.js",
        "./node_modules/bootstrap/dist/js/bootstrap.bundle.js",
        "./node_modules/metismenu/dist/metisMenu.js",
        "./node_modules/jquery-slimscroll/jquery.slimscroll.js",
        "./node_modules/node-waves/dist/waves.js",
        "./node_modules/waypoints/lib/jquery.waypoints.min.js",
        "./node_modules/jquery.counterup/jquery.counterup.min.js"
    ]
};

//copying required assets
lodash(assets).forEach(function (asset, type) {
    var js = [];
    for (let i = 0; i < asset.length; ++i) {
            js.push(asset[i]);
    };
    mix.combine(js, folder.dist_assets + "js/vendor.js").minify(folder.dist_assets + "js/vendor.js");
});

var third_party_assets = {
    css_js: [
        { "name": "custombox", "assets": ["./node_modules/custombox/dist/custombox.min.js", "./node_modules/custombox/dist/custombox.min.css"] },
            { "name": "jquery-toast", "assets": ["./node_modules/jquery-toast-plugin/dist/jquery.toast.min.js", "./node_modules/jquery-toast-plugin/dist/jquery.toast.min.css"] },
            { "name": "moment", "assets": ["./node_modules/moment/min/moment.min.js"] },
            { "name": "jquery-scrollto", "assets": ["./node_modules/jquery.scrollto/jquery.scrollTo.min.js"] },
            { "name": "sweetalert2", "assets": ["./node_modules/sweetalert2/dist/sweetalert2.min.js", "./node_modules/sweetalert2/dist/sweetalert2.min.css"] },
            { "name": "jquery-sparkline", "assets": ["./node_modules/jquery-sparkline/jquery.sparkline.min.js"] },
            { "name": "jquery-knob", "assets": ["./node_modules/jquery-knob/dist/jquery.knob.min.js"] },
            { "name": "nestable2", "assets": ["./node_modules/nestable2/dist/jquery.nestable.min.js", "./node_modules/nestable2/dist/jquery.nestable.min.css"] },
            { "name": "treeview", "assets": ["./node_modules/jstree/dist/jstree.min.js", "./node_modules/jstree/dist/themes/default/style.css"] },
            { "name": "ion-rangeslider", "assets": ["./node_modules/ion-rangeslider/js/ion.rangeSlider.min.js", "./node_modules/ion-rangeslider/css/ion.rangeSlider.css"] },
            { "name": "bootstrap-tagsinput", "assets": ["./node_modules/@adactive/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js", "./node_modules/@adactive/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"] },
            { "name": "sweetalert2", "assets": ["./node_modules/sweetalert2/dist/sweetalert2.min.js", "./node_modules/sweetalert2/dist/sweetalert2.min.css"] },
            { "name": "multiselect", "assets": ["./node_modules/multiselect/js/jquery.multi-select.js", "./node_modules/multiselect/css/multi-select.css"] },
            { "name": "jquery-quicksearch", "assets": ["./node_modules/jquery.quicksearch/dist/jquery.quicksearch.min.js"] },
            { "name": "select2", "assets": ["./node_modules/select2/dist/js/select2.min.js", "./node_modules/select2/dist/css/select2.min.css"] },
            { "name": "switchery", "assets": ["./node_modules/mohithg-switchery/dist/switchery.min.js", "./node_modules/mohithg-switchery/dist/switchery.min.css"] },
            { "name": "jquery-mask-plugin", "assets": ["./node_modules/jquery-mask-plugin/dist/jquery.mask.min.js"] },
            { "name": "bootstrap-touchspin", "assets": ["./node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js", "./node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"] },
            { "name": "bootstrap-colorpicker", "assets": ["./node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js", "./node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"] },
            { "name": "clockpicker", "assets": ["./node_modules/clockpicker/dist/bootstrap-clockpicker.min.js", "./node_modules/clockpicker/dist/bootstrap-clockpicker.min.css"] },
            { "name": "bootstrap-datepicker", "assets": ["./node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js", "./node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"] },
            { "name": "bootstrap-daterangepicker", "assets": ["./node_modules/bootstrap-daterangepicker/daterangepicker.js", "./node_modules/bootstrap-daterangepicker/daterangepicker.css"] },
            { "name": "bootstrap-select", "assets": ["./node_modules/bootstrap-select/dist/js/bootstrap-select.min.js", "./node_modules/bootstrap-select/dist/css/bootstrap-select.min.css"] },
            { "name": "parsleyjs", "assets": ["./node_modules/parsleyjs/dist/parsley.min.js"] },
            { "name": "summernote", "assets": ["./node_modules/summernote/dist/summernote-bs4.min.js", "./node_modules/summernote/dist/summernote-bs4.css"] },
            { "name": "twitter-bootstrap-wizard", "assets": ["./node_modules/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"] },
            { "name": "katex", "assets": ["./node_modules/katex/dist/katex.min.js"] },
            { "name": "jquery-ui", "assets": ["./node_modules/jquery-ui/jquery-ui.min.js"] },
            { "name": "fullcalendar", "assets": ["./node_modules/fullcalendar/dist/fullcalendar.min.js", "./node_modules/fullcalendar/dist/fullcalendar.min.css"] },
            {
                "name": "quill", "assets": ["./node_modules/quill/dist/quill.min.js", "./node_modules/quill/dist/quill.core.css",
                    "./node_modules/quill/dist/quill.bubble.css",
                    "./node_modules/quill/dist/quill.snow.css"]
            },
            {
                "name": "datatables", "assets": ["./node_modules/datatables.net/js/jquery.dataTables.min.js",
                    "./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js",
                    "./node_modules/datatables.net-responsive/js/dataTables.responsive.min.js",
                    "./node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js",
                    "./node_modules/datatables.net-buttons/js/dataTables.buttons.min.js",
                    "./node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js",
                    "./node_modules/datatables.net-buttons/js/buttons.html5.min.js",
                    "./node_modules/datatables.net-buttons/js/buttons.flash.min.js",
                    "./node_modules/datatables.net-buttons/js/buttons.print.min.js",
                    "./node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js",
                    "./node_modules/datatables.net-select/js/dataTables.select.min.js",
                    "./node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css",
                    "./node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css",
                    "./node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css",
                    "./node_modules/datatables.net-select-bs4/css/select.bootstrap4.css"]
            },
            { "name": "tablesaw", "assets": ["./node_modules/tablesaw/dist/tablesaw.js", "./node_modules/tablesaw/dist/tablesaw.css"] },
            { "name": "jquery-tabledit", "assets": ["./node_modules/jquery-tabledit/jquery.tabledit.min.js"] },
            { "name": "rwd-table", "assets": ["./node_modules/admin-resources/rwd-table/rwd-table.min.js", "./node_modules/admin-resources/rwd-table/rwd-table.min.css"] },
            { "name": "footable", "assets": ["./node_modules/footable/dist/footable.all.min.js", "./node_modules/footable/css/footable.core.min.css"] },
            { "name": "pdfmake", "assets": ["./node_modules/pdfmake/build/pdfmake.min.js", "./node_modules/pdfmake/build/vfs_fonts.js"] },
            { "name": "dropzone", "assets": ["./node_modules/dropzone/dist/min/dropzone.min.js", "./node_modules/dropzone/dist/min/dropzone.min.css"] },
            { "name": "x-editable", "assets": ["./node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js", "./node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css"] },
            {
                "name": "flot-charts", "assets": ["./node_modules/flot-charts/jquery.flot.js",
                    "./node_modules/flot-charts/jquery.flot.time.js",
                    "./node_modules/flot-charts/jquery.flot.resize.js",
                    "./node_modules/flot-charts/jquery.flot.pie.js",
                    "./node_modules/flot-charts/jquery.flot.selection.js",
                    "./node_modules/flot-charts/jquery.flot.stack.js",
                    "./node_modules/flot-charts/jquery.flot.crosshair.js",
                    "./node_modules/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js",
                    "./node_modules/flot-orderbars/js/jquery.flot.orderBars.js"]
            },
            { "name": "apexcharts", "assets": ["./node_modules/apexcharts/dist/apexcharts.min.js"] },
            { "name": "raphael", "assets": ["./node_modules/raphael/raphael.min.js"] },
            { "name": "morris-js", "assets": ["./node_modules/morris.js/morris.min.js"] },
            { "name": "chart-js", "assets": ["./node_modules/chart.js/dist/Chart.bundle.min.js"] },
            { "name": "d3", "assets": ["./node_modules/d3/dist/d3.min.js"] },
            { "name": "c3", "assets": ["./node_modules/c3/c3.min.js", "./node_modules/c3/c3.min.css"] },
            { "name": "peity", "assets": ["./node_modules/peity/jquery.peity.min.js"] },
            { "name": "chartist", "assets": ["./node_modules/chartist/dist/chartist.min.js", "./node_modules/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js", "./node_modules/chartist/dist/chartist.min.css"] },
            { "name": "gmaps", "assets": ["./node_modules/gmaps/gmaps.min.js"] },
            {
                "name": "jquery-vectormap", "assets": ["./node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-au-mill-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-il-chicago-mill-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-in-mill-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-uk-mill-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-ca-lcc-en.js",
                    "./node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"]
            },
            {
                "name": "jquery-mapael", "assets": ["./node_modules/jquery-mapael/js/jquery.mapael.min.js",
                    "./node_modules/jquery-mapael/js/maps/world_countries.min.js",
                    "./node_modules/jquery-mapael/js/maps/usa_states.min.js"]
            },
            { "name": "jquery-countdown", "assets": ["./node_modules/jquery-countdown/dist/jquery.countdown.min.js"] },
            { "name": "magnific-popup", "assets": ["./node_modules/magnific-popup/dist/jquery.magnific-popup.min.js", "./node_modules/magnific-popup/dist/magnific-popup.css"] },
            { "name": "hopscotch", "assets": ["./node_modules/hopscotch/dist/js/hopscotch.min.js", "./node_modules/hopscotch/dist/css/hopscotch.min.css"] },
        ]
};

//copying third party assets
lodash(third_party_assets).forEach(function (assets, type) {
    if (type == "css_js") {
        lodash(assets).forEach(function (plugin) {
            var name = plugin['name'],
                assetlist = plugin['assets'],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset) {
                var ass = asset.split(',');
                for (let i = 0; i < ass.length; ++i) {
                    if(ass[i].substr(ass[i].length - 3)  == ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                };
            });
            if(js.length > 0){
                mix.combine(js, folder.dist_assets + "/libs/" + name + "/" + name + ".min.js");
            }
            if(css.length > 0){
                mix.combine(css, folder.dist_assets + "/libs/" + name + "/" + name + ".min.css");
            }
        });
    }
});

// copy all fonts
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

var out = folder.dist_assets + "data";
mix.copyDirectory(folder.src + "data", out);

// copy all images
var out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images", out);

mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
// mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/icons.css");
// mix.sass('resources/scss/app-rtl.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app-rtl.css");
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app.css");

//copying demo pages related assets
// var app_pages_assets = {
//     js: [
//         folder.src + "js/pages/program.js"
//     ]
// };

// var out = folder.dist_assets + "js/";
// lodash(app_pages_assets).forEach(function (assets, type) {
//     for (let i = 0; i < assets.length; ++i) {
//         mix.js(assets[i], out + "pages");
//     };
// });


mix.combine('resources/js/app.js', folder.dist_assets + "js/app.min.js");

mix
    .js('resources/js/pages/program.js', 'public/js')
//     .js('resources/js/main.js', 'public/js')

// mix.extract(['vue', 'lodash', 'axios'])
