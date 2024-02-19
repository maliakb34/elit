(function ($) {
    const popup_wrapper = document.querySelector("#popup_wrapper");
    let popup_links = popup_wrapper.dataset.popup_links;

    $(document).ready(function () {
        if ( popup_links ) {
            consulting_show_popup();
        }
        $('.consulting-close-popup-link').on('click', function () {
            $( '#popup_wrapper' ).empty().removeClass('show-popup');
        });
    });

    let consulting_show_popup = function () {
        let window_width  = $( window ).width();
        if ( popup_wrapper.dataset.popup_responsive < window_width ) {
            $(popup_links).on('click', function (e) {
                let popups_id = $(this).attr("id").replace( /^\D+/g, '');
                $( '#popup_wrapper' ).addClass('show-popup');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    async: false,
                    data: { action : 'consulting_popup_content_action', nonce: consulting_popup_content.nonce, id: consulting_popup_content.id, animation: consulting_popup_content.animation, popups_id: popups_id, },
                    success: function(consulting_popup_content){
                       $( consulting_popup_content ).appendTo('#popup_wrapper');
                        if ( $( '#popup_wrapper form' ).hasClass( 'wpcf7-form' ) ) {
                            let form = $('#popup_wrapper .wpcf7-form').eq(0);
                            wpcf7.init(form[0]);
                        }
                        if ( $( '.elementor-element' ).hasClass( 'elementor-widget-video' ) ) {
                            let iframe_data = $( '.elementor-element.elementor-widget-video' ).attr('data-settings');
                            iframe_data_attr = $.parseJSON(iframe_data);
                            let youtube_url = iframe_data_attr.youtube_url.split("=");
                            $( '.elementor-element' ).parent().find('.elementor-video').append('<iframe width="200" height="100" src="https://www.youtube.com/embed/'+ youtube_url[1] + '" frameborder="0" allowfullscreen=""></iframe>');
                        }
                    },
                    error: function(MLHttpRequest, consulting_popup_content, errorThrown){
                        $( '#popup_wrapper' ).empty().removeClass('show-popup');
                        alert(errorThrown);
                    },
                    complete: function () {
                        $('.consulting-close-popup, .consulting-close-popup-wrapper, .consulting-close-popup-link').on('click', function () {
                            $( '#popup_wrapper' ).empty().removeClass('show-popup');
                        });
                    }
                });

            });
        } else {
            $( '#popup_wrapper' ).removeClass('show-popup');
        }
    };
})(jQuery);