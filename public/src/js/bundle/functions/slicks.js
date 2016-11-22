export function horizontal($sliders, slidesNo, infinite, autoplay, arrows) {
    'use strict';

    slidesNo = slidesNo || 3;
    autoplay = autoplay || false;
    arrows = arrows || true;
    let slidesRes = slidesNo-1;
    let slidesRes2 = slidesNo-2;
    if (slidesRes < 1) {
        slidesRes = 1;
    }
    if (slidesRes2 < 1) {
        slidesRes2 = 1;
    }

    infinite = infinite || false;

    if ($sliders.length) {

        $sliders.each(function() {

            let $slider = $(this);

            $slider.on('afterChange', function(){
                $(window).trigger('scroll');
            });

            if (!$slider.hasClass('slick-initialized')) {

                $slider.slick({
                    accessibility: false,
                    autoplay: autoplay,
                    autoplaySpeed: 3000,
                    arrows: arrows,
                    dots: false,
                    fade: false,
                    infinite: infinite,
                    pauseOnHover: false,
                    slidesToShow: slidesNo,
                    speed: 500,
                    prevArrow: '<button class="slick-prev"><i class="icon icon-arrow-normal-left"></i></button>',
                    nextArrow: '<button class="slick-next"><i class="icon icon-arrow-normal-right"></i></button>',
                    responsive: [
                    {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: slidesRes
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        slidesToShow: slidesRes2
                      }
                    }
                  ]
                });

            }

        });

    }

}
