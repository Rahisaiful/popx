<?php
namespace Poper;
 /**
  * 
  * @package    Poper
  * @version    1.0.0
  * @author     WPBucket
  * @Websites: http://wpbucket.net
  *
  */
  if( ! defined( 'ABSPATH' ) ) {
    die( POPER_ALERT_MSG );
  }

class Post_Type_Base {

    function __construct() {
        add_action( 'init', [ $this, 'register_post_type' ] );
    }

    /**
     * Custom Post type  
     */

    public function register_post_type() {
        // Custom Reviews post type
        register_post_type( 'poper_modal',
            array(
                'labels' => array(
                'name' => esc_html__( 'Modal', 'reviewbucket' ),
                'singular_name' => esc_html__( 'Modal', 'reviewbucket' ),
                'add_new_item'  => esc_html__( 'Add New Modal', 'reviewbucket' ),
                'edit_item'     => esc_html__( 'Edit Modal', 'reviewbucket' )
                ),
                'public' => true,
                'publicly_queryable' => true,
                'query_var'=> true,
                'show_in_rest'       => true,
                'has_archive' => true,
                'show_in_menu' => true,
                'rewrite' => array( 'slug' => 'poper-modal' ),
                'supports' => array('title', 'editor')
            )
        );

    }

}

new Post_Type_Base();