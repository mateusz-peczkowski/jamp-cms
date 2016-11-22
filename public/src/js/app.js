// Base needed libraries & scripts (paths taken from package .json)
require('headjs');
require('jquery');
require('jquerymigrate');
require('fancybox');

import * as classListPolyFill from './bundle/helpers/classListPolyFill';


//imports
classListPolyFill.init();
import * as cookies from './bundle/functions/cookies';
// import * as fancybox from './bundle/functions/fancybox';
// import * as slicks from './bundle/functions/slicks';
// import * as aos from './bundle/functions/aos';


//scripts
// aos.init();

$(document).ready(function() {
    'use strict';
	cookies.init();
	// fancybox.init();
	// slicks.horizontal($('.js-banners-top'), 1, true, true, false);
});


$(window).scroll(function() {
    'use strict';
    // AOS.refresh();
});