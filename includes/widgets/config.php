
<?php
require_once('sidebar-two-tabs.php');
require_once('sidebar-three-tabs.php');
require_once('sidebar-community.php');

add_action( 'widgets_init', create_function( '', 'register_widget( "sidebar_two_tabs_widget" );' ) );
add_action( 'widgets_init', create_function( '', 'register_widget( "sidebar_three_tabs_widget" );' ) );
add_action( 'widgets_init', create_function( '', 'register_widget( "sidebar_community_widget" );' ) );