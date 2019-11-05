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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/dashboard-1.init.js":
/*!************************************************!*\
  !*** ./resources/js/pages/dashboard-1.init.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Dashboard 1
*/
$(document).ready(function () {
  var DrawSparkline = function DrawSparkline() {
    $('#sparkline1').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
      type: 'line',
      width: "100%",
      height: 210,
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
      height: '210',
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
    $('#sparkline2').sparkline([[70, 40], [90, 50], [100, 150], [140, 80], [50, 90], [80, 120], [130, 80], [90, 70], [80, 50], [120, 130], [120, 100], [140, 110]], {
      type: 'bar',
      height: '210',
      barWidth: '15',
      barSpacing: '3',
      stackedBarColor: ['#3bafda', '#e3eaef']
    });
    $('#sparkline3').sparkline([20, 40, 30], {
      type: 'pie',
      width: '210',
      height: '210',
      sliceColors: ['#e3eaef', '#3bafda', '#00b19d']
    });
  };

  DrawSparkline();
  var resizeChart;
  $(window).resize(function (e) {
    clearTimeout(resizeChart);
    resizeChart = setTimeout(function () {
      DrawSparkline();
    }, 300);
  });
});

/***/ }),

/***/ "./resources/scss/app-rtl.scss":
/*!*************************************!*\
  !*** ./resources/scss/app-rtl.scss ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/bootstrap.scss":
/*!***************************************!*\
  !*** ./resources/scss/bootstrap.scss ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/icons.scss":
/*!***********************************!*\
  !*** ./resources/scss/icons.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!**************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/pages/dashboard-1.init.js ./resources/scss/bootstrap.scss ./resources/scss/icons.scss ./resources/scss/app-rtl.scss ./resources/scss/app.scss ***!
  \**************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/js/pages/dashboard-1.init.js */"./resources/js/pages/dashboard-1.init.js");
__webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/scss/bootstrap.scss */"./resources/scss/bootstrap.scss");
__webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/scss/icons.scss */"./resources/scss/icons.scss");
__webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/scss/app-rtl.scss */"./resources/scss/app-rtl.scss");
module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/scss/app.scss */"./resources/scss/app.scss");


/***/ })

/******/ });