(function ($) {
    $(document).ready(function () {
        $('.popup-button-install').on('click', function (e) {
            e.preventDefault();
            let popup           = $(this).attr('data-popup');
            let installed_popup = $(this).attr('data-installed-popup');
            let builder         = $(this).attr('data-builder');
            console.log(installed_popup);
            let popup_nonce     = import_popup_nonce;

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'action': 'stm_demo_import_popup',
                    'nonce': popup_nonce,
                    'popup_template': popup,
                    'popup_builder': builder,
                    'installed_popup': installed_popup,
                },
                beforeSend: function () {
                    $(this).parents('.popup-library-box__screen').addClass('installing');
                },
                complete: function () {
                    $(this).parents('.popup-library-box__screen').removeClass('installing');
                    $(this).parents('.popup-library-box__screen').addClass('installed');
                }
            });
        });

        $('.popup-library-box__tabs .tab-elementor').on('click', function () {
            $(this).addClass('active');
            $('.popup-library-box__tabs .tab-wpbakery').removeClass('active');
            $(this).parents().find('.tab-elementor-content').show();
            $('.tab-wpbakery-content').hide();
        });
        $('.popup-library-box__tabs .tab-wpbakery').on('click', function () {
            $(this).addClass('active');
            $('.popup-library-box__tabs .tab-elementor').removeClass('active');
            $(this).parents().find('.tab-wpbakery-content').show();
            $('.tab-elementor-content').hide();
        });
    });
})(jQuery);
