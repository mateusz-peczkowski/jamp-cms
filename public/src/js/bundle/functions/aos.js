import 'aos';

export function init() {
    'use strict';

    if (
        !document.querySelector('html').classList.contains('md-mobile') && !document.querySelector('html').classList.contains('ie')
        && (
            document.querySelector('[aos]') !== null
            || document.querySelector('[data-aos]') !== null
        )
    ) {
        AOS.init({
            disable: 'mobile',
            duration: 500,
            easing: 'ease-in-out',
            offset: 50,
            triggerEvent: true
        });
    }
}
