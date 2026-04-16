<?php

add_action( 'wp_enqueue_scripts', 'my_load_styles' );

function my_load_styles()
{
    wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.0.13/css/all.css', array(), '5.0.13', 'all' );
    wp_enqueue_style( 'font', '//fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i|Raleway:300,400,400i,500,500i,600,600i,700,700i,800,800i,900&display=swap', array(), '0.01', 'all' );
    wp_enqueue_style( 'font2', '//fonts.googleapis.com/css?family=Merriweather&display=swap', array(), '0.01', 'all' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/js/plugins/slick/slick.css', array(), '0.01', 'all' );
    wp_enqueue_style( 'slicktheme', get_template_directory_uri() . '/js/plugins/slick/slick-theme.css', array(), '0.01', 'all' );
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '0.01', 'all' );
    wp_enqueue_style( 'hamburgers', get_template_directory_uri() . '/css/hamburgers-min.css', array(), '0.01', 'all' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), '0.01', 'all' );
}

