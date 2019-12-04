class Article {
    constructor() {
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
            fixedSidebarOffset: 'auto',
        });

        this.initComments()
    }

    initComments() {
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
                success: (response) => {
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

        this.J_previewEditorBtn.on('click', event => {
            this.J_previewMarkdown.addClass('hide');
            this.J_textArea.removeClass('hide');
            this.J_previewEditorBtn.addClass('hide');
            this.J_previewBtn.removeClass('hide');
        })

        this.J_commentBtn.on('click', event => {
            if (this.J_textArea.val() === '') {
                return
            }

            $.ajax({
                type: 'POST',
                url: commentAPI,
                cache: false,
                dataType: 'json',
                data: {
                    article_id: this.J_textArea.data('article'),
                    parent_id: this.J_textArea.data('parentid'),
                    content: this.J_textArea.val()
                },
                success: (response) => {
                    console.log(response)
                    if (response.status === 0) {

                    }
                }
            })
        })
    }
}

new Article()
