'use strict';
(function ($, undefined) {
    // nette ajax
    $.nette.init();

    // form errors registration
    Thunbolt.FormErrors.addListenerOnChange();
    Thunbolt.FormErrors.init();

    // flashes
    function hideFlash(id) {
        if (!id) {
            id = $('.flashes-container .flash-message:first-child');
        }
        id.fadeOut(500, function () {
            $(this).remove();
            if ($('.flashes-container > div').length === 0) {
                $('.flashes-container').remove();
            }
        });
    }
    $('.flashes-container .flash-message').each(function (index) {
        var time = 5e3 * (index + 1);
        var that = $(this);

        setTimeout(function () {
            hideFlash(that);
        }, time);
    });
    $('.flashes-container .flash-close-btn, .flashes-container .flash-message').on('click', function (e) {
        hideFlash($(this).closest('.flash-message'));
        e.preventDefault();

        return false;
    });
})(jQuery);


