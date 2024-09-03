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

class WP_Hooks {

    function __construct() {
        add_action( 'wp_footer', [ __CLASS__, 'popup_base_html_inject' ] );
    }

    public static function popup_base_html_inject() {
        echo '<div class="popx-base-wrap"></div>';
    }

    

}

new WP_Hooks();