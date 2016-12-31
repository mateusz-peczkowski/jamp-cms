export function init() {
    'use strict';

    $('.js-open-mobile-menu').click(function(e) {
        e.preventDefault();
        let mobilenav = $('.js-mobile-nav');
        mobilenav.addClass('expanded');
        setTimeout(function() {
        	mobilenav.addClass('is-animated');
        }, 200);
    });

    $('.js-close-mobile-menu').click(function(e) {
        e.preventDefault();
        let mobilenav = $('.js-mobile-nav');
    	mobilenav.removeClass('is-animated');
        setTimeout(function() {
        	mobilenav.removeClass('expanded');
        }, 900);
    });

}
