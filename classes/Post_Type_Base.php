<?php
namespace Popx;
 /**
  * 
  * @package    Popx
  * @version    1.0.0
  * @author     wpmobo
  * @Websites: http://wpmobo.com
  *
  */
 
  if( ! defined( 'ABSPATH' ) ) {
    die( POPX_ALERT_MSG );
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
        register_post_type( 'popx_popup',
            array(
                'labels' => array(
                'name' => esc_html__( 'PopX Popup', 'popx' ),
                'singular_name' => esc_html__( 'Popup', 'popx' ),
                'add_new_item'  => esc_html__( 'Add New Popup', 'popx' ),
                'add_new'       => esc_html__( 'Add New Popup', 'popx' ),
                'edit_item'     => esc_html__( 'Edit Popup', 'popx' )
                ),
                'public' => true,
                'publicly_queryable' => true,
                'query_var'=> true,
                'show_in_rest'       => true,
                'has_archive' => true,
                'show_in_menu' => true,
                'rewrite' => array( 'slug' => 'popx-popup' ),
                'supports' => array('title', 'editor')
            )
        );

    }

}

new Post_Type_Base();