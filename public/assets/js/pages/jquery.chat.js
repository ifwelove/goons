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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/jquery.chat.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/jquery.chat.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Chat init js
*/
!function ($) {
  "use strict";

  var ChatApp = function ChatApp() {
    this.$body = $("body"), this.$chatInput = $('.chat-input'), this.$chatList = $('.conversation-list'), this.$chatSendBtn = $('.chat-send');
  }; //saves chat entry - You should send ajax call to server in order to save chat enrty


  ChatApp.prototype.save = function () {
    var chatText = this.$chatInput.val();
    var chatTime = moment().format("h:mm");

    if (chatText == "") {
      sweetAlert("Oops...", "You forgot to enter your chat message", "error");
      this.$chatInput.focus();
    } else {
      $('<li class="clearfix odd"><div class="chat-avatar"><img src="assets/images/users/avatar-1.jpg" alt="male"><i>' + chatTime + '</i></div><div class="conversation-text"><div class="ctext-wrap"><i>Geneva</i><p>' + chatText + '</p></div></div></li>').appendTo('.conversation-list');
      this.$chatInput.val('');
      this.$chatInput.focus();
      this.$chatList.scrollTo('100%', '100%', {
        easing: 'swing'
      });
    }
  }, ChatApp.prototype.init = function () {
    var $this = this; //binding keypress event on chat input box - on enter we are adding the chat into chat list - 

    $this.$chatInput.keypress(function (ev) {
      var p = ev.which;

      if (p == 13) {
        $this.save();
        return false;
      }
    }); //binding send button click

    $this.$chatSendBtn.click(function (ev) {
      $this.save();
      return false;
    });
  }, //init ChatApp
  $.ChatApp = new ChatApp(), $.ChatApp.Constructor = ChatApp;
}(window.jQuery), //initializing main application module
function ($) {
  "use strict";

  $.ChatApp.init();
}(window.jQuery);

/***/ }),

/***/ 3:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/jquery.chat.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/goons/resources/js/pages/jquery.chat.js */"./resources/js/pages/jquery.chat.js");


/***/ })

/******/ });