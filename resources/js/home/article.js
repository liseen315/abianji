class Article {
    constructor() {
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
    }
}

new Article()
