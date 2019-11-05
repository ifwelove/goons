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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/toastr.init.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/toastr.init.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Toastr init js
*/
!function ($) {
  'use strict';

  var NotificationApp = function NotificationApp() {};
  /**
   * Send Notification
   * @param {*} heading heading text
   * @param {*} body body text
   * @param {*} position position e.g top-right, top-left, bottom-left, etc
   * @param {*} loaderBgColor loader background color
   * @param {*} icon icon which needs to be displayed
   * @param {*} hideAfter automatically hide after seconds
   * @param {*} stack 
   */


  NotificationApp.prototype.send = function (heading, body, position, loaderBgColor, icon, hideAfter, stack, showHideTransition) {
    // default      
    if (!hideAfter) hideAfter = 3000;
    if (!stack) stack = 1;
    var options = {
      heading: heading,
      text: body,
      position: position,
      loaderBg: loaderBgColor,
      icon: icon,
      hideAfter: hideAfter,
      stack: stack
    };
    if (showHideTransition) options.showHideTransition = showHideTransition;
    console.log(options);
    $.toast().reset('all');
    $.toast(options);
  }, $.NotificationApp = new NotificationApp(), $.NotificationApp.Constructor = NotificationApp;
}(window.jQuery), //initializing main application module
function ($) {
  "use strict"; // notification examples

  $("#toastr-one").on('click', function (e) {
    $.NotificationApp.send("Heads up!", "This alert needs your attention, but it is not super important.", 'top-right', '#3b98b5', 'info');
  });
  $("#toastr-two").on('click', function (e) {
    $.NotificationApp.send("Heads up!", "Check below fields please.", 'top-center', '#da8609', 'warning');
  });
  $("#toastr-three").on('click', function (e) {
    $.NotificationApp.send("Well Done!", "You successfully read this important alert message", 'top-right', '#5ba035', 'success');
  });
  $("#toastr-four").on('click', function (e) {
    $.NotificationApp.send("Oh snap!", "Change a few things up and try submitting again.", 'top-right', '#bf441d', 'error');
  });
  $("#toastr-five").on('click', function (e) {
    $.NotificationApp.send("How to contribute?", ['Fork the repository', 'Improve/extend the functionality', 'Create a pull request'], 'top-right', '#1ea69a', 'info');
  });
  $("#toastr-six").on('click', function (e) {
    $.NotificationApp.send("Can I add <em>icons</em>?", "Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>update</a>.", 'top-right', '#1ea69a', 'info', false);
  });
  $("#toastr-seven").on('click', function (e) {
    $.NotificationApp.send("", "Set the `hideAfter` property to false and the toast will become sticky.", 'top-right', '#1ea69a', '');
  });
  $("#toastr-eight").on('click', function (e) {
    $.NotificationApp.send("", "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.", 'top-right', '#1ea69a', 'info', 3000, 1, 'fade');
  });
  $("#toastr-nine").on('click', function (e) {
    $.NotificationApp.send("Slide transition", "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.", 'top-right', '#1ea69a', 'info', 3000, 1, 'slide');
  });
  $("#toastr-ten").on('click', function (e) {
    $.NotificationApp.send("Plain transition", "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.", 'top-right', '#3b98b5', 'info', 3000, 1, 'plain');
  });
}(window.jQuery);

/***/ }),

/***/ 2:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/toastr.init.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/js/pages/toastr.init.js */"./resources/js/pages/toastr.init.js");


/***/ })

/******/ });