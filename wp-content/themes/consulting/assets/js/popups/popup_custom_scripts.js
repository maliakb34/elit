(function ($) {
    $(document).ready(function () {
        consulting_copy_popup_link_inside();
        consulting_copy_popup_link();
    });

    $(document).mouseup(function (e) {
        let container = $(".consulting-popup-class");
        if (container.has(e.target).length === 0){
            $(".popup-class-copied").removeClass("show");
        }
    });

    let consulting_copy_popup_link_inside = function () {
        $(".post-type-stm_popups .consulting-popups-link-inside").appendTo('#titlediv .inside');
    };

    let consulting_copy_popup_link = function () {
        $(".consulting-popup-class").on('click', function () {
            $(this).select();
            document.execCommand("copy");
            $(this).parent().find(".popup-class-copied").addClass("show");
        });
    };
})(jQuery);
