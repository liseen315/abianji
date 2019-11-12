import $ from 'jquery';
import Prism from 'prismjs';
import 'prismjs/plugins/line-numbers/prism-line-numbers';

class Home {
    constructor() {
        this.initAmchor()
    }

    initAmchor() {
        $('.anchor').click(event => {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(event.currentTarget.hash).offset().top}, 'smooth');
        })
    }
}

new Home()
