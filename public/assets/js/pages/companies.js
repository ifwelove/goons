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
/******/ 	return __webpack_require__(__webpack_require__.s = 36);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/companies.js":
/*!*****************************************!*\
  !*** ./resources/js/pages/companies.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Companies
*/
$(document).ready(function () {
  var DrawSparkline = function DrawSparkline() {
    $('#company-1').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
      type: 'line',
      width: "100%",
      height: '80',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59, 175, 218, 0.1)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#company-2').sparkline([0, 25, 48, 32, 36, 20, 85, 56, 36], {
      type: 'line',
      width: "100%",
      height: '80',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59, 175, 218, 0.1)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#company-3').sparkline([0, 36, 85, 25, 24, 56, 24, 28, 32], {
      type: 'line',
      width: "100%",
      height: '80',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59, 175, 218, 0.1)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#company-4').sparkline([21, 28, 30, 35, 44, 82, 30, 37, 40], {
      type: 'line',
      width: "100%",
      height: '80',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59, 175, 218, 0.1)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#company-5').sparkline([32, 28, 35, 89, 10, 15, 25, 37, 45], {
      type: 'line',
      width: "100%",
      height: '80',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59, 175, 218, 0.1)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#company-6').sparkline([10, 25, 35, 35, 65, 75, 56, 37, 40], {
      type: 'line',
      width: "100%",
      height: '80',
      chartRangeMax: 50,
      lineColor: '#3bafda',
      fillColor: 'rgba(59, 175, 218, 0.1)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
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

/***/ 36:
/*!***********************************************!*\
  !*** multi ./resources/js/pages/companies.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/js/pages/companies.js */"./resources/js/pages/companies.js");


/***/ })

/******/ });