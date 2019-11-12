import $ from 'jquery';
import Prism from 'prismjs';
import 'prismjs/components/prism-markup-templating'
import 'prismjs/components/prism-php'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-go'
import 'prismjs/plugins/line-numbers/prism-line-numbers';

class Home {
    constructor() {
        this.initAmchor();
        this.initLineNumber();
        this.initTocbot()
    }

    initAmchor() {
        $('.anchor').click(event => {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(event.currentTarget.hash).offset().top}, 'smooth');
        })
    }

    initLineNumber() {
        // 这个坑折腾我一下午
        $('pre').addClass('line-numbers');
    }

    initTocbot() {

    }
}

new Home()
