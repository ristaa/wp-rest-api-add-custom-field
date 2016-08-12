<?php
/**
 * Plugin Name: REST test
 * Description: Plugin to work with REST API
 * Author: Miloš Ristić
 * Author URI: /
 */

/**
 * Modifying the response for the Post object
 */
function rest_modify_post_response() {
    // adding a field for the featured image
    register_rest_field( 'post', 'rest_featured_image', array(
        'get_callback'      => 'rest_get_featured_image',
        'update_callback'   => null,
        'schema'                => null
    ) );
}
add_action( 'rest_api_init', 'rest_modify_post_response' );

/**
 * Function to retrieve featured image link
 */
function rest_get_featured_image( $post, $field_name, $request ) {
    $attachment_id = $post['featured_media'];
    $attachment_info = wp_get_attachment_image_src( $attachment_id, 'rest_post_thumbnail' );
    return $attachment_info[0];
}

/**
 * Adding image size for the featured image
 */
function rest_add_image_size() {
    add_image_size( 'rest_post_thumbnail', 712, 348, true );
}
add_action( 'init', 'rest_add_image_size' );
