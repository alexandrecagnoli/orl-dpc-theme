<?php
function my_page_template_redirect() {
    if ( is_page( array( 'mon-compte', 'mes-sessions-dpc', 'mes-infos', 'mon-compte' ) ) && ! is_user_logged_in() ) {
        wp_redirect( home_url( '/connexion' ) );
        die;
    }
}
add_action( 'template_redirect', 'my_page_template_redirect' );