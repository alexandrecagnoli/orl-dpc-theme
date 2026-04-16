<?php

add_action( 'init', 'my_register_menus' );

function my_register_menus()
{
  register_nav_menus(
    array( 'header-menu' => __( 'Header Menu' ),
          'footer-menu' => __( 'Footer Menu' ),
          
          )
    

  );


 
}