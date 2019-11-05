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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/jquery.todo.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/jquery.todo.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Todo widget
*/
!function ($) {
  "use strict";

  var TodoApp = function TodoApp() {
    this.$body = $("body"), this.$todoContainer = $('#todo-container'), this.$todoMessage = $("#todo-message"), this.$todoRemaining = $("#todo-remaining"), this.$todoTotal = $("#todo-total"), this.$archiveBtn = $("#btn-archive"), this.$todoList = $("#todo-list"), this.$todoDonechk = ".todo-done", this.$todoForm = $("#todo-form"), this.$todoInput = $("#todo-input-text"), this.$todoBtn = $("#todo-btn-submit"), this.$todoData = [{
      'id': '1',
      'text': 'Design One page theme',
      'done': false
    }, {
      'id': '2',
      'text': 'Build a js based app',
      'done': true
    }, {
      'id': '3',
      'text': 'Creating component page',
      'done': true
    }, {
      'id': '4',
      'text': 'Testing??',
      'done': true
    }, {
      'id': '5',
      'text': 'Hehe!! This is looks cool!',
      'done': false
    }, {
      'id': '6',
      'text': 'Create new version 3.0',
      'done': false
    }, {
      'id': '7',
      'text': 'Build an angular app',
      'done': true
    }];
    this.$todoCompletedData = [];
    this.$todoUnCompletedData = [];
  }; //mark/unmark - you can use ajax to save data on server side


  TodoApp.prototype.markTodo = function (todoId, complete) {
    for (var count = 0; count < this.$todoData.length; count++) {
      if (this.$todoData[count].id == todoId) {
        this.$todoData[count].done = complete;
      }
    }
  }, //adds new todo
  TodoApp.prototype.addTodo = function (todoText) {
    this.$todoData.push({
      'id': this.$todoData.length,
      'text': todoText,
      'done': false
    }); //regenerate list

    this.generate();
  }, //Archives the completed todos
  TodoApp.prototype.archives = function () {
    this.$todoUnCompletedData = [];

    for (var count = 0; count < this.$todoData.length; count++) {
      //geretaing html
      var todoItem = this.$todoData[count];

      if (todoItem.done == true) {
        this.$todoCompletedData.push(todoItem);
      } else {
        this.$todoUnCompletedData.push(todoItem);
      }
    }

    this.$todoData = [];
    this.$todoData = [].concat(this.$todoUnCompletedData); //regenerate todo list

    this.generate();
  }, //Generates todos
  TodoApp.prototype.generate = function () {
    //clear list
    this.$todoList.html("");
    var remaining = 0;

    for (var count = 0; count < this.$todoData.length; count++) {
      //geretaing html
      var todoItem = this.$todoData[count];
      if (todoItem.done == true) this.$todoList.prepend('<li class="list-group-item border-0 pl-1"><div class="checkbox checkbox-primary"><input class="todo-done" id="' + todoItem.id + '" type="checkbox" checked><label for="' + todoItem.id + '">' + todoItem.text + '</label></div></li>');else {
        remaining = remaining + 1;
        this.$todoList.prepend('<li class="list-group-item border-0 pl-1"><div class="checkbox checkbox-primary"><input class="todo-done" id="' + todoItem.id + '" type="checkbox"><label for="' + todoItem.id + '">' + todoItem.text + '</label></div></li>');
      }
    } //set total in ui


    this.$todoTotal.text(this.$todoData.length); //set remaining

    this.$todoRemaining.text(remaining);
  }, //init todo app
  TodoApp.prototype.init = function () {
    var $this = this; //generating todo list

    this.generate(); //binding archive

    this.$archiveBtn.on("click", function (e) {
      e.preventDefault();
      $this.archives();
      return false;
    }); //binding todo done chk

    $(document).on("change", this.$todoDonechk, function () {
      if (this.checked) $this.markTodo($(this).attr('id'), true);else $this.markTodo($(this).attr('id'), false); //regenerate list

      $this.generate();
    }); //binding the new todo button

    this.$todoBtn.on("click", function () {
      if ($this.$todoInput.val() == "" || typeof $this.$todoInput.val() == 'undefined' || $this.$todoInput.val() == null) {
        sweetAlert("Oops...", "You forgot to enter todo text", "error");
        $this.$todoInput.focus();
      } else {
        $this.addTodo($this.$todoInput.val());
      }
    });
  }, //init TodoApp
  $.TodoApp = new TodoApp(), $.TodoApp.Constructor = TodoApp;
}(window.jQuery), //initializing todo app
function ($) {
  "use strict";

  $.TodoApp.init();
}(window.jQuery);

/***/ }),

/***/ 4:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/jquery.todo.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/feixin/temp/test3/feixin_client/resources/js/pages/jquery.todo.js */"./resources/js/pages/jquery.todo.js");


/***/ })

/******/ });