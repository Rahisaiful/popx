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

class Helper {

    
    public static function getPagesList() {

        $pages = get_posts( ['post_type' => 'page', 'posts_per_page' => '-1' ] );

        $getPages = [];
        if( !empty( $pages ) ) {
            foreach ( $pages as $page ) {
                $getPages[$page->ID] = $page->post_title;
            }
        }

        return $getPages;

    }

    

}