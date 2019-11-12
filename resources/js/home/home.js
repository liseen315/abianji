import $ from 'jquery';
import Prism from 'prismjs';
import 'prismjs/plugins/line-numbers/prism-line-numbers';

class Home {
    constructor() {
        this.initAmchor();
        this.initLineNumber();
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
}

new Home()
