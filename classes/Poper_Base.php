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

class Poper_Base {

  function __construct() {
    add_action( 'wp_footer', [ __CLASS__, 'modal_base_html_inject' ] );
  }

  public static function modal_base_html_inject() {
    echo '<div class="poper-base-wrap">'.self::modal_html_one().'</div>';
  }
  
  public static function modal_html_one() {
    $args = [
        'post_type' => 'poper_modal',
        'posts_per_page' => '1'
      ];

    $popup = new \WP_Query( $args );

    ?>
    <div class="poper-modal-wrap">
      <div class="poper-modal-top-inner">
        <div class="poper-modal-content-wrap vertical-position-center horizontal-position-center">
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
    <div class="poper-modal-wrap vertical-position-top horizontal-position-right"></div>
    <?php
  }



}

new Poper_Base();