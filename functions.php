<?php

include 'recent-post-widget.php';
include 'tags-widget.php';

add_action( 'after_setup_theme', 'mmone_theme_setup', 11 );

function mmone_theme_setup() {
	set_post_thumbnail_size( 150, 150, true );
	// for the featured post slider
	add_image_size( 'featured-thumb', 500, 281, true);
	// for the recent post panes
	add_image_size( 'recent-post-thumb', 250, 141, true );
}


add_action( 'wp_enqueue_scripts', 'mmone_enqueue_styles' );

function mmone_enqueue_styles() {
    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

/* rewrite rule for globalexplorer */
add_action('generate_rewrite_rules', 'geotags_add_rewrite_rules');

function geotags_add_rewrite_rules( $wp_rewrite ) {
  $new_rules = array( 
     'dreizehn.swf' => 'index.php?p=2344' . $wp_rewrite->preg_index(1) );

  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

add_action( 'widgets_init', function() {
   register_widget( 'RecentPostWidget' );
   register_widget( 'TagsWidget' ); 
} );

function mmone_include_svg_icons() {
  $custom_svg_icons = get_theme_file_path( '/assets/images/custom-svg-icons.svg' );

  if ( file_exists( $custom_svg_icons ) ) {
    require_once( $custom_svg_icons );
  }
}
add_action( 'wp_footer', 'mmone_include_svg_icons', 99999 );

function mmone_social_links_icons( $social_links_icons ) {
  $social_links_icons['mmone.de'] = 'pencil';
  $social_links_icons['500px.com'] = '500px';
  $social_links_icons['thingiverse.com'] = 'thingiverse';
  return $social_links_icons;
}
add_filter( 'twentyseventeen_social_links_icons', 'mmone_social_links_icons' );

function mmone_widgets_init() {
   register_sidebar(array(
      'name'          => 'Top Navi Right',
      'id'            => 'mmone_top_nav',
      'description'   => 'Widget area right side of the main menu',
      'before_widget' => '<div class="mmone-top-widgets">',
      'after_widget' => '</div>',
      'before_title' => '',
      'after_title' => '',
   ) );
}
add_action( 'widgets_init', 'mmone_widgets_init' );

?>