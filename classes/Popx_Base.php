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


  public static function modal_html_one( $pages ) {
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


    if( $pages['is_single_archive'] ) {
      $args['meta_query'][] = [
        'key' => '_popx_display_page_type',
        'value' => 'singular-archive',
        'compare' => 'IN',
      ];
    }

    if( !$pages['is_single_archive'] ) {
      $args['meta_query'][] = [
        'key' => '_popx_display_page_type',
        'value' => 'singular-archive',
        'compare' => 'NOT IN',
      ];
    }

    $popup = new \WP_Query( $args );

    if( $popup->have_posts() ) {
      while ( $popup->have_posts() ) {
        $popup->the_post();

      $itemId = get_the_ID();

      //
      $wrapBorder = get_post_meta( $itemId, '_popx_popup_wrap_border', true );
      $wrapBg = get_post_meta( $itemId, '_popx_popup_wrap_bg_color', true );
      $wrapBorderRadius = get_post_meta( $itemId, '_popx_popup_wrap_border_radius', true );
      $wrapBoxShadow = get_post_meta( $itemId, '_popx_popup_wrap_box_shadow', true );

      $position = get_post_meta( $itemId, '_popx_popup_position', true );
      $isOverly = get_post_meta( $itemId, '_popx_popup_bg_overly', true ) ? 'popx-modal-bg-overly' : '';
      $displayPageType = get_post_meta( $itemId, '_popx_display_page_type', true );

      //
      $activate = '';

      if( $displayPageType == 'specific-pages' ) {
         $displayPages = get_post_meta( $itemId, '_popx_display_pages', true );

        if( $pages['page_id'] == $displayPages ) {
          $activate = 'popx-modal-activate';
        }
      }
      
      if( $displayPageType == 'entire-pages' || $displayPageType == 'singular-archive'  ) {
        $activate = 'popx-modal-activate';
      }
      
      // Style

      $customStyle = '';

      // Wrap bg style
      if( !empty( $wrapBg ) ) {
        $customStyle .= 'background-color:'.esc_attr( $wrapBg ).';';
      }
      // Wrap border color
      if( !empty( $wrapBorder['width'] ) && !empty( $wrapBorder['style'] ) ) {
        $customStyle .= 'border:'.$wrapBorder['width'].'px '.$wrapBorder['style'].' '.$wrapBorder['color'].';';
      }

      // Wrap border radius
      if( !empty( $wrapBorderRadius ) ) {

        $customStyle .= 'border-radius:'.$wrapBorderRadius['top_left'].'px '.$wrapBorderRadius['top_right'].'px '.$wrapBorderRadius['bottom_right'].'px '.$wrapBorderRadius['bottom_left'].'px ;';
      }

      // Wrap Box Shadow
      if( !empty( $wrapBoxShadow ) ) {

        $customStyle .= 'box-shadow:'.$wrapBoxShadow['horizontal'].'px '.$wrapBoxShadow['vertical'].'px '.$wrapBoxShadow['blur'].'px '.$wrapBoxShadow['spread'] .'px '.$wrapBoxShadow['color'].';';
      }


    ?>
    <div class="popx-modal-wrap <?php echo esc_attr( $activate ); ?> popx-position-<?php echo esc_attr( $position ?? 'center' ).' '.esc_attr($isOverly); ?>" data-delay-time="<?php echo esc_attr( get_post_meta( $itemId, '_popx_popup_delay_time', true ) ); ?>" data-popx-id="<?php echo absint( $itemId ); ?>">
      <div class="popx-modal-top-inner">
        <div class="popx-modal-close">X</div>
        <div class="popx-modal-content-wrap" style="<?php echo esc_attr( $customStyle ); ?>">
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