class Article {
    constructor() {
        this.J_previewBtn = $('#J_previewBtn');
        this.J_previewEditorBtn = $('#J_previewEditorBtn');
        this.J_textArea = $('#J_textArea');
        this.J_previewMarkdown = $('#J_previewMarkdown');
        this.J_commentBtn = $('#J_commentBtn');
        this.J_commentList = $('#J_commentList');
        // 文章id
        this._id = this.J_textArea.data('article');
        // 当前登录的社交账号的userid
        this._socialiteUserID = this.J_textArea.data('userid') || '';
        this._currentPage = 1;
        this._totalPage = 0;
        this._commentsAPI = `/post/${this._id}/comments?current_page=${this._currentPage}`
        this._currentCommentAPI = '/comments/';

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
    }

    fetchComments() {
        $.ajax({
            type: 'GET',
            url: this._commentsAPI,
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
                }
            }
        })
    }

    initComments() {
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
                    parent_id: this.J_textArea.data('parentid'),
                    markdown: this.J_textArea.val()
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
                    }
                }
            })
        })
        // 回复某人评论
        this.J_commentList.on('click','.J_replaybtn',event => {
            event.preventDefault();
            let currentID = $(event.target).data('id');
            let replayUserName = $(event.target).data('username');

            $.ajax({
                type: 'GET',
                dataType: 'json',
                cache: false,
                url: this._currentCommentAPI+currentID,
                success: response => {
                    if(response.status === 0) {
                        // 回滚到文本框区域待开发
                        $('html,body').animate({scrollTop: $(this.J_textArea).offset().top}, 'fast');

                        let markdown = response.body.markdown;
                        console.log(markdown)
                        let converList = []
                        markdown.split('\n').map(item => {
                            converList.push('> '+item);
                        })
                        let replayHTML = `> [@${replayUserName}](https://github.com/${replayUserName})\n`+converList.join('\n');

                        this.J_textArea.val(replayHTML);
                        // 改变parent_id
                        this.J_textArea.data('parentid',currentID);
                    }
                }
            })
        })

        this.J_textArea.bind('input propertychange',event=> {
            console.log('textArea value----',$(event.target).val().length);
            // 一旦清空了输入框内的所有内容,就要去掉父级的id
            if ($(event.target).val().length === 0) {
                this.J_textArea.data('parentid',0);
            }
        })
    }

    renderComment(itemData) {
        let replayHtml = `<div class="icon-comments replay-btn J_replaybtn" data-id="${itemData.id}"  data-username = ${itemData.nick_name}></div>`;
        if(this._socialiteUserID == itemData.userId) {
            replayHtml = '';
        }
        let commentItemHtml = `<div class="cm-comment-list-item">
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
}

new Article()
