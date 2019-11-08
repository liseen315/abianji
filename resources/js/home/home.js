
class Home {
    constructor() {
        window.$ = window.jQuery = require('jquery');
        this.initAmchor()
    }

    initAmchor() {
        $('.anchor').click(event => {
            event.preventDefault();
            console.log(event.currentTarget)
            $('html,body').animate({scrollTop: $(event.currentTarget.hash).offset().top}, 'smooth');
        })
    }
}

new Home()
