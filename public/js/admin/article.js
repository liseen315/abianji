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

/***/ "./resources/js/admin/article.js":
/*!***************************************!*\
  !*** ./resources/js/admin/article.js ***!
  \***************************************/
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

    this.upLoadFile = null;
    this.J_ImgFile = $('#J_ImgFile');
    this.J_previewText = $('.J_previewText');
    this.J_coverLabel = $('.J_coverLabel');
    this.J_browseBox = $('.J_browseBox');
    this.J_optionBox = $('.J_optionBox');
    this.J_delBtn = $('.J_delBtn');
    this.J_uploadBtn = $('.J_uploadBtn');
    this.loadingModal = $('#loadingModal');
    this.J_inputCover = $('.J_inputCover');
    this.J_previewBox = $('.J_previewBox');
    this.initSelect2();
    this.initMarkDown();
    this.initCover();
  }

  _createClass(Article, [{
    key: "initSelect2",
    value: function initSelect2() {
      $('.select2').select2({
        theme: 'bootstrap4',
        tags: true,
        tokenSeparators: [",", " "],
        createTag: function createTag(newTag) {
          return {
            id: 'new:' + newTag.term,
            text: newTag.term + ' (new)'
          };
        }
      });
    }
  }, {
    key: "initMarkDown",
    value: function initMarkDown() {
      editormd.urls.atLinkBase = "https://abianji.com";
      editormd("J_articleContent", {
        autoFocus: false,
        width: "100%",
        height: 720,
        toc: true,
        todoList: true,
        placeholder: "{{ 'Enter article content' }}",
        toolbarAutoFixed: false,
        path: editormdPath,
        emoji: true,
        toolbarIcons: ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'code', 'code-block', 'table', 'html-entities', 'watch', 'preview', 'search'],
        imageUpload: true,
        imageUploadURL: ''
      });
    }
  }, {
    key: "initCover",
    value: function initCover() {
      var _this = this;

      if (this.J_inputCover.val().trim() != '') {
        this.J_previewText.hide();
        this.renderPreviewContent(this.J_inputCover.val());
        this.J_browseBox.hide();
        this.J_optionBox.addClass('d-flex').show();
        this.J_uploadBtn.hide();
      }

      this.J_ImgFile.on('change', function (event) {
        _this.J_previewText.hide();

        _this.upLoadFile = event.target.files[0];

        _this.showPreview(_this.upLoadFile);

        _this.J_coverLabel.val(_this.upLoadFile.name);

        $('.J_previewContent').remove();

        _this.J_browseBox.hide();

        _this.J_optionBox.addClass('d-flex').show();

        _this.J_uploadBtn.show();
      });
      this.J_delBtn.on('click', function () {
        _this.upLoadFile = null;

        _this.J_previewText.show();

        $('.J_previewContent').remove();

        _this.J_coverLabel.val('');

        _this.J_inputCover.val('');

        _this.J_optionBox.removeClass('d-flex').hide();

        _this.J_browseBox.show();
      });
      this.J_uploadBtn.on('click', function () {
        var formData = new FormData();
        formData.append('cover_img', _this.upLoadFile);

        _this.loadingModal.modal({
          backdrop: 'static',
          keyboard: false
        });

        $.ajax({
          type: 'POST',
          url: imgUpLoadPath,
          cache: false,
          contentType: false,
          processData: false,
          data: formData,
          success: function success(response) {
            _this.loadingModal.modal('hide');

            if (response.status == 0) {
              _this.J_inputCover.val(response.body.imgURL);

              _this.J_coverLabel.val(response.body.imgURL);

              toastr.success(response.msg);
            } else {
              toastr.error(response.msg);
            }
          }
        });
      });
    }
  }, {
    key: "showPreview",
    value: function showPreview(file) {
      var _this2 = this;

      this.J_coverLabel.val(file.name);
      var reader = new FileReader();

      reader.onload = function (e) {
        _this2.renderPreviewContent(e.target.result);
      };

      reader.readAsDataURL(file);
    }
  }, {
    key: "renderPreviewContent",
    value: function renderPreviewContent(result) {
      var html = "<div class=\"preview-content J_previewContent\"><img src=\"".concat(result, "\" alt=\"\"></div>");
      this.J_previewBox.append(html);
    }
  }]);

  return Article;
}();

new Article();

/***/ }),

/***/ 3:
/*!*********************************************!*\
  !*** multi ./resources/js/admin/article.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/admin/code/abianji/resources/js/admin/article.js */"./resources/js/admin/article.js");


/***/ })

/******/ });