/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 31);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/sparkline.init.js":
/*!**********************************************!*\
  !*** ./resources/js/pages/sparkline.init.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Sparkline charts init js
*/
$(document).ready(function () {
  var DrawSparkline = function DrawSparkline() {
    $('#sparkline1').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
      type: 'line',
      width: "100%",
      height: '165',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59,175,218,0.3)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#sparkline1').sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
      type: 'line',
      width: "100%",
      height: '165',
      chartRangeMax: 40,
      lineColor: '#1abc9c',
      fillColor: 'rgba(26, 188, 156, 0.3)',
      composite: true,
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#sparkline2').sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
      type: 'bar',
      height: '165',
      barWidth: '10',
      barSpacing: '3',
      barColor: '#3bafda'
    });
    $('#sparkline3').sparkline([20, 40, 30, 10], {
      type: 'pie',
      width: '165',
      height: '165',
      sliceColors: ['#e3eaef', '#3bafda', '#333333', '#00b19d']
    });
    $('#sparkline4').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
      type: 'line',
      width: "100%",
      height: '165',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'transparent',
      lineWidth: 2,
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false
    });
    $('#sparkline4').sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
      type: 'line',
      width: "100%",
      height: '165',
      chartRangeMax: 40,
      lineColor: '#f672a7',
      fillColor: 'transparent',
      composite: true,
      lineWidth: 2,
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      highlightLineColor: 'rgba(0,0,0,1)',
      highlightSpotColor: 'rgba(0,0,0,1)'
    });
    $('#sparkline6').sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
      type: 'line',
      width: "100%",
      height: '165',
      lineColor: '#e3eaef',
      lineWidth: 2,
      fillColor: 'rgba(227,234,239,0.3)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)'
    });
    $('#sparkline6').sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
      type: 'bar',
      height: '165',
      barWidth: '10',
      barSpacing: '5',
      composite: true,
      barColor: '#6c757d'
    });
    $("#sparkline7").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7], {
      type: 'discrete',
      width: '280',
      height: '165',
      lineColor: '#323a46'
    });
    $('#sparkline8').sparkline([10, 12, 12, 9, 7], {
      type: 'bullet',
      width: '280',
      height: '80',
      targetColor: '#64c5b1',
      performanceColor: '#5553ce'
    });
    $('#sparkline9').sparkline([4, 27, 34, 52, 54, 59, 61, 68, 78, 82, 85, 87, 91, 93, 100], {
      type: 'box',
      width: '280',
      height: '80',
      boxLineColor: '#5553ce',
      boxFillColor: '#e3eaef',
      whiskerColor: '#32c861',
      outlierLineColor: '#c17d7d',
      medianColor: '#22e535',
      lineWidth: 2,
      targetColor: '#316b1d'
    });
    $('#sparkline10').sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
      height: '80',
      width: '100%',
      type: 'tristate',
      posBarColor: '#0acf97',
      negBarColor: '#e3eaef',
      zeroBarColor: '#ff679b',
      barWidth: 8,
      barSpacing: 3,
      zeroAxis: false
    });
  },
      DrawMouseSpeed = function DrawMouseSpeed() {
    var mrefreshinterval = 500; // update display every 500ms

    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;

      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }

      lastmousex = mousex;
      lastmousey = mousey;
    });

    var mdraw = function mdraw() {
      var md = new Date();
      var timenow = md.getTime();

      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max) mpoints.splice(0, 1);
        mousetravel = 0;
        $('#sparkline5').sparkline(mpoints, {
          tooltipSuffix: ' pixels per second',
          type: 'line',
          width: "100%",
          height: '165',
          chartRangeMax: 77,
          maxSpotColor: false,
          minSpotColor: false,
          spotColor: false,
          lineWidth: 1,
          lineColor: '#1abc9c',
          fillColor: 'rgba(26, 188, 156, 0.3)',
          highlightLineColor: 'rgba(24,147,126,.1)',
          highlightSpotColor: 'rgba(24,147,126,.2)'
        });
      }

      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    }; // We could use setInterval instead, but I prefer to do it this way


    setTimeout(mdraw, mrefreshinterval);
  };

  DrawSparkline();
  DrawMouseSpeed();
  var resizeChart;
  $(window).resize(function (e) {
    clearTimeout(resizeChart);
    resizeChart = setTimeout(function () {
      DrawSparkline();
      DrawMouseSpeed();
    }, 300);
  });
});

/***/ }),

/***/ 31:
/*!****************************************************!*\
  !*** multi ./resources/js/pages/sparkline.init.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/js/pages/sparkline.init.js */"./resources/js/pages/sparkline.init.js");


/***/ })

/******/ });