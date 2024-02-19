(function ($) {
    let popup_wrapper = document.querySelector("#popup_wrapper");

    $(document).ready(function () {
        consulting_popup();
    });

    let consulting_show_popup = function () {
        $( '#popup_wrapper' ).addClass('show-popup');
        $.ajax({
            type: 'POST',
            url: consulting_popup_content.url,
            data: { action : 'consulting_popup_content_action', nonce: consulting_popup_content.nonce, id: consulting_popup_content.id, animation: consulting_popup_content.animation, },
            success: function(consulting_popup_content){
                $( '#popup_wrapper' ).html( consulting_popup_content );
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
                alert(errorThrown);
            },
            complete: function () {
                $('.consulting-close-popup, .consulting-close-popup-wrapper, .consulting-close-popup-link').on('click', function () {
                    $( '#popup_wrapper' ).empty().removeClass('show-popup');
                });
            }
        });
    };

    let remove_local_storage = function () {
        setTimeout(function(){
            localStorage.removeItem('consulting_show_popup');
        }, popup_wrapper.dataset.showing_in + '000');
    };

    let loadTime = function () {
        let time;
        window.onload = resetTimer;
        if ( 'popup_event_inactivity' === popup_wrapper.dataset.event ) {
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;
        }
        let logout = function() {
            if( 'shown' !== localStorage.getItem('consulting_show_popup') ){
                consulting_show_popup();
                localStorage.setItem('consulting_show_popup', 'shown');
            }
            if( 'never' !== popup_wrapper.dataset.showing_in ) {
                remove_local_storage();
            }
        };
        function resetTimer() {
            clearTimeout(time);

            if ( 'popup_event_on_exit' === popup_wrapper.dataset.event ) {
                $('body').mouseleave(function() {
                    time = setTimeout(logout, popup_wrapper.dataset.delay + '000');
                });
            } else {
                time = setTimeout(logout, popup_wrapper.dataset.delay + '000');
            }
        }
        if( '0' === popup_wrapper.dataset.showing_in ) {
            localStorage.removeItem('consulting_show_popup');
        }
    };

    let consulting_popup = function () {
        let window_width  = $( window ).width();
        if ( popup_wrapper.dataset.popup_responsive < window_width ) {
            loadTime();
        } else {
            $( '#popup_wrapper' ).removeClass('show-popup');
        }
    }
})(jQuery);
