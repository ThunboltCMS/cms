'use strict';
(function ($, undefined) {
    $.nette.init();

    Thunbolt.FormErrors.addListenerOnChange();
    Thunbolt.FormErrors.init();

    WebChemistry.FormControls.registerNetteAjaxEvent();
    WebChemistry.FormControls.init();
})(jQuery);


