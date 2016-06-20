'use strict';
(function ($, undefined) {
    $.formErrorRenderer = {
        renderer: {
            'bootstrap': function (el, message) {
                var container = el.closest('.form-group');
                container.addClass('has-error');
                container.find('.help-block').hide();
                el.after(
                    '<span class="help-block" data-form-errorMsg="">' + message + '</span>'
                );
                if (el.attr('data-form-onChange')) {
                    return;
                }
                // Remove message
                el.attr('data-form-onChange', 'true');
                el.on('change', function () {
                    var container = $(this).closest('.form-group');
                    container.removeClass('has-error');
                    container.find('[data-form-errorMsg]').remove();
                    container.find('.help-block').show();
                });
            }
        },
        apply: function (type) {
            type = type || 'bootstrap';

            if (typeof this.renderer[type] !== 'function') {
                console.error('Renderer ' + type + ' not exists or is not a function.');
                return;
            }
            var callback = this.renderer[type];

            Nette.addError = function (curEl, message) {
                var elem = $(curEl);
                if (!elem) {
                    alert(message);
                    return;
                }

                callback(elem, message);
            }
        }
    };
})(jQuery);
