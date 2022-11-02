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

class Meta_Base {

  function __construct() {
    add_action( 'add_meta_boxes', [ __CLASS__, 'register_meta_boxes' ] );
    add_action( 'save_post', [ __CLASS__, 'save_meta_data' ] );
  }

  /**
   * Register meta box
   * 
   */
  public static function register_meta_boxes() {
    add_meta_box( 'poper-popup-meta', esc_html__( 'Set Popup Options', 'poper' ), [__CLASS__, 'display_callback'], 'poper_modal' );
  }

  /**
   * Meta box display callback.
   *
   * @param WP_Post $post Current post object.
   */
  public static function display_callback( $post ) {
    $position = get_post_meta( $post->ID, '_poper_popup_position', true );
    $activePopup = get_post_meta( $post->ID, '_poper_active_popup', true );

    ?>
    <div class="poper-meta-field-group">
      <div class="poper-meta-field-inner">
        <label><?php esc_html_e( 'Active Popup', 'poper' ); ?></label>
        <input type="checkbox" value="yes" <?php checked( $activePopup, 'yes' ); ?> name="active_popup">
      </div>
    </div>

    <div class="poper-meta-field-group">
      <div class="poper-meta-field-inner">
        <label><?php esc_html_e( 'Popup Position', 'poper' ); ?></label>
        <select name="popup_position">
          <option <?php selected( $position, 'top-right' ); ?> value="top-right">Top Right</option>
          <option <?php selected( $position, 'top-left' ); ?> value="top-left">Top Left</option>
          <option <?php selected( $position, 'center' ); ?> value="center">Center</option>
          <option <?php selected( $position, 'bottom-right' ); ?> value="bottom-right">Bottom Right</option>
          <option <?php selected( $position, 'bottom-left' ); ?> value="bottom-left">Bottom Left </option>
        </select>
      </div>
    </div>

    <div class="poper-meta-field-group">
      <div class="poper-meta-field-inner">
        <label><?php esc_html_e( 'Display Page Type', 'poper' ); ?></label>
        <select name="display_page_type">
          <option <?php selected( $position, 'top-right' ); ?> value="entire-pages">Entire Pages</option>
          <option <?php selected( $position, 'top-right' ); ?> value="singular-archive">Singular and Archive Pages</option>
          <option <?php selected( $position, 'top-right' ); ?> value="specific-pages">Specific Pages</option>
        </select>
      </div>
    </div>

    <div class="poper-meta-field-group">
      <div class="poper-meta-field-inner">
        <label><?php esc_html_e( 'Pages', 'poper' ); ?></label>
        <select name="display_pages">
          <?php 
          echo \Poper\Helper::getPagesSelectOption();
          ?>
        </select>
      </div>
    </div>
    <div class="poper-meta-field-group">
      <div class="poper-meta-field-inner">
        <label><?php esc_html_e( 'Modal Width', 'poper' ); ?></label>
        <input type="text" value=""  name="modal_width">
      </div>
    </div>
    <div class="poper-meta-field-group">
      <div class="poper-meta-field-inner">
        <label><?php esc_html_e( 'Modal Height', 'poper' ); ?></label>
        <input type="text" value="" name="modal_height">
      </div>
    </div>
    <?php
  }
  
  public static function save_meta_data( $post_id ) {
      //
      $position = '';
      if( isset( $_POST['popup_position'] ) ) {
        $position = $_POST['popup_position'];
      }
      //
      $activePopup = '';
      if( isset( $_POST['active_popup'] ) ) {
        $activePopup = $_POST['active_popup'];
      }
      update_post_meta( $post_id, '_poper_popup_position', sanitize_text_field( $position ) );
      update_post_meta( $post_id, '_poper_active_popup', sanitize_text_field( $activePopup ) );
  }


}

new Meta_Base();