import SimpleMDE from 'simplemde'

class Article {

    constructor() {
        this.upLoadFile = null
        this.J_ImgFile = $('#J_ImgFile')
        this.J_previewText = $('.J_previewText')
        this.J_coverLabel = $('.J_coverLabel')
        this.J_previewContent = $('.J_previewContent')
        this.J_browseBox = $('.J_browseBox')
        this.J_optionBox = $('.J_optionBox')
        this.J_delBtn = $('.J_delBtn')
        this.J_uploadBtn = $('.J_uploadBtn')
        this.loadingModal = $('#loadingModal')
        this.J_inputCover = $('.J_inputCover')
        this.J_previewBox = $('.J_previewBox')

        this.initSelect2()
        this.initMarkDown()
        this.initCover()
    }

    initSelect2() {
        $('.select2').select2({
            theme: 'bootstrap4',
            tags: true,
            tokenSeparators: [",", " "],
            createTag: function (newTag) {
                return {
                    id: 'new:' + newTag.term,
                    text: newTag.term + ' (new)'
                };
            }
        })
    }

    initMarkDown() {
        // new SimpleMDE({element: $(".J_articleContent")[0]});
        editormd.urls.atLinkBase = "https://github.com/";

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
            toolbarIcons: ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'image', 'code', 'code-block', 'table', 'html-entities', 'watch', 'preview', 'search'],
            imageUpload: true,
            imageUploadURL: '',
        });
    }

    initCover() {
        this.J_ImgFile.on('change', (event) => {
            this.J_previewText.hide()
            this.upLoadFile = event.target.files[0]
            this.showPreview(this.upLoadFile)
            this.J_coverLabel.val(this.upLoadFile.name)
            this.J_previewContent.remove()
            this.J_browseBox.hide()
            this.J_optionBox.addClass('d-flex').show()
        })

        this.J_delBtn.on('click', () => {
            this.upLoadFile = null
            this.J_previewText.show()
            this.J_previewContent.remove()
            this.J_coverLabel.val('')
            this.J_inputCover.val('')
            this.J_optionBox.removeClass('d-flex').hide()
            this.J_browseBox.show()
        })

        this.J_uploadBtn.on('click', () => {
            let formData = new FormData()
            formData.append('cover_img', this.upLoadFile)
            this.loadingModal.modal({backdrop: 'static', keyboard: false})
            $.ajax({
                type: 'POST',
                url: imgUpLoadPath,
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: (response) => {
                    this.loadingModal.modal('hide')
                    if (response.status == 0) {
                        this.J_inputCover.val(response.body.imgURL)
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                }
            })
        })
    }

    showPreview(file) {
        let self = this
        this.J_coverLabel.val(file.name)
        let reader = new FileReader()
        reader.onload = function (e) {
            let html = `<div class="preview-content J_previewContent"><img src="${e.target.result}" alt=""></div>`
            self.J_previewBox.append(html)
        }
        reader.readAsDataURL(file)
    }

}

new Article();
