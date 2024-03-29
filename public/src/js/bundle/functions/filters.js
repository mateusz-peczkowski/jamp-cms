export function init() {
    'use strict';

    let filters = function() {
        $('[data-filter]').each(function(){
            let parent = $(this);
            let filter = parent.data('filter');

            parent.find('[data-filter-button]').click(function(event) {
                event.preventDefault();
                let type = $(this).data('filter-button');
                if($(this).hasClass('is-active')) {
                    return false;
                }
                let empty = true;
                parent.find('[data-filter-button]' ).removeClass('is-active');
                $(this).addClass('is-active');

                parent.find('.loader[data-filter-watch="'+ filter +'"]').fadeIn(function() {
                    parent.find('[data-filter-watch="'+ filter +'"]').removeClass('is-active');
                    if(parent.find('.'+type+'[data-filter-watch="'+ filter +'"]').length) {
                        empty = false;
                    }
                    parent.find('.'+type+'[data-filter-watch="'+ filter +'"]').addClass('is-active');
                    if (empty) {
                        parent.find('.empty[data-filter-watch="'+ filter +'"]').addClass('is-active');
                    }
                    $('html, body').animate({scrollTop: parent.find('[data-filter-list="'+ filter +'"]').offset().top - ($('.header').outerHeight() + 50)}, 600, function() {
                        $(window).trigger('resize');
                        setTimeout(function() {
                            parent.find('.loader[data-filter-watch="'+ filter +'"]').fadeOut();
                        }, 500);
                    });
                });
            });
        });
    };

    filters();

}
