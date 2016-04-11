<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-2.1.1.min.js"%3E%3C/script%3E'));</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
<script src="/backend/js/vendor/bootstrap.min.js"></script>
<script src="/backend/js/plugins.js"></script>
<script type="text/javascript" src="/backend/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/backend/fancybox/jquery.fancybox-1.3.4.js"></script>
<script src="/backend/js/app.js"></script>
<script src="/backend/js/imgLiquid-min.js"></script>
<?php /*
<script src="/js/plugins/ckeditor/ckeditor.js"></script>
*/?>

<!-- Load and execute javascript code used only in this page -->
<script src="/backend/js/pages/formsComponents.js"></script>
<script>$(function(){ FormsComponents.init(); });</script>

<script src="/backend/js/jamp_customize.js"></script>
