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

/***/ "./node_modules/autosize/dist/autosize.js":
/*!************************************************!*\
  !*** ./node_modules/autosize/dist/autosize.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	autosize 4.0.2
	license: MIT
	http://www.jacklmoore.com/autosize
*/
(function (global, factory) {
	if (true) {
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [module, exports], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else { var mod; }
})(this, function (module, exports) {
	'use strict';

	var map = typeof Map === "function" ? new Map() : function () {
		var keys = [];
		var values = [];

		return {
			has: function has(key) {
				return keys.indexOf(key) > -1;
			},
			get: function get(key) {
				return values[keys.indexOf(key)];
			},
			set: function set(key, value) {
				if (keys.indexOf(key) === -1) {
					keys.push(key);
					values.push(value);
				}
			},
			delete: function _delete(key) {
				var index = keys.indexOf(key);
				if (index > -1) {
					keys.splice(index, 1);
					values.splice(index, 1);
				}
			}
		};
	}();

	var createEvent = function createEvent(name) {
		return new Event(name, { bubbles: true });
	};
	try {
		new Event('test');
	} catch (e) {
		// IE does not support `new Event()`
		createEvent = function createEvent(name) {
			var evt = document.createEvent('Event');
			evt.initEvent(name, true, false);
			return evt;
		};
	}

	function assign(ta) {
		if (!ta || !ta.nodeName || ta.nodeName !== 'TEXTAREA' || map.has(ta)) return;

		var heightOffset = null;
		var clientWidth = null;
		var cachedHeight = null;

		function init() {
			var style = window.getComputedStyle(ta, null);

			if (style.resize === 'vertical') {
				ta.style.resize = 'none';
			} else if (style.resize === 'both') {
				ta.style.resize = 'horizontal';
			}

			if (style.boxSizing === 'content-box') {
				heightOffset = -(parseFloat(style.paddingTop) + parseFloat(style.paddingBottom));
			} else {
				heightOffset = parseFloat(style.borderTopWidth) + parseFloat(style.borderBottomWidth);
			}
			// Fix when a textarea is not on document body and heightOffset is Not a Number
			if (isNaN(heightOffset)) {
				heightOffset = 0;
			}

			update();
		}

		function changeOverflow(value) {
			{
				// Chrome/Safari-specific fix:
				// When the textarea y-overflow is hidden, Chrome/Safari do not reflow the text to account for the space
				// made available by removing the scrollbar. The following forces the necessary text reflow.
				var width = ta.style.width;
				ta.style.width = '0px';
				// Force reflow:
				/* jshint ignore:start */
				ta.offsetWidth;
				/* jshint ignore:end */
				ta.style.width = width;
			}

			ta.style.overflowY = value;
		}

		function getParentOverflows(el) {
			var arr = [];

			while (el && el.parentNode && el.parentNode instanceof Element) {
				if (el.parentNode.scrollTop) {
					arr.push({
						node: el.parentNode,
						scrollTop: el.parentNode.scrollTop
					});
				}
				el = el.parentNode;
			}

			return arr;
		}

		function resize() {
			if (ta.scrollHeight === 0) {
				// If the scrollHeight is 0, then the element probably has display:none or is detached from the DOM.
				return;
			}

			var overflows = getParentOverflows(ta);
			var docTop = document.documentElement && document.documentElement.scrollTop; // Needed for Mobile IE (ticket #240)

			ta.style.height = '';
			ta.style.height = ta.scrollHeight + heightOffset + 'px';

			// used to check if an update is actually necessary on window.resize
			clientWidth = ta.clientWidth;

			// prevents scroll-position jumping
			overflows.forEach(function (el) {
				el.node.scrollTop = el.scrollTop;
			});

			if (docTop) {
				document.documentElement.scrollTop = docTop;
			}
		}

		function update() {
			resize();

			var styleHeight = Math.round(parseFloat(ta.style.height));
			var computed = window.getComputedStyle(ta, null);

			// Using offsetHeight as a replacement for computed.height in IE, because IE does not account use of border-box
			var actualHeight = computed.boxSizing === 'content-box' ? Math.round(parseFloat(computed.height)) : ta.offsetHeight;

			// The actual height not matching the style height (set via the resize method) indicates that 
			// the max-height has been exceeded, in which case the overflow should be allowed.
			if (actualHeight < styleHeight) {
				if (computed.overflowY === 'hidden') {
					changeOverflow('scroll');
					resize();
					actualHeight = computed.boxSizing === 'content-box' ? Math.round(parseFloat(window.getComputedStyle(ta, null).height)) : ta.offsetHeight;
				}
			} else {
				// Normally keep overflow set to hidden, to avoid flash of scrollbar as the textarea expands.
				if (computed.overflowY !== 'hidden') {
					changeOverflow('hidden');
					resize();
					actualHeight = computed.boxSizing === 'content-box' ? Math.round(parseFloat(window.getComputedStyle(ta, null).height)) : ta.offsetHeight;
				}
			}

			if (cachedHeight !== actualHeight) {
				cachedHeight = actualHeight;
				var evt = createEvent('autosize:resized');
				try {
					ta.dispatchEvent(evt);
				} catch (err) {
					// Firefox will throw an error on dispatchEvent for a detached element
					// https://bugzilla.mozilla.org/show_bug.cgi?id=889376
				}
			}
		}

		var pageResize = function pageResize() {
			if (ta.clientWidth !== clientWidth) {
				update();
			}
		};

		var destroy = function (style) {
			window.removeEventListener('resize', pageResize, false);
			ta.removeEventListener('input', update, false);
			ta.removeEventListener('keyup', update, false);
			ta.removeEventListener('autosize:destroy', destroy, false);
			ta.removeEventListener('autosize:update', update, false);

			Object.keys(style).forEach(function (key) {
				ta.style[key] = style[key];
			});

			map.delete(ta);
		}.bind(ta, {
			height: ta.style.height,
			resize: ta.style.resize,
			overflowY: ta.style.overflowY,
			overflowX: ta.style.overflowX,
			wordWrap: ta.style.wordWrap
		});

		ta.addEventListener('autosize:destroy', destroy, false);

		// IE9 does not fire onpropertychange or oninput for deletions,
		// so binding to onkeyup to catch most of those events.
		// There is no way that I know of to detect something like 'cut' in IE9.
		if ('onpropertychange' in ta && 'oninput' in ta) {
			ta.addEventListener('keyup', update, false);
		}

		window.addEventListener('resize', pageResize, false);
		ta.addEventListener('input', update, false);
		ta.addEventListener('autosize:update', update, false);
		ta.style.overflowX = 'hidden';
		ta.style.wordWrap = 'break-word';

		map.set(ta, {
			destroy: destroy,
			update: update
		});

		init();
	}

	function destroy(ta) {
		var methods = map.get(ta);
		if (methods) {
			methods.destroy();
		}
	}

	function update(ta) {
		var methods = map.get(ta);
		if (methods) {
			methods.update();
		}
	}

	var autosize = null;

	// Do nothing in Node.js environment and IE8 (or lower)
	if (typeof window === 'undefined' || typeof window.getComputedStyle !== 'function') {
		autosize = function autosize(el) {
			return el;
		};
		autosize.destroy = function (el) {
			return el;
		};
		autosize.update = function (el) {
			return el;
		};
	} else {
		autosize = function autosize(el, options) {
			if (el) {
				Array.prototype.forEach.call(el.length ? el : [el], function (x) {
					return assign(x, options);
				});
			}
			return el;
		};
		autosize.destroy = function (el) {
			if (el) {
				Array.prototype.forEach.call(el.length ? el : [el], destroy);
			}
			return el;
		};
		autosize.update = function (el) {
			if (el) {
				Array.prototype.forEach.call(el.length ? el : [el], update);
			}
			return el;
		};
	}

	exports.default = autosize;
	module.exports = exports['default'];
});

/***/ }),

