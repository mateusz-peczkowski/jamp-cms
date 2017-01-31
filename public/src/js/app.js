// Base needed libraries & scripts (paths taken from package .json)
require('headjs');
require('jquery');
require('jquerymigrate');
// require('fancybox');
// require('imgliquid');
// require('slick');

import * as classListPolyFill from './bundle/helpers/classListPolyFill';


//imports
classListPolyFill.init();
import * as cookies from './bundle/functions/cookies';
import * as mobileactions from './bundle/functions/mobileactions';
// import * as imgliquid from './bundle/functions/imgliquid';
// import * as filters from './bundle/functions/filters';
// import * as sameheight from './bundle/functions/sameheight';
// import * as fancybox from './bundle/functions/fancybox';
// import * as slicks from './bundle/functions/slicks';
// import * as aos from './bundle/functions/aos';


//scripts
// aos.init();

$(document).ready(function() {
    'use strict';
	cookies.init();
	// imgliquid.init();
	// mobileactions.init();
	// filters.init();
	// sameheight.init();
	// fancybox.init();
	// slicks.horizontal($('.js-banners-top'), 1, true, true, false);
	console.log('%cCreated by: %cJAMPstudio.pl%c -> %chttp://jampstudio.pl','color: #444','background: #2196F3; color: #fff; padding: 4px;','color: #444','color: #009fe3');
});


$(window).scroll(function() {
    'use strict';
    // AOS.refresh();
});


// $(window).load(function() {
//     'use strict';
//     sameheight.init();
// });


// $(window).resize(function() {
//     'use strict';
//     sameheight.init();
// });