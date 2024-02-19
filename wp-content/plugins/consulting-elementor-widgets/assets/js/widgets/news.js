class ConsultingNews extends elementorModules.frontend.handlers.Base {
    onInit() {
        let $ = jQuery;

        var $container = $(".consulting_posts_box.appearance_masonry .consulting_posts");
        var originLeft = true;
        if ($("body").hasClass("rtl")) {
            originLeft = false;
        }

        $container.isotope({
            layoutMode: "masonry",
            itemSelector: ".consulting_posts_box.appearance_masonry .consulting_posts .post_item",
            transitionDuration: "0.7s",
            gutter: 10,
            isOriginLeft: originLeft,
        });
        $container.imagesLoaded().progress(function () {
            $container.isotope("layout");
        });
        $container.isotope("layout");
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(ConsultingNews, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/stm_news.default', addHandler);
});