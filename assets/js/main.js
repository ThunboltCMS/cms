import "nette.ajax.js";

let $ = require('jquery');

// nette ajax
$.nette.init();

// hide - flashes
setTimeout(function () {
    var elements = document.getElementsByClassName('flashes-wrapper'), i, flashes, y;

    for (i = 0; i < elements.length; i++) {
        flashes = elements[i].getElementsByClassName('flash');
        for (y = 0; y < flashes.length; y++) {
            flashes[y].className += ' hide-effect';

            (function (el) {
                setTimeout(function () {
                    el.className += ' hide-flash';
                }, 900);
            })(flashes[y]);
        }
    }
}, 7000);
