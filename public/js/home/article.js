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
    this.J_commentList = $('#J_commentList'); // 文章id

    this._id = this.J_textArea.data('article'); // 当前登录的社交账号的userid

    this._socialiteUserID = this.J_textArea.data('userid') || '';
    this._currentPage = 1;
    this._totalPage = 0;
    this._commentsAPI = "/post/".concat(this._id, "/comments?current_page=").concat(this._currentPage);
    this._currentCommentAPI = '/comments/';
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
    this.fetchComments();
    this.initComments();
  }

  _createClass(Article, [{
    key: "fetchComments",
    value: function fetchComments() {
      var _this = this;

      $.ajax({
        type: 'GET',
        url: this._commentsAPI,
        cache: false,
        dataType: 'json',
        success: function success(response) {
          if (response.status === 0) {
            _this._totalPage = response.body.pagination.lastPage;
            response.body.list.map(function (value) {
              _this.J_commentList.append(_this.renderComment({
                id: value.id,
                userId: value.user.id,
                avatar: value.user.avatar,
                nick_name: value.user.nick_name,
                time: value.time,
                content: value.content
              }));
            });
          }
        }
      });
    }
  }, {
    key: "initComments",
    value: function initComments() {
      var _this2 = this;

      // 预览markdown
      this.J_previewBtn.on('click', function (event) {
        if (_this2.J_textArea.val() === '') {
          return;
        }

        $.ajax({
          type: 'POST',
          url: previewAPI,
          cache: false,
          dataType: 'json',
          data: {
            markdown: _this2.J_textArea.val()
          },
          success: function success(response) {
            if (response.status === 0) {
              _this2.J_previewMarkdown.html(response.body.content);

              _this2.J_previewMarkdown.removeClass('hide');

              _this2.J_textArea.addClass('hide');

              _this2.J_previewEditorBtn.removeClass('hide');

              _this2.J_previewBtn.addClass('hide');
            }
          }
        });
      }); // 编辑

      this.J_previewEditorBtn.on('click', function (event) {
        _this2.J_previewMarkdown.addClass('hide');

        _this2.J_textArea.removeClass('hide');

        _this2.J_previewEditorBtn.addClass('hide');

        _this2.J_previewBtn.removeClass('hide');
      }); // 提交评论

      this.J_commentBtn.on('click', function (event) {
        if (_this2.J_textArea.val() === '') {
          return;
        }

        $.ajax({
          type: 'POST',
          url: postCommentAPI,
          cache: false,
          dataType: 'json',
          data: {
            article_id: _this2.J_textArea.data('article'),
            // parent_id: this.J_textArea.data('parentid'),
            markdown: _this2.J_textArea.val()
          },
          success: function success(response) {
            if (response.status === 0) {
              _this2.J_commentList.prepend(_this2.renderComment({
                id: response.body.id,
                userId: response.body.user.id,
                avatar: response.body.user.avatar,
                nick_name: response.body.user.nick_name,
                time: response.body.time,
                content: response.body.content
              })); // 清空textarea


              _this2.J_textArea.val('');
            }
          }
        });
      }); // 回复某人评论

      this.J_commentList.on('click', '.J_replaybtn', function (event) {
        event.preventDefault();
        var currentID = $(event.target).data('id');
        var replayUserName = $(event.target).data('username');
        $.ajax({
          type: 'GET',
          dataType: 'json',
          cache: false,
          url: _this2._currentCommentAPI + currentID,
          success: function success(response) {
            if (response.status === 0) {
              // 回滚到文本框区域待开发
              $('html,body').animate({
                scrollTop: $(_this2.J_textArea).offset().top
              }, 'fast');
              var markdown = response.body.markdown;
              var converList = [];
              markdown.split('\n').map(function (item) {
                converList.push('> ' + item);
              });
              converList.push('\n');
              var replayHTML = "> [@".concat(replayUserName, "](https://github.com/").concat(replayUserName, ")\n") + converList.join('\n');

              _this2.J_textArea.val(replayHTML); // 改变parent_id
              // this.J_textArea.data('parentid',currentID);

            }
          }
        });
      });
      this.J_textArea.bind('input propertychange', function (event) {
        // 一旦清空了输入框内的所有内容,就要去掉父级的id
        if ($(event.target).val().length === 0) {
          _this2.J_textArea.data('parentid', 0);
        }
      });
    }
  }, {
    key: "renderComment",
    value: function renderComment(itemData) {
      var replayHtml = "<div class=\"icon-comments replay-btn J_replaybtn\" data-id=\"".concat(itemData.id, "\"  data-username = ").concat(itemData.nick_name, "></div>");

      if (this._socialiteUserID == itemData.userId) {
        replayHtml = '';
      }

      var commentItemHtml = "<div class=\"cm-comment-list-item\">\n                                <div class=\"avatar\">\n                                    <img src=\"".concat(itemData.avatar, "\" alt=\"\u5934\u50CF\">\n                                </div>\n                                <div class=\"comment-content\">\n                                    <div class=\"comment-header\">\n                                        <div class=\"left-panel\">\n                                            <a href=\"https://github.com/").concat(itemData.nick_name, "\" class=\"comment-username\">").concat(itemData.nick_name, "</a>\n                                            <span class=\"comment-text\">\u53D1\u8868\u4E8E</span>\n                                            <span class=\"comment-date\">").concat(itemData.time, "</span>\n                                        </div>\n                                        <div class=\"reply-panel\">\n                                            ").concat(replayHtml, "\n                                        </div>\n                                    </div>\n                                    <div class=\"comment-body markdown-body\">\n                                        ").concat(itemData.content, "\n                                    </div>\n                                </div>\n                            </div>");
      return commentItemHtml;
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