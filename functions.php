<?php

  // Add custom Post Type flower_product
  function create_post_type() {
    register_post_type( 'flower_product',
      array(
        'supports' => array( 'thumbnail', 'title', 'post-formats', 'editor', 'category'),
        'labels' => array(
          'name' => __( 'Flowers' ),
          'singular_name' => __( 'Flower' )
        ),
        'public' => true,
        'has_archive' => false,
      )
    );
  }
  add_action( 'init', 'create_post_type' );

  // Get js + css
  function my_theme_enqueue_scripts(){
    wp_enqueue_style( 'wp-style', get_template_directory_uri().'/dist/css/style.min.css' );
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/js/wp.min.js', array('jquery'), 1, false );
  }
  add_action('wp_enqueue_scripts', "my_theme_enqueue_scripts");

  // Add categories to flower_product
  function sk_add_category_taxonomy_to_events() {
  	register_taxonomy_for_object_type( 'category', 'flower_product' );
  }
  add_action( 'init', 'sk_add_category_taxonomy_to_events' );

  // Show posts of 'post', 'page' and 'flower' post types on archive page
  function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
      $query->set( 'post_type', array( 'post', 'flower_product' ) );
    return $query;
  }
  add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

  // Register Menu
  function register_my_menus() {
    register_nav_menus(array(
      'primary' => __( 'Primary Menu' ),
    ));
  }
  add_action('after_setup_theme', 'register_my_menus');

  // Add thumbnail photo
  add_theme_support( 'post-thumbnails' );
  // set_post_thumbnail_size('full');

  // Defines image sizes
  // add_image_size('preloader' , 16);
  // add_image_size('small'     , 600);
  // add_image_size('medium'    , 1000);
  // add_image_size('large'     , 1400);

  // Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
    'image',
    'video',
    'gallery',
    'link',
    'aside',
    'quote'
	));

  add_action( 'rest_api_init', 'add_thumbnail_to_JSON' );
  function add_thumbnail_to_JSON() {
    register_rest_field( //Add featured image
      'post', // Where to add the field (Here, blog posts. Could be an array)
      'featured_image_src', // Name of new field (You can call this anything)
      array(
        'get_callback'    => 'get_image_src',
        'update_callback' => null,
        'schema'          => null
      )
    );
  }

  function get_image_src( $object, $field_name, $request ) {
    $feat_img_array = wp_get_attachment_image_src (
      $object['featured_media'], // Image attachment ID
      'large',  // Size.  Ex. "thumbnail", "large", "full", etc..
      true // Whether the image should be treated as an icon.
    );
    return $feat_img_array[0];
  }

  // Remove auto added p tags from content
  remove_filter( 'the_content', 'wpautop' );

?>
