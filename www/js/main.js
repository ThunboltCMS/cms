'use strict';
(function ($, undefined) {
    // nette ajax
    $.nette.init();

    // form errors registration
    Thunbolt.FormErrors.addListenerOnChange();
    Thunbolt.FormErrors.init();

    // form controls registration
    WebChemistry.FormControls.registerNetteAjaxEvent();
    WebChemistry.FormControls.init();

    // document - ready
    $(document).ready(function () {
        // flashes hide effect
        $('.flashes-container .notify').each(function (index) {
            var time = 6e3 * (index + 1);
            var that = this;

            setTimeout(function () {
                $(that).fadeOut(500, function () {
                    $(this).remove();
                });
            }, time);
        });
    });
})(jQuery);


