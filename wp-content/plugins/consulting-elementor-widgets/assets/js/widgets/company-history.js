class ConsultingCompanyHistory extends elementorModules.frontend.handlers.Base {
    onInit() {
        let $ = jQuery;
        var containers = $('.history_wrapper');
        $.each( containers, function( container ) {
            if ( ! $(this).hasClass('slick-slider') ) {

                var id = $(this).data('id');
                var columns = $(this).data('column');
                var slickRtl = false;
                var navLeft = $(this).data('nav-left');
                var navRight = $(this).data('nav-right');

                if ($('body').hasClass('rtl')) {
                    slickRtl = true;
                }

                $( ".history_wrapper[data-id=" + id + "]" ).slick({
                    rtl: slickRtl,
                    dots: false,
                    infinite: false,
                    arrows: true,
                    prevArrow: "<div class=\"item_prev\"><i class=\""+ navLeft +"\"></i></div>",
                    nextArrow: "<div class=\"item_next\"><i class=\""+ navRight +"\"></i></div>",
                    autoplaySpeed: 5000,
                    autoplay: false,
                    slidesToShow: columns,
                    slidesToScroll: columns,
                    cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 680,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        });

    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(ConsultingCompanyHistory, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/stm_company_history.default', addHandler);
});