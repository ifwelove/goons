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
/******/ 	return __webpack_require__(__webpack_require__.s = 23);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/foo-tables.init.js":
/*!***********************************************!*\
  !*** ./resources/js/pages/foo-tables.init.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Footables
*/
$(window).on('load', function () {
  // Row Toggler
  // -----------------------------------------------------------------
  $('#demo-foo-row-toggler').footable(); // Accordion
  // -----------------------------------------------------------------

  $('#demo-foo-accordion').footable().on('footable_row_expanded', function (e) {
    $('#demo-foo-accordion tbody tr.footable-detail-show').not(e.row).each(function () {
      $('#demo-foo-accordion').data('footable').toggleDetail(this);
    });
  }); // Pagination
  // -----------------------------------------------------------------

  $('#demo-foo-pagination').footable();
  $('#demo-show-entries').change(function (e) {
    e.preventDefault();
    var pageSize = $(this).val();
    $('#demo-foo-pagination').data('page-size', pageSize);
    $('#demo-foo-pagination').trigger('footable_initialized');
  }); // Filtering
  // -----------------------------------------------------------------

  var filtering = $('#demo-foo-filtering');
  filtering.footable().on('footable_filtering', function (e) {
    var selected = $('#demo-foo-filter-status').find(':selected').val();
    e.filter += e.filter && e.filter.length > 0 ? ' ' + selected : selected;
    e.clear = !e.filter;
  }); // Filter status

  $('#demo-foo-filter-status').change(function (e) {
    e.preventDefault();
    filtering.trigger('footable_filter', {
      filter: $(this).val()
    });
  }); // Search input

  $('#demo-foo-search').on('input', function (e) {
    e.preventDefault();
    filtering.trigger('footable_filter', {
      filter: $(this).val()
    });
  }); // Add & Remove Row
  // -----------------------------------------------------------------

  var addrow = $('#demo-foo-addrow');
  addrow.footable().on('click', '.demo-delete-row', function () {
    //get the footable object
    var footable = addrow.data('footable'); //get the row we are wanting to delete

    var row = $(this).parents('tr:first'); //delete the row

    footable.removeRow(row);
  }); // Search input

  $('#demo-input-search2').on('input', function (e) {
    e.preventDefault();
    addrow.trigger('footable_filter', {
      filter: $(this).val()
    });
  }); // Add Row Button

  $('#demo-btn-addrow').click(function () {
    //get the footable object
    var footable = addrow.data('footable'); //build up the row we are wanting to add

    var newRow = '<tr><td style="text-align: center;"><button class="demo-delete-row btn btn-danger btn-xs btn-icon"><i class="fa fa-times"></i></button></td><td>Adam</td><td>Doe</td><td>Traffic Court Referee</td><td>22 Jun 1972</td><td><span class="badge label-table badge-success   ">Active</span></td></tr>'; //add it

    footable.appendRow(newRow);
  });
});

/***/ }),

/***/ 23:
/*!*****************************************************!*\
  !*** multi ./resources/js/pages/foo-tables.init.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/feixin/temp/test3/feixin_client/resources/js/pages/foo-tables.init.js */"./resources/js/pages/foo-tables.init.js");


/***/ })

/******/ });