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

class Helper {

    private function __construct() {

    }

    public static function getPagesSelectOption( $value = '' ) {

        $pages = get_posts( ['post_type' => 'page', 'posts_per_page' => '-1' ] );

        $html = '<option value="">'.esc_html__( 'Select Page', 'poper' ).'</option>';
        if( !empty( $pages ) ) {
            foreach ( $pages as $page ) {
                $html .= '<option '.selected( $value, $page->ID ).' value="'.esc_attr( $page->ID ).'">'.esc_html( $page->post_title ).'</option>';
            }
        }

        return $html;

    }

}