export function horizontal() {
    'use strict';

    let equal = function() {
        $('[data-equal]').each(function(){
            let parent = $(this);
            let type = parent.attr('data-equal');
            let array = type.split(',');

            $.each(array, function(i,e){
                let H = 0;
                parent.find('[data-equal-watch="'+e+'"]').css('height', 'auto');
                parent.find('[data-equal-watch="'+e+'"]').each(function(){
                    let h = $(this).height();
                    H = h > H ? h : H;
                });
                parent.find('[data-equal-watch="'+e+'"]').height(H);
            });
        });
    };

    equal();

}
