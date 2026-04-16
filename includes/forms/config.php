<?php

function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Mots clés, photographe, marque…"/>
    <input type="submit" id="searchsubmit" value="'. esc_attr__('ok') .'" />
    </form>';
    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );
