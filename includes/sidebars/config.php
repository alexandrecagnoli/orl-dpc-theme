<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function my_widgets_init() {
	register_sidebar( array(
		'name' => 'Homepage sidebar',
		'id' => 'homepage_sidebar',
		'before_widget' => '<div class="sidebar-widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2 class="sidebar-widget-title">',
		'after_title' => '</h2><div class="sidebar-widget-content">',
	) );
}
add_action( 'widgets_init', 'my_widgets_init' );
?>