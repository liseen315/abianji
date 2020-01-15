import autosize from 'autosize';

class Article {
    constructor() {
        this.J_previewBtn = $('#J_previewBtn');
        this.J_previewEditorBtn = $('#J_previewEditorBtn');
        this.J_textArea = $('#J_textArea');
        this.J_previewMarkdown = $('#J_previewMarkdown');
        this.J_commentBtn = $('#J_commentBtn');
        this.J_updateCommentBtn = $('#J_updateCommentBtn');
        this.J_commentList = $('#J_commentList');
        this.J_commentNumber = $('#J_commentNumber');
        this.J_loadMoreBtn = $('#J_loadMoreBtn');
        // 文章id
        this._id = this.J_textArea.data('article');
        // 当前评论数
        this._currentCommentNum = Number(this.J_commentNumber.text());
        // 当前登录的社交账号的userid
        this._socialiteUserID = this.J_textArea.data('userid') || '';
        this._currentPage = 1;
        this._totalPage = 0;
        this._replyUserID = 0;
        // 获取评论接口
        this._commentsAPI = `/post/${this._id}/comments`
        // 获取当前评论接口
        this._currentCommentAPI = '/comments/';
        // 编辑评论接口
        this._editCommentsAPI = '/comments/update/';


        tocbot.init({
            tocSelector: '.tocbot',
            contentSelector: '.article-entry',
            headingSelector: 'h1, h2, h3, h4, h5, h6',
            hasInnerContainers: true,
            scrollSmooth: true,
            positionFixedSelector: '.tocbot',
            positionFixedClass: 'is-position-fixed',
            fixedSidebarOffset: 'auto',
        });
        this.fetchComments()
        this.initComments()
        this.initShare()
    }

    fetchComments() {
        $.ajax({
            type: 'GET',
            url: this._commentsAPI + `?current_page=${this._currentPage}`,
            cache: false,
            dataType: 'json',
            success: (response) => {
                if (response.status === 0) {
                    this._totalPage = response.body.pagination.lastPage;

                    response.body.list.map(value => {
                        this.J_commentList.append(this.renderComment({
                            id: value.id,
                            userId: value.user.id,
                            avatar: value.user.avatar,
                            nick_name: value.user.nick_name,
                            time: value.time,
                            content: value.content
                        }))
                    })

                    if (this._totalPage > 1 && this._currentPage < this._totalPage) {
                        // 显示加载更多
                        this.J_loadMoreBtn.removeClass('hide');
                    } else if (this._totalPage == 1 || this._currentPage >= this._totalPage) {
                        //隐藏加载更多
                        this.J_loadMoreBtn.addClass('hide');
                    }
                }
            }
        })
    }

    initComments() {
        autosize(this.J_textArea);
        // 预览markdown
        this.J_previewBtn.on('click', event => {

            if (this.J_textArea.val() === '') {
                return
            }
            $.ajax({
                type: 'POST',
                url: previewAPI,
                cache: false,
                dataType: 'json',
                data: {markdown: this.J_textArea.val()},
                success: response => {
                    if (response.status === 0) {
                        this.J_previewMarkdown.html(response.body.content);
                        this.J_previewMarkdown.removeClass('hide');
                        this.J_textArea.addClass('hide');
                        this.J_previewEditorBtn.removeClass('hide');
                        this.J_previewBtn.addClass('hide')
                    }
                }
            })
        })
        // 编辑
        this.J_previewEditorBtn.on('click', event => {
            this.J_previewMarkdown.addClass('hide');
            this.J_textArea.removeClass('hide');
            this.J_previewEditorBtn.addClass('hide');
            this.J_previewBtn.removeClass('hide');
        })
        // 提交评论
        this.J_commentBtn.on('click', event => {
            if (this.J_textArea.val() === '') {
                return
            }

            $.ajax({
                type: 'POST',
                url: postCommentAPI,
                cache: false,
                dataType: 'json',
                data: {
                    article_id: this.J_textArea.data('article'),
                    markdown: this.J_textArea.val(),
                    replyId: this._replyUserID,
                },
                success: response => {
                    if (response.status === 0) {
                        this.J_commentList.prepend(this.renderComment({
                            id: response.body.id,
                            userId: response.body.user.id,
                            avatar: response.body.user.avatar,
                            nick_name: response.body.user.nick_name,
                            time: response.body.time,
                            content: response.body.content
                        }));
                        // 清空textarea
                        this.J_textArea.val('');
                        autosize.update(this.J_textArea);
                        this.J_previewMarkdown.html('');
                        this._replyUserID = 0;
                        this.J_previewEditorBtn.click();
                        this.J_commentNumber.text(this._currentCommentNum + 1);
                    } else if (response.status === 4001) {
                        layer.msg(response.msg, {time: 1000});
                    } else if (response.status === 1001) {
                        layer.msg(response.msg, {time: 1000});
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000)

                    }
                }
            })
        })
        // 回复某人评论
        this.J_commentList.on('click', '.J_replaybtn', event => {
            event.preventDefault();
            let currentID = $(event.target).data('id');
            let replayUserName = $(event.target).data('username');
            this._replyUserID = $(event.target).data('userid');
            $.ajax({
                type: 'GET',
                dataType: 'json',
                cache: false,
                url: this._currentCommentAPI + currentID,
                success: response => {
                    if (response.status === 0) {
                        // 回滚到文本框区域待开发
                        $('html,body').animate({scrollTop: $(this.J_textArea).offset().top}, 'fast');

                        let markdown = response.body.markdown;
                        let converList = []
                        markdown.split('\n').map(item => {
                            converList.push('> ' + item);
                        })
                        converList.push('\n');
                        let replayHTML = `> [@${replayUserName}](https://github.com/${replayUserName})\n` + converList.join('\n');

                        this.J_textArea.val(replayHTML);
                        autosize.update(this.J_textArea);
                        this.J_textArea.scrollTop($('#J_textArea')[0].scrollHeight);
                    }
                }
            })
        })

        this.J_textArea.bind('input propertychange', event => {
            // 如果textArea的内容为空则进行一些重置
            if ($(event.target).val().length === 0 && this._socialiteUserID != '') {
                this.J_updateCommentBtn.data('id', 0);
                this.J_updateCommentBtn.addClass('hide');
                this.J_commentBtn.removeClass('hide');
                this._replyUserID = 0;
            }
        })

        // 加载更多
        this.J_loadMoreBtn.on('click', event => {
            this._currentPage++;
            this.fetchComments();
        })
        // 编辑自己发过的评论
        this.J_commentList.on('click', '.J_editbtn', event => {
            event.preventDefault();
            let currentID = $(event.target).data('id');
            let replayUserName = $(event.target).data('username');

            $.ajax({
                type: 'GET',
                dataType: 'json',
                cache: false,
                url: this._currentCommentAPI + currentID,
                success: response => {
                    if (response.status === 0) {
                        // 回滚到文本框区域待开发
                        $('html,body').animate({scrollTop: $(this.J_textArea).offset().top}, 'fast');
                        let markdown = response.body.markdown;
                        this.J_textArea.val(markdown);
                        autosize.update(this.J_textArea);
                        this.J_textArea.scrollTop($('#J_textArea')[0].scrollHeight);
                        this.J_updateCommentBtn.data('id', currentID);
                        this.J_updateCommentBtn.removeClass('hide');
                        this.J_commentBtn.addClass('hide');
                    }
                }
            })
        })
        // 更新自己发表过的评论
        this.J_updateCommentBtn.on('click', event => {

            $.ajax({
                type: 'POST',
                url: this._editCommentsAPI + this.J_updateCommentBtn.data('id'),
                cache: false,
                dataType: 'json',
                data: {
                    markdown: this.J_textArea.val()
                },
                success: response => {
                    if (response.status === 0) {
                        this.J_updateCommentBtn.data('id', 0);
                        this.J_updateCommentBtn.addClass('hide');
                        this.J_commentBtn.removeClass('hide');
                        this.J_textArea.val('');
                        autosize.update(this.J_textArea);
                        // 更新对应dom的内容
                        $(`.comment-item${response.body.id} .comment-body`).html(response.body.content);
                        // 滚动到更新后的内容
                        $('html,body').animate({scrollTop: $(`.comment-item${response.body.id}`).offset().top}, 'fast');
                    }
                }
            })
        })
    }

    renderComment(itemData) {
        let replayHtml = `<div class="icon-comments replay-btn J_replaybtn" data-id="${itemData.id}" data-userid="${itemData.userId}"  data-username = ${itemData.nick_name}></div>`;
        if (this._socialiteUserID == itemData.userId) {
            replayHtml = `<div class="icon-edit edit-btn J_editbtn" data-id="${itemData.id}" data-userid="${itemData.userId}" data-username = ${itemData.nick_name}></div>`;
        }
        let commentItemHtml = `<div class="cm-comment-list-item comment-item${itemData.id}">
                                <div class="avatar">
                                    <img src="${itemData.avatar}" alt="头像">
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <div class="left-panel">
                                            <a href="https://github.com/${itemData.nick_name}" class="comment-username">${itemData.nick_name}</a>
                                            <span class="comment-text">发表于</span>
                                            <span class="comment-date">${itemData.time}</span>
                                        </div>
                                        <div class="reply-panel">
                                            ${replayHtml}
                                        </div>
                                    </div>
                                    <div class="comment-body markdown-body">
                                        ${itemData.content}
                                    </div>
                                </div>
                            </div>`;
        return commentItemHtml;
    }

    initShare() {
        $('body').on('click','.article-share-link',event => {
            event.stopPropagation();
            let targetShareBtn = event.target;
            let url = $(targetShareBtn).data('url');
            let encodeUrl = encodeURIComponent(url);
            let id = 'article-share-box-' + $(targetShareBtn).data('id');
            let offset = $(targetShareBtn).offset();
            if ($('#' + id).length) {
                let box = $('#' + id)
                if (box.hasClass('on')) {
                    box.removeClass('on');
                }else {
                    box.addClass('on');
                }
            }else {
                let windowHTML = this.createShareWindow(id,url,encodeUrl)
                let shareWindow = $(windowHTML);
                $('body').append(shareWindow);
                shareWindow.css({
                    top: offset.top+25,
                    left: offset.left
                }).addClass('on');
            }
        })

        $('body').on('click',event => {
            event.stopPropagation();
            $('.article-share-box').removeClass('on');
        })
    }

    createShareWindow(id,url,encodeUrl) {
        let windowHtml = `
        <div id="${id}" class="article-share-box">
            <input class="article-share-input" value="${url}">
            <div class="article-share-links">
                <a href="https://twitter.com/intent/tweet?url=${encodeUrl}" class="article-share-twitter" target="_blank" title="Twitter"></a>
                <a href="https://www.facebook.com/sharer.php?u=${encodeUrl}" class="article-share-facebook" target="_blank" title="Facebook"></a>
                <a href="http://pinterest.com/pin/create/button/?url=${encodeUrl}" class="article-share-pinterest" target="_blank" title="Pinterest"></a>
                <a href="https://plus.google.com/share?url=${encodeUrl}" class="article-share-google" target="_blank" title="Google+"></a>
            </div>
        </div>
        `
        return windowHtml;
    }
}

new Article()
