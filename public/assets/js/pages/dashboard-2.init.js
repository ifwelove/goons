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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/dashboard-2.init.js":
/*!************************************************!*\
  !*** ./resources/js/pages/dashboard-2.init.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Minton - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Dashboard 2
*/
function generateDayWiseTimeSeries(baseval, count, yrange) {
  var i = 0;
  var series = [];

  while (i < count) {
    var x = baseval;
    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    series.push([x, y]);
    baseval += 86400000;
    i++;
  }

  return series;
} //
// Area Chart
//


var options = {
  chart: {
    height: 320,
    type: 'area',
    stacked: true,
    toolbar: {
      show: false
    },
    events: {
      selection: function selection(chart, e) {
        console.log(new Date(e.xaxis.min));
      }
    }
  },
  colors: ['#3bafda', '#CED4DC'],
  dataLabels: {
    enabled: false
  },
  stroke: {
    width: [2],
    curve: 'smooth'
  },
  series: [{
    name: 'Direct',
    data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
      min: 100,
      max: 1500
    })
  }, {
    name: 'Affilliate',
    data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
      min: 100,
      max: 1000
    })
  }],
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.3,
      opacityTo: 0.9
    }
  },
  legend: {
    position: 'top',
    horizontalAlign: 'center'
  },
  xaxis: {
    type: 'datetime'
  },
  yaxis: {
    title: {
      text: 'Recent Signups',
      offsetX: -20,
      style: {
        color: undefined,
        fontSize: '13px',
        cssClass: 'apexcharts-yaxis-title'
      }
    }
  }
};
var chart = new ApexCharts(document.querySelector("#apex-area"), options);
chart.render(); //
// Pie Chart - 2
//

var options = {
  chart: {
    height: 320,
    type: 'donut'
  },
  series: [44, 55, 41, 15],
  legend: {
    show: true,
    position: 'bottom',
    horizontalAlign: 'center',
    verticalAlign: 'middle',
    floating: false,
    fontSize: '14px',
    offsetX: 0,
    offsetY: -10
  },
  labels: ["Series 1", "Series 2", "Series 3", "Series 4"],
  colors: ["#3bafda", "#26c6da", "#00b19d", "#d1dee4"],
  responsive: [{
    breakpoint: 600,
    options: {
      chart: {
        height: 210
      },
      legend: {
        show: false
      }
    }
  }]
};
var chart = new ApexCharts(document.querySelector("#apex-pie-2"), options);
chart.render(); // Vector map
//various examples

$('#world-map-markers').vectorMap({
  map: 'world_mill_en',
  normalizeFunction: 'polynomial',
  hoverOpacity: 0.7,
  hoverColor: false,
  regionStyle: {
    initial: {
      fill: '#d4dadd'
    }
  },
  markerStyle: {
    initial: {
      r: 9,
      'fill': '#1abc9c',
      'fill-opacity': 0.9,
      'stroke': '#fff',
      'stroke-width': 7,
      'stroke-opacity': 0.4
    },
    hover: {
      'stroke': '#fff',
      'fill-opacity': 1,
      'stroke-width': 1.5
    }
  },
  backgroundColor: 'transparent',
  markers: [{
    latLng: [41.90, 12.45],
    name: 'Vatican City'
  }, {
    latLng: [43.73, 7.41],
    name: 'Monaco'
  }, {
    latLng: [-0.52, 166.93],
    name: 'Nauru'
  }, {
    latLng: [-8.51, 179.21],
    name: 'Tuvalu'
  }, {
    latLng: [43.93, 12.46],
    name: 'San Marino'
  }, {
    latLng: [47.14, 9.52],
    name: 'Liechtenstein'
  }, {
    latLng: [7.11, 171.06],
    name: 'Marshall Islands'
  }, {
    latLng: [17.3, -62.73],
    name: 'Saint Kitts and Nevis'
  }, {
    latLng: [3.2, 73.22],
    name: 'Maldives'
  }, {
    latLng: [35.88, 14.5],
    name: 'Malta'
  }, {
    latLng: [12.05, -61.75],
    name: 'Grenada'
  }, {
    latLng: [13.16, -61.23],
    name: 'Saint Vincent and the Grenadines'
  }, {
    latLng: [13.16, -59.55],
    name: 'Barbados'
  }, {
    latLng: [17.11, -61.85],
    name: 'Antigua and Barbuda'
  }, {
    latLng: [-4.61, 55.45],
    name: 'Seychelles'
  }, {
    latLng: [7.35, 134.46],
    name: 'Palau'
  }, {
    latLng: [42.5, 1.51],
    name: 'Andorra'
  }, {
    latLng: [14.01, -60.98],
    name: 'Saint Lucia'
  }, {
    latLng: [6.91, 158.18],
    name: 'Federated States of Micronesia'
  }, {
    latLng: [1.3, 103.8],
    name: 'Singapore'
  }, {
    latLng: [0.33, 6.73],
    name: 'SÃ£o TomÃ© and PrÃ­ncipe'
  }]
});

/***/ }),

/***/ 1:
/*!******************************************************!*\
  !*** multi ./resources/js/pages/dashboard-2.init.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ponpon/ponpon/feixin/temp/test3/feixin_client/resources/js/pages/dashboard-2.init.js */"./resources/js/pages/dashboard-2.init.js");


/***/ })

/******/ });