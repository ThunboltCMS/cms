'use strict';
(function($, undefined) {
    if ($.nette !== undefined) {
        $.nette.ext('spinner', {
            start: function () {
                $('#ajax-spinner').addClass('show');
            },
            complete: function () {
                $('#ajax-spinner').removeClass('show');
            },
            error: function () {
                $('#ajax-spinner').removeClass('show');
            }
        });
    }

})(jQuery);