/***/ "./resources/js/home/article.js":
/*!**************************************!*\
  !*** ./resources/js/home/article.js ***!
  \**************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var autosize__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! autosize */ "./node_modules/autosize/dist/autosize.js");
/* harmony import */ var autosize__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(autosize__WEBPACK_IMPORTED_MODULE_0__);
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
    this.J_updateCommentBtn = $('#J_updateCommentBtn');
    this.J_commentList = $('#J_commentList');
    this.J_commentNumber = $('#J_commentNumber');
    this.J_loadMoreBtn = $('#J_loadMoreBtn'); // 文章id

    this._id = this.J_textArea.data('article'); // 当前评论数

    this._currentCommentNum = Number(this.J_commentNumber.text()); // 当前登录的社交账号的userid

    this._socialiteUserID = this.J_textArea.data('userid') || '';
    this._currentPage = 1;
    this._totalPage = 0;
    this._replyUserID = 0; // 获取评论接口

    this._commentsAPI = "/post/".concat(this._id, "/comments"); // 获取当前评论接口

    this._currentCommentAPI = '/comments/'; // 编辑评论接口

    this._editCommentsAPI = '/comments/update/';
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
        url: this._commentsAPI + "?current_page=".concat(this._currentPage),
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

            if (_this._totalPage > 1 && _this._currentPage < _this._totalPage) {
              // 显示加载更多
              _this.J_loadMoreBtn.removeClass('hide');
            } else if (_this._totalPage == 1 || _this._currentPage >= _this._totalPage) {
              //隐藏加载更多
              _this.J_loadMoreBtn.addClass('hide');
            }
          }
        }
      });
    }
  }, {
    key: "initComments",
    value: function initComments() {
      var _this2 = this;

      autosize__WEBPACK_IMPORTED_MODULE_0___default()(this.J_textArea); // 预览markdown

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
            markdown: _this2.J_textArea.val(),
            replyId: _this2._replyUserID
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

              autosize__WEBPACK_IMPORTED_MODULE_0___default.a.update(_this2.J_textArea);

              _this2.J_previewMarkdown.html('');

              _this2._replyUserID = 0;

              _this2.J_previewEditorBtn.click();

              _this2.J_commentNumber.text(_this2._currentCommentNum + 1);
            }
          }
        });
      }); // 回复某人评论

      this.J_commentList.on('click', '.J_replaybtn', function (event) {
        event.preventDefault();
        var currentID = $(event.target).data('id');
        var replayUserName = $(event.target).data('username');
        _this2._replyUserID = $(event.target).data('userid');
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

              _this2.J_textArea.val(replayHTML);

              autosize__WEBPACK_IMPORTED_MODULE_0___default.a.update(_this2.J_textArea);

              _this2.J_textArea.scrollTop($('#J_textArea')[0].scrollHeight);
            }
          }
        });
      });
      this.J_textArea.bind('input propertychange', function (event) {
        // 如果textArea的内容为空则进行一些重置
        if ($(event.target).val().length === 0 && _this2._socialiteUserID != '') {
          _this2.J_updateCommentBtn.data('id', 0);

          _this2.J_updateCommentBtn.addClass('hide');

          _this2.J_commentBtn.removeClass('hide');

          _this2._replyUserID = 0;
        }
      }); // 加载更多

      this.J_loadMoreBtn.on('click', function (event) {
        _this2._currentPage++;

        _this2.fetchComments();
      }); // 编辑自己发过的评论

      this.J_commentList.on('click', '.J_editbtn', function (event) {
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

              _this2.J_textArea.val(markdown);

              autosize__WEBPACK_IMPORTED_MODULE_0___default.a.update(_this2.J_textArea);

              _this2.J_textArea.scrollTop($('#J_textArea')[0].scrollHeight);

              _this2.J_updateCommentBtn.data('id', currentID);

              _this2.J_updateCommentBtn.removeClass('hide');

              _this2.J_commentBtn.addClass('hide');
            }
          }
        });
      }); // 更新自己发表过的评论

      this.J_updateCommentBtn.on('click', function (event) {
        $.ajax({
          type: 'POST',
          url: _this2._editCommentsAPI + _this2.J_updateCommentBtn.data('id'),
          cache: false,
          dataType: 'json',
          data: {
            markdown: _this2.J_textArea.val()
          },
          success: function success(response) {
            if (response.status === 0) {
              _this2.J_updateCommentBtn.data('id', 0);

              _this2.J_updateCommentBtn.addClass('hide');

              _this2.J_commentBtn.removeClass('hide');

              _this2.J_textArea.val('');

              autosize__WEBPACK_IMPORTED_MODULE_0___default.a.update(_this2.J_textArea); // 更新对应dom的内容

              $(".comment-item".concat(response.body.id, " .comment-body")).html(response.body.content); // 滚动到更新后的内容

              $('html,body').animate({
                scrollTop: $(".comment-item".concat(response.body.id)).offset().top
              }, 'fast');
            }
          }
        });
      });
    }
  }, {
    key: "renderComment",
    value: function renderComment(itemData) {
      var replayHtml = "<div class=\"icon-comments replay-btn J_replaybtn\" data-id=\"".concat(itemData.id, "\" data-userid=\"").concat(itemData.userId, "\"  data-username = ").concat(itemData.nick_name, "></div>");

      if (this._socialiteUserID == itemData.userId) {
        replayHtml = "<div class=\"icon-edit edit-btn J_editbtn\" data-id=\"".concat(itemData.id, "\" data-userid=\"").concat(itemData.userId, "\" data-username = ").concat(itemData.nick_name, "></div>");
      }

      var commentItemHtml = "<div class=\"cm-comment-list-item comment-item".concat(itemData.id, "\">\n                                <div class=\"avatar\">\n                                    <img src=\"").concat(itemData.avatar, "\" alt=\"\u5934\u50CF\">\n                                </div>\n                                <div class=\"comment-content\">\n                                    <div class=\"comment-header\">\n                                        <div class=\"left-panel\">\n                                            <a href=\"https://github.com/").concat(itemData.nick_name, "\" class=\"comment-username\">").concat(itemData.nick_name, "</a>\n                                            <span class=\"comment-text\">\u53D1\u8868\u4E8E</span>\n                                            <span class=\"comment-date\">").concat(itemData.time, "</span>\n                                        </div>\n                                        <div class=\"reply-panel\">\n                                            ").concat(replayHtml, "\n                                        </div>\n                                    </div>\n                                    <div class=\"comment-body markdown-body\">\n                                        ").concat(itemData.content, "\n                                    </div>\n                                </div>\n                            </div>");
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