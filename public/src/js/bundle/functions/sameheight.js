export function horizontal() {
    'use strict';

    var equal = function() {
        $('[data-equal]').each(function(){
            var parent = $(this);
            var type = parent.attr('data-equal');
            var array = type.split(',');

            $.each(array, function(i,e){
                var H = 0;
                parent.find('[data-equal-watch="'+e+'"]').css('height', 'auto');
                parent.find('[data-equal-watch="'+e+'"]').each(function(){
                    var h = $(this).height();
                    H = h > H ? h : H;
                });
                parent.find('[data-equal-watch="'+e+'"]').height(H);
            });
        });
    };

    equal();

}
