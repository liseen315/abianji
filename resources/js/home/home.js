window.$ = window.jQuery = require('jquery');
import Prism from 'prismjs';
import 'prismjs/components/prism-markup-templating'
import 'prismjs/components/prism-php'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-go'
import 'prismjs/components/prism-bash'
import 'prismjs/plugins/line-numbers/prism-line-numbers';

class Home {
    constructor() {
        this.content = $('.content')
        this.sidebar = $('.sidebar')
        this.isMobileNavAnim = false;
        this.mobileNavAnimDuration = 200;

        this.initMobileSideBar()
        this.initAmchor();
        this.initLineNumber();
        this.initRocket()
    }

    initMobileSideBar() {
        $('.navbar-toggle').click(event => {
            if (this.isMobileNavAnim) {
                return
            }
            this.startMobileNavAnim();
            this.content.toggleClass('on');
            this.sidebar.toggleClass('on');
            this.stopMobileNavAnim();
        })

        $('.content').click(event => {
            if (this.isMobileNavAnim || !this.content.hasClass('on')) {
                return
            }
            this.content.removeClass('on');
            this.sidebar.removeClass('on');
        })
    }

    startMobileNavAnim() {
        this.isMobileNavAnim = true
    }

    stopMobileNavAnim() {
        setTimeout(() => {
            this.isMobileNavAnim = false;
        },this.mobileNavAnimDuration)
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
