export function init() {
    'use strict';

    if (typeof String.prototype.trim !== 'function') {
        Object.defineProperty(String.prototype, 'trim', {
            value: function () {
                return this.replace(/^\s+|\s+$/g, '');
            }
        });
    }

    function getCookie(cname) {
        const name = cname + '=';
        const ca = document.cookie.split(';');

        for (let i = 0; i < ca.length; i++) {
            const c = ca[i].trim();

            if (c.indexOf(name) === 0) {
                return c.substring(name.length,c.length);
            }
        }

        return '';
    }

    function _checkCookiesPolicy() {
        document.body.classList.add('cookie-inited');
        if (getCookie('CookiesPolicyAccepted') !== '') {
            const cookieDiv = document.getElementById('cookieWarning');
            if (cookieDiv) {
                document.body.classList.add('no-cookie');
            }
        }
    }

    function _acceptCookiesPolicy() {
        const exdate = new Date();
        exdate.setDate(exdate.getDate() + 365);
        document.cookie='CookiesPolicyAccepted=1; expires='+exdate.toUTCString();
        document.body.classList.add('no-cookie');
    }

    $('.js-cookie-close').click(function () {

        _acceptCookiesPolicy();
        return false;

    });
    _checkCookiesPolicy();
}
