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
        this.initRocket()
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

    initRocket() {
        let scroll = $('#totop');
        let scrollSpeed = 1600;
        scroll.hide();
        $(window).scroll(() => {
            let scrollTop = $(document).scrollTop();
            if (scrollTop > 1000) {
                scroll.stop().fadeTo(300, 1);
            } else {
                scroll.stop().fadeTo(300, 0);
            }
        })

        scroll.click(() => {
            $('html, body').animate({scrollTop: 0}, 1600);
            return false;
        })
    }
}

new Home()
