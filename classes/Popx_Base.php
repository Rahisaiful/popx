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

class Popx_Base {

  function __construct() {
    add_action( 'wp_footer', [ __CLASS__, 'modal_base_html_inject' ] );
  }

  public static function modal_base_html_inject() {
    echo '<div class="popx-base-wrap">'.self::modal_html_one().'</div>';
  }
  
  public static function modal_html_one() {
    $args = [
        'post_type' => 'popx_modal',
        'posts_per_page' => '1'
      ];

    $popup = new \WP_Query( $args );

    ?>
    <div class="popx-modal-wrap">
      <div class="popx-modal-top-inner">
        <div class="popx-modal-content-wrap vertical-position-center horizontal-position-center">
          <?php
          if( $popup->have_posts() ) {
            while ( $popup->have_posts() ) {
              $popup->the_post();
              the_content();
            }
            wp_reset_query();
          }
          ?>
        </div>
      </div>
    </div>
    <?php
  }

  public static function modal_html_two() {
    ?>
    <div class="popx-modal-wrap vertical-position-top horizontal-position-right"></div>
    <?php
  }



}

new Popx_Base();