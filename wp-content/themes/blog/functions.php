<?php

function styles() {
  wp_enqueue_style('bootstrap-min', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css');
  wp_enqueue_style('fontawsomeCss', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
  wp_enqueue_style('fonts-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap');
  wp_enqueue_style('style-css', get_template_directory_uri() . '/style.css');
}
add_action( 'wp_enqueue_scripts', 'styles' );

function javascript(){
    wp_enqueue_script('jqueryJs', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script('fontawsomeJs', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js');
    wp_enqueue_script('mainJs', get_stylesheet_directory_uri(). '/js/main.js');
}
add_action("wp_enqueue_scripts", "javascript");

if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );

function menu_link($atts, $item, $args){
  $class = 'nav-link dropdown-toggle';
  $atts['class'] = $class;
  return $atts;
}

add_filter('show_admin_bar', '__return_false');

add_filter( 'upload_mimes', 'custom_upload_mimes' );
function custom_upload_mimes( $existing_mimes = array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}

/* Anti Malware */
add_filter('xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
});

function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');

// Desactiva la tag de enlace de la REST API
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Desactiva enlaces de oEmbed Discovery
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Desactiva enlace de la REST API en las cabeceras HTTP
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

add_filter('use_block_editor_for_post_type', '__return_false', 100);

?>
