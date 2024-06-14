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


  public static function modal_html_one() {
    $args = [
        'post_type' => 'popx_modal',
        'posts_per_page' => '-1',
        'meta_query' => [
          array(
            'key' => '_popx_active_popup',
            'value' => 'yes',
            'compare' => 'IN',
          )
        ]
        
      ];

    $popup = new \WP_Query( $args );

    if( $popup->have_posts() ) {
      while ( $popup->have_posts() ) {
        $popup->the_post();

      $position = get_post_meta( get_the_ID(), '_popx_popup_position', true );
      $isOverly = get_post_meta( get_the_ID(), '_popx_popup_bg_overly', true ) ? 'popx-modal-bg-overly' : '';
    ?>
    <div class="popx-modal-wrap popx-position-<?php echo esc_attr( $position ?? 'center' ).' '.esc_attr($isOverly); ?> popx-modal-open ">
      <div class="popx-modal-top-inner">
        <div class="popx-modal-close">X</div>
        <div class="popx-modal-content-wrap">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <?php
      }
      wp_reset_query();
    }


  }

  public static function modal_html_two() {
    ?>
    <div class="popx-modal-wrap vertical-position-top horizontal-position-right"></div>
    <?php
  }



}

new Popx_Base();