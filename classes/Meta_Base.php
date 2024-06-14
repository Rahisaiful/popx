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
    add_meta_box( 'popx-popup-meta', esc_html__( 'Set Popup Options', 'popx' ), [__CLASS__, 'display_callback'], 'popx_modal' );
  }

  /**
   * Meta box display callback.
   *
   * @param WP_Post $post Current post object.
   */
  public static function display_callback( $post ) {
    $position = get_post_meta( $post->ID, '_popx_popup_position', true );
    $activePopup = get_post_meta( $post->ID, '_popx_active_popup', true );
    self::meta_style();
    ?>
    <div class="popx-meta-field-group">
      <div class="popx-meta-field-inner popx-field-type-switch">
        <label><?php esc_html_e( 'Active Popup', 'popx' ); ?></label>
        <input type="checkbox" value="yes" <?php checked( $activePopup, 'yes' ); ?> name="active_popup">
      </div>
    </div>

    <div class="popx-meta-field-group">
      <div class="popx-meta-field-inner">
        <label><?php esc_html_e( 'Popup Position', 'popx' ); ?></label>
        <select class="popx-input-field" name="popup_position">
          <option <?php selected( $position, 'top-right' ); ?> value="top-right">Top Right</option>
          <option <?php selected( $position, 'top-left' ); ?> value="top-left">Top Left</option>
          <option <?php selected( $position, 'center' ); ?> value="center">Center</option>
          <option <?php selected( $position, 'bottom-right' ); ?> value="bottom-right">Bottom Right</option>
          <option <?php selected( $position, 'bottom-left' ); ?> value="bottom-left">Bottom Left </option>
        </select>
      </div>
    </div>

    <div class="popx-meta-field-group">
      <div class="popx-meta-field-inner">
        <label><?php esc_html_e( 'Display Page Type', 'popx' ); ?></label>
        <select class="popx-input-field" name="display_page_type">
          <option <?php selected( $position, 'top-right' ); ?> value="entire-pages">Entire Pages</option>
          <option <?php selected( $position, 'top-right' ); ?> value="singular-archive">Singular and Archive Pages</option>
          <option <?php selected( $position, 'top-right' ); ?> value="specific-pages">Specific Pages</option>
        </select>
      </div>
    </div>

    <div class="popx-meta-field-group">
      <div class="popx-meta-field-inner">
        <label><?php esc_html_e( 'Pages', 'popx' ); ?></label>
        <select class="popx-input-field" name="display_pages">
          <?php 
          echo \Popx\Helper::getPagesSelectOption();
          ?>
        </select>
      </div>
    </div>
    <div class="popx-meta-field-group">
      <div class="popx-meta-field-inner popx-field-type-number">
        <label><?php esc_html_e( 'Modal Width', 'popx' ); ?></label>
        <input type="number" class="popx-input-field" value=""  name="modal_width">
      </div>
    </div>
    <div class="popx-meta-field-group">
      <div class="popx-meta-field-inner popx-field-type-number">
        <label><?php esc_html_e( 'Modal Height', 'popx' ); ?></label>
        <input type="number" class="popx-input-field" value="" name="modal_height">
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
      update_post_meta( $post_id, '_popx_popup_position', sanitize_text_field( $position ) );
      update_post_meta( $post_id, '_popx_active_popup', sanitize_text_field( $activePopup ) );
  }

  public static function meta_style() {
    ?>
    <style>
      .popx-meta-field-group {
        margin-bottom: 20px;
      }
      .popx-meta-field-inner label {
          display: block;
          margin-bottom: 5px;
          font-size: 15px;
          font-weight: 600;
      }
      .popx-field-type-switch label {
        display: inline-block;
        margin-right: 6px;
      }
      .popx-meta-field-inner .popx-input-field {
        border: 1px solid #eee;
        height: 40px;
        min-width: 300px;
      }
      .popx-field-type-number .popx-input-field {
        min-width: 80px;
        width: 80px;
      }
    </style>
    <?php
  }


}

new Meta_Base();