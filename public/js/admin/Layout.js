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

/***/ "./resources/js/admin/Layout.js":
/*!**************************************!*\
  !*** ./resources/js/admin/Layout.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------
 * AdminLTE Layout.js
 * License MIT
 * --------------------------------------------
 */
var Layout = function ($) {
  /**
   * Constants
   * ====================================================
   */
  var NAME = 'Layout';
  var DATA_KEY = 'lte.layout';
  var EVENT_KEY = ".".concat(DATA_KEY);
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var Event = {
    SIDEBAR: 'sidebar'
  };
  var Selector = {
    HEADER: '.main-header',
    MAIN_SIDEBAR: '.main-sidebar',
    SIDEBAR: '.main-sidebar .sidebar',
    CONTENT: '.content-wrapper',
    BRAND: '.brand-link',
    CONTENT_HEADER: '.content-header',
    WRAPPER: '.wrapper',
    CONTROL_SIDEBAR: '.control-sidebar',
    LAYOUT_FIXED: '.layout-fixed',
    FOOTER: '.main-footer'
  };
  var ClassName = {
    HOLD: 'hold-transition',
    SIDEBAR: 'main-sidebar',
    CONTENT_FIXED: 'content-fixed',
    SIDEBAR_FOCUSED: 'sidebar-focused',
    LAYOUT_FIXED: 'layout-fixed',
    NAVBAR_FIXED: 'layout-navbar-fixed',
    FOOTER_FIXED: 'layout-footer-fixed'
  };
  var Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'l'
  };
  /**
   * Class Definition
   * ====================================================
   */

  var Layout =
  /*#__PURE__*/
  function () {
    function Layout(element, config) {
      _classCallCheck(this, Layout);

      this._config = config;
      this._element = element;

      this._init();
    } // Public


    _createClass(Layout, [{
      key: "fixLayoutHeight",
      value: function fixLayoutHeight() {
        var heights = {
          window: $(window).height(),
          header: $(Selector.HEADER).outerHeight(),
          footer: $(Selector.FOOTER).outerHeight(),
          sidebar: $(Selector.SIDEBAR).height()
        };

        var max = this._max(heights);

        if ($('body').hasClass(ClassName.LAYOUT_FIXED)) {
          $(Selector.CONTENT).css('min-height', max - heights.header - heights.footer); // $(Selector.SIDEBAR).css('min-height', max - heights.header)

          if (typeof $.fn.overlayScrollbars !== 'undefined') {
            $(Selector.SIDEBAR).overlayScrollbars({
              className: this._config.scrollbarTheme,
              sizeAutoCapable: true,
              scrollbars: {
                autoHide: this._config.scrollbarAutoHide,
                clickScrolling: true
              }
            });
          }
        } else {
          if (heights.window > heights.sidebar) {
            $(Selector.CONTENT).css('min-height', heights.window - heights.header - heights.footer);
          } else {
            $(Selector.CONTENT).css('min-height', heights.sidebar - heights.header);
          }
        }
      } // Private

    }, {
      key: "_init",
      value: function _init() {
        var _this = this;

        // Enable transitions
        $('body').removeClass(ClassName.HOLD); // Activate layout height watcher

        this.fixLayoutHeight();
        $(Selector.SIDEBAR).on('collapsed.lte.treeview expanded.lte.treeview collapsed.lte.pushmenu expanded.lte.pushmenu', function () {
          _this.fixLayoutHeight();
        });
        $(window).resize(function () {
          _this.fixLayoutHeight();
        });
        $('body, html').css('height', 'auto');
      }
    }, {
      key: "_max",
      value: function _max(numbers) {
        // Calculate the maximum number in a list
        var max = 0;
        Object.keys(numbers).forEach(function (key) {
          if (numbers[key] > max) {
            max = numbers[key];
          }
        });
        return max;
      } // Static

    }], [{
      key: "_jQueryInterface",
      value: function _jQueryInterface(config) {
        return this.each(function () {
          var data = $(this).data(DATA_KEY);

          var _config = $.extend({}, Default, $(this).data());

          if (!data) {
            data = new Layout($(this), _config);
            $(this).data(DATA_KEY, data);
          }

          if (config === 'init') {
            data[config]();
          }
        });
      }
    }]);

    return Layout;
  }();
  /**
   * Data API
   * ====================================================
   */


  $(window).on('load', function () {
    Layout._jQueryInterface.call($('body'));
  });
  $(Selector.SIDEBAR + ' a').on('focusin', function () {
    $(Selector.MAIN_SIDEBAR).addClass(ClassName.SIDEBAR_FOCUSED);
  });
  $(Selector.SIDEBAR + ' a').on('focusout', function () {
    $(Selector.MAIN_SIDEBAR).removeClass(ClassName.SIDEBAR_FOCUSED);
  });
  /**
   * jQuery API
   * ====================================================
   */

  $.fn[NAME] = Layout._jQueryInterface;
  $.fn[NAME].Constructor = Layout;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Layout._jQueryInterface;
  };

  return Layout;
}(jQuery);

/* harmony default export */ __webpack_exports__["default"] = (Layout);

/***/ }),

/***/ "./resources/sass/admin/admin.scss":
/*!*****************************************!*\
  !*** ./resources/sass/admin/admin.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/home/home.scss":
/*!***************************************!*\
  !*** ./resources/sass/home/home.scss ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!**************************************************************************************************************!*\
  !*** multi ./resources/js/admin/Layout.js ./resources/sass/admin/admin.scss ./resources/sass/home/home.scss ***!
  \**************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/admin/code/abianji/resources/js/admin/Layout.js */"./resources/js/admin/Layout.js");
__webpack_require__(/*! /Users/admin/code/abianji/resources/sass/admin/admin.scss */"./resources/sass/admin/admin.scss");
module.exports = __webpack_require__(/*! /Users/admin/code/abianji/resources/sass/home/home.scss */"./resources/sass/home/home.scss");


/***/ })

/******/ });