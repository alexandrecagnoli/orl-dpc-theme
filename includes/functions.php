<?php

add_theme_support( 'post-thumbnails' );
date_default_timezone_set('Europe/Paris');

add_filter('date_i18n', function ($date, $format, $timestamp, $gmt) {
    return wp_date($format, $timestamp);
    }, 99, 4);

// Init ACF
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

// Remove admin bar for subscribers
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// Add specific body class based on template page
add_filter( 'body_class','my_body_class' );
function my_body_class( $classes ) {

    if ( is_page_template( 'page-login.php' ) ) {
        $classes[] = 'page-login';
    }
    if ( is_page_template( 'page-subscribe.php' ) ) {
        $classes[] = 'page-subscribe';
    }
    if ( is_page_template( 'page-account.php' ) ) {
        $classes[] = 'user-account user-info';
    }
    if ( is_page_template( 'page-account-info.php' ) ) {
        $classes[] = 'user-account user-info';
    }
    if ( is_page_template( 'page-session-subscribe.php' ) ) {
        $classes[] = 'user-account user-info';
    }
    if ( is_page_template( 'page-account-sessions.php' ) ) {
        $classes[] = 'user-account user-info';
    }
    return $classes;

}

function my_widgets_init() {

	register_sidebar( array(
		'name'          => 'Login Form',
		'id'            => 'login_form',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="section-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Login Form 2',
		'id'            => 'login_form_2',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="section-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'my_widgets_init' );

add_filter( 'gform_userregistration_login_form', function ( $form ) {

// Remove Remember Me field.
 unset ( $form['fields']['2'] );
 $fields = $form['fields'];
    foreach ( $fields as &$field ) {
        if ( $field->label == 'Nom d’utilisateur' ) {
            $field->placeholder = 'Votre email';
            unset($field->label);
        }
        if ( $field->label == 'Mot de passe' ) {
        	unset($field->label);
            $field->placeholder = 'Mot de passe';
        }
    }
  return $form;
} );


function addToCalendarLink()
{
    return '<a href="#" class="session-action-calendar"><i class="far fa-calendar-alt"></i> Ajouter à mon calendrier</a>';
}

function getStatusIcon($icon, $label)
{
    $url = get_template_directory_uri()."/img/";
    switch ($icon)
    {
	case 0:
	$url .= "ico-invalid.svg";
	break;
	case 1:
	$url .= "ico-pending.svg";
	break;
	case 2:
	$url .= "ico-valid.svg";
	break;
    }
    $ph="<span class='item-status tooltip'><img src='".$url."' alt='".$label."' /><span class='tooltiptext'>".$label."</span>";
    return $ph;
}

function getStatusNiceName($status)
{
    switch ($status) {
	case 0:
	$status = "À faire";
	break;
	case 1:
	$status = "En cours";
	break;
	case 2:
	$status = "Validé";
	break;
    }
    return $status;
}

function getNiceDate($date)
{
    if (isset($date))
    {
        $date=intval($date);
        $date=strtotime($date);
        $date = wp_date('d-m-Y', $date);
    }
    else
    $date="...";
    return($date);
}
function getNiceDateHome($date)
{


    if (isset($date))
    {
        $date=strtotime($date);
        //$date = date('d-m-Y', $date);
        $date = wp_date('d-m-Y', $date);
    }
    else
    $date="...";
    return($date);
}
function getNiceDateAndTime($date)
{
    if ( isset($date) && ($date != "" ) )
    {
        $date=intval($date);
        $date = wp_date('d/m/Y H:i:s', $date);
        //$date=date('d/m/Y H:i:s', $date);
    }

    else
    $date="...";

    return($date);
}


function my_expert_img($id){
    if ( has_post_thumbnail($id) ) 
    {
    $img = get_the_post_thumbnail( $id, 'thumbnail', array('class' => 'img-circle') );
    }
    else {
    $img =  '<img src="' . get_template_directory_uri()
    . '/img/default-square.jpg" class="img-circle" />';
    }
    return $img;
}

function isDateRangeValid($startdate, $enddate){
    if ( 
        $startdate <= date( 'Ymd', strtotime('now') ) && $enddate >= date('Ymd', strtotime('now')) 
    )
    {
        return true;
    }
    else
    {
        return false;
    }
}

function convertSeconds($seconds){
    $t = round(floatval($seconds));
    $output = sprintf('%02d:%02d:%02d', ($t/ 3600),($t/ 60 % 60), $t% 60);
    return $output;
}

/**
 * Gravity Forms — Never mark entries as spam for logged-in users.
 */
add_filter( 'gform_entry_is_spam', 'gf_user_is_not_spam', 99, 3 );
function gf_user_is_not_spam( $is_spam, $form, $entry ) {
    if ( $is_spam && is_user_logged_in() ) {
        // Always not spam for users with administrator role.
        $is_spam = false;
        GFCommon::log_debug( __METHOD__ . '(): Entry marked as not spam for user role.' );
    }
    return $is_spam;
}
