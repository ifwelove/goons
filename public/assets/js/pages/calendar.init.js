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
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/calendar.init.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/calendar.init.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Calendar
*/
!function ($) {
  "use strict";

  var CalendarApp = function CalendarApp() {
    this.$body = $("body");
    this.$modal = $('#event-modal'), this.$event = '#external-events div.external-event', this.$calendar = $('#calendar'), this.$saveCategoryBtn = $('.save-category'), this.$categoryForm = $('#add-category form'), this.$extEvents = $('#external-events'), this.$calendarObj = null;
  };
  /* on drop */


  CalendarApp.prototype.onDrop = function (eventObj, date) {
    var $this = this; // retrieve the dropped element's stored Event Object

    var originalEventObject = eventObj.data('eventObject');
    var $categoryClass = eventObj.attr('data-class'); // we need to copy it, so that multiple events don't have a reference to the same object

    var copiedEventObject = $.extend({}, originalEventObject); // assign it the date that was reported

    copiedEventObject.start = date;
    if ($categoryClass) copiedEventObject['className'] = [$categoryClass]; // render the event on the calendar

    $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true); // is the "remove after drop" checkbox checked?

    if ($('#drop-remove').is(':checked')) {
      // if so, remove the element from the "Draggable Events" list
      eventObj.remove();
    }
  },
  /* on click on event */
  CalendarApp.prototype.onEventClick = function (calEvent, jsEvent, view) {
    var $this = this;
    var form = $("<form></form>");
    form.append("<label>Change event name</label>");
    form.append("<div class='input-group m-b-15'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-append'><button type='submit' class='btn btn-success btn-md  '><i class='fa fa-check'></i> Save</button></span></div>");
    $this.$modal.modal({
      backdrop: 'static'
    });
    $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
      $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
        return ev._id == calEvent._id;
      });
      $this.$modal.modal('hide');
    });
    $this.$modal.find('form').on('submit', function () {
      calEvent.title = form.find("input[type=text]").val();
      $this.$calendarObj.fullCalendar('updateEvent', calEvent);
      $this.$modal.modal('hide');
      return false;
    });
  },
  /* on select */
  CalendarApp.prototype.onSelect = function (start, end, allDay) {
    var $this = this;
    $this.$modal.modal({
      backdrop: 'static'
    });
    var form = $("<form></form>");
    form.append("<div class='row'></div>");
    form.find(".row").append("<div class='col-12'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>").append("<div class='col-12'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='bg-danger'>Danger</option>").append("<option value='bg-success'>Success</option>").append("<option value='bg-primary'>Primary</option>").append("<option value='bg-info'>Info</option>").append("<option value='bg-dark'>Dark</option>").append("<option value='bg-warning'>Warning</option></div></div>");
    $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
      form.submit();
    });
    $this.$modal.find('form').on('submit', function () {
      var title = form.find("input[name='title']").val();
      var beginning = form.find("input[name='beginning']").val();
      var ending = form.find("input[name='ending']").val();
      var categoryClass = form.find("select[name='category'] option:checked").val();

      if (title !== null && title.length != 0) {
        $this.$calendarObj.fullCalendar('renderEvent', {
          title: title,
          start: start,
          end: end,
          allDay: false,
          className: categoryClass
        }, true);
        $this.$modal.modal('hide');
      } else {
        alert('You have to give a title to your event');
      }

      return false;
    });
    $this.$calendarObj.fullCalendar('unselect');
  }, CalendarApp.prototype.enableDrag = function () {
    //init events
    $(this.$event).each(function () {
      // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
      // it doesn't need to have a start or end
      var eventObject = {
        title: $.trim($(this).text()) // use the element's text as the event title

      }; // store the Event Object in the DOM element so we can get to it later

      $(this).data('eventObject', eventObject); // make the event draggable using jQuery UI

      $(this).draggable({
        zIndex: 999,
        revert: true,
        // will cause the event to go back to its
        revertDuration: 0 //  original position after the drag

      });
    });
  };
  /* Initializing */

  CalendarApp.prototype.init = function () {
    this.enableDrag();
    /*  Initialize the calendar  */

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var form = '';
    var today = new Date($.now());
    var defaultEvents = [{
      title: 'Hey!',
      start: new Date($.now() + 158000000),
      className: 'bg-warning'
    }, {
      title: 'See John Deo',
      start: today,
      end: today,
      className: 'bg-success'
    }, {
      title: 'Meet John Deo',
      start: new Date($.now() + 168000000),
      className: 'bg-info'
    }, {
      title: 'Buy a Theme',
      start: new Date($.now() + 338000000),
      className: 'bg-primary'
    }];
    var $this = this;
    $this.$calendarObj = $this.$calendar.fullCalendar({
      slotDuration: '00:15:00',

      /* If we want to split day time each 15minutes */
      minTime: '08:00:00',
      maxTime: '19:00:00',
      defaultView: 'month',
      handleWindowResize: true,
      height: $(window).height() - 200,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      events: defaultEvents,
      editable: true,
      droppable: true,
      // this allows things to be dropped onto the calendar !!!
      eventLimit: true,
      // allow "more" link when too many events
      selectable: true,
      drop: function drop(date) {
        $this.onDrop($(this), date);
      },
      select: function select(start, end, allDay) {
        $this.onSelect(start, end, allDay);
      },
      eventClick: function eventClick(calEvent, jsEvent, view) {
        $this.onEventClick(calEvent, jsEvent, view);
      }
    }); //on new event

    this.$saveCategoryBtn.on('click', function () {
      var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
      var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();

      if (categoryName !== null && categoryName.length != 0) {
        $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>' + categoryName + '</div>');
        $this.enableDrag();
      }
    });
  }, //init CalendarApp
  $.CalendarApp = new CalendarApp(), $.CalendarApp.Constructor = CalendarApp;
}(window.jQuery), //initializing CalendarApp
function ($) {
  "use strict";

  $.CalendarApp.init();
}(window.jQuery);

/***/ }),

/***/ 37:
/*!***************************************************!*\
  !*** multi ./resources/js/pages/calendar.init.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/feixin/temp/test3/feixin_client/resources/js/pages/calendar.init.js */"./resources/js/pages/calendar.init.js");


/***/ })

/******/ });