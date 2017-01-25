<?php

Shortcode::register('b', function($shortcode, $content, $compiler, $name)
{
    return '<strong class="'. $shortcode->class .'">' . $content . '</strong>';
});