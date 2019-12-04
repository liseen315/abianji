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

/***/ "./resources/js/home/article.js":
/*!**************************************!*\
  !*** ./resources/js/home/article.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Article =
/*#__PURE__*/
function () {
  function Article() {
    _classCallCheck(this, Article);

    this.J_previewBtn = $('#J_previewBtn');
    this.J_previewEditorBtn = $('#J_previewEditorBtn');
    this.J_textArea = $('#J_textArea');
    this.J_previewMarkdown = $('#J_previewMarkdown');
    this.J_commentBtn = $('#J_commentBtn');
    this.J_commentList = $('#J_commentList');
    tocbot.init({
      tocSelector: '.tocbot',
      contentSelector: '.article-entry',
      headingSelector: 'h1, h2, h3, h4, h5, h6',
      hasInnerContainers: true,
      scrollSmooth: true,
      positionFixedSelector: '.tocbot',
      positionFixedClass: 'is-position-fixed',
      fixedSidebarOffset: 'auto'
    });
    this.initComments();
  }

  _createClass(Article, [{
    key: "initComments",
    value: function initComments() {
      var _this = this;

      this.J_previewBtn.on('click', function (event) {
        if (_this.J_textArea.val() === '') {
          return;
        }

        $.ajax({
          type: 'POST',
          url: previewAPI,
          cache: false,
          dataType: 'json',
          data: {
            markdown: _this.J_textArea.val()
          },
          success: function success(response) {
            if (response.status === 0) {
              _this.J_previewMarkdown.html(response.body.content);

              _this.J_previewMarkdown.removeClass('hide');

              _this.J_textArea.addClass('hide');

              _this.J_previewEditorBtn.removeClass('hide');

              _this.J_previewBtn.addClass('hide');
            }
          }
        });
      });
      this.J_previewEditorBtn.on('click', function (event) {
        _this.J_previewMarkdown.addClass('hide');

        _this.J_textArea.removeClass('hide');

        _this.J_previewEditorBtn.addClass('hide');

        _this.J_previewBtn.removeClass('hide');
      });
      this.J_commentBtn.on('click', function (event) {
        if (_this.J_textArea.val() === '') {
          return;
        }

        $.ajax({
          type: 'POST',
          url: commentAPI,
          cache: false,
          dataType: 'json',
          data: {
            article_id: _this.J_textArea.data('article'),
            parent_id: _this.J_textArea.data('parentid'),
            content: _this.J_textArea.val()
          },
          success: function success(response) {
            console.log(response);

            if (response.status === 0) {}
          }
        });
      });
    }
  }]);

  return Article;
}();

new Article();

/***/ }),

/***/ 4:
/*!********************************************!*\
  !*** multi ./resources/js/home/article.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/admin/code/abianji/resources/js/home/article.js */"./resources/js/home/article.js");


/***/ })

/******/ });