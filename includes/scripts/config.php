<?php

function my_load_scripts()
{
	wp_enqueue_script( 'modernizr', get_template_directory_uri()  . 'js/vendor/modernizr-2.8.3-respond-1.4.2.min.js' );
	wp_enqueue_script( 'fa', '//kit.fontawesome.com/54acf93b5b.js' );
	wp_enqueue_script( 'moment', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js' );
	wp_enqueue_script( 'fa', '//kit.fontawesome.com/54acf93b5b.js' );
	wp_enqueue_script( 'slick', get_template_directory_uri()  . '/js/plugins/slick/slick.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'main', get_template_directory_uri()  . '/js/main.js', array( 'jquery' ) );

}

if (!is_admin()) add_action("wp_enqueue_scripts", "my_load_scripts", 11);
