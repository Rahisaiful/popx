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

  public static $getFields;

  function __construct() {
    add_action( 'add_meta_boxes', [ __CLASS__, 'register_meta_boxes' ] );
    add_action( 'save_post', [ __CLASS__, 'save_meta_data' ] );

    self::$getFields = new \Popx\Core\Fields\Fields_Maping();

    self::$getFields->scripts();
  }

  /**
   * Register meta box
   * 
   */
  public static function register_meta_boxes() {
    add_meta_box( 'popx-popup-meta', esc_html__( 'Set Popup Options', 'popx' ), [__CLASS__, 'display_callback'], 'popx_popup' );
  }

  /**
   * Meta box display callback.
   *
   * @param WP_Post $post Current post object.
   */
  public static function display_callback( $post ) {
    $position = get_post_meta( $post->ID, '_popx_popup_position', true );
    $activePopup = get_post_meta( $post->ID, '_popx_active_popup', true );
    $bgOverly = get_post_meta( $post->ID, '_popx_popup_bg_overly', true );
    $delayTime = get_post_meta( $post->ID, '_popx_popup_delay_time', true );
    $width = get_post_meta( $post->ID, '_popx_popup_popup_width', true );
    $height = get_post_meta( $post->ID, '_popx_popup_popup_height', true );
    $wrapBorder = get_post_meta( $post->ID, '_popx_popup_wrap_border', true );
    $wrapBgColor = get_post_meta( $post->ID, '_popx_popup_wrap_bg_color', true );
    $wrapBoxShadow = get_post_meta( $post->ID, '_popx_popup_wrap_box_shadow', true );
    $wrapBorderRadius = get_post_meta( $post->ID, '_popx_popup_wrap_border_radius', true );
    $displayPageType = get_post_meta( $post->ID, '_popx_display_page_type', true );
    $displayPages = get_post_meta( $post->ID, '_popx_display_pages', true );

    self::meta_style();

    // Fields 
    $getFields = self::$getFields;

    ?>
    <div class="popx-meta-content-box">
      
      <div class="popx-meta-tabs">
        <ul>
          <li id="settings_tab" class="popx-tab popx-active"><span><img src="<?php echo esc_url( POPX_DIR_URL.'core/fields/assets/icon/settings.svg' ); ?>" /></span> <?php esc_html_e( 'Settings', 'popx' ); ?> </li>
          <li id="settings_style" class="popx-tab"><span><img src="<?php echo esc_url( POPX_DIR_URL.'core/fields/assets/icon/style.svg' ); ?>" /></span> <?php esc_html_e( 'Style', 'popx' ); ?> </li>
        </ul>
      </div>

      <div class="popx-meta-tabs-content-area">

        <div data-tabref="settings_tab" class="popx-meta-tab-content popx-active">
          <?php
          $getFields->switcher_field(
            [
              'title' => esc_html__( 'Active Popup', 'popx' ),
              'name' => 'active_popup',
              'value' => $activePopup
            ]
          );
          $getFields->select_field(
            [
              'title' => esc_html__( 'Popup Position', 'popx' ),
              'name' => 'popup_position',
              'value' => $position,
              'options' => [
                  'top-right'     => esc_html__( 'Top Right', 'popx' ),
                  'top-left'      => esc_html__( 'Top Left', 'popx' ),
                  'center'        => esc_html__( 'Center', 'popx' ),
                  'bottom-right'  => esc_html__( 'Bottom Right', 'popx' ),
                  'bottom-left'   => esc_html__( 'Bottom Left', 'popx' ),
              ]
            ]
          );
    
          $getFields->select_field(
            [
              'title' => esc_html__( 'Display Page Type', 'popx' ),
              'name' => 'display_page_type',
              'value' => $displayPageType,
              'options' => [
                  'entire-pages'     => esc_html__( 'Entire Pages', 'popx' ),
                  'singular-archive'      => esc_html__( 'Singular and Archive Pages', 'popx' ),
                  'specific-pages'        => esc_html__( 'Specific Pages', 'popx' ),
              ]
            ]
          );
          
          $getFields->select_field(
            [
              'title' => esc_html__( 'Pages', 'popx' ),
              'name' => 'display_pages',
              'value' => $displayPages,
              'options' => \Popx\Helper::getPagesList(),
              'condition' => [ 'display_page_type' => ['specific-pages'] ]
            ]
          );
          $getFields->number_field(
            [
              'title' => esc_html__( 'Popup Width', 'popx' ),
              'name' => 'popup_width',
              'value' => $width
            ]
          );


          $getFields->number_field(
            [
              'title' => esc_html__( 'Popup Height', 'popx' ),
              'name' => 'popup_height',
              'value' => $height
            ]
          );

          $getFields->number_field(
            [
              'title' => esc_html__( 'Popup Show Delay Time', 'popx' ),
              'name' => 'delay_time',
              'value' => $delayTime
            ]
          );
          ?>
        </div>
        <div data-tabref="settings_style" class="popx-meta-tab-content popx-hide">
          <?php
          $getFields->border_field(
            [
              'title' => esc_html__( 'Wrapper Border', 'popx' ),
              'name' => 'popup_wrap_border',
              'value' => $wrapBorder
            ]
          );

          $getFields->border_radius_field(
            [
              'title' => esc_html__( 'Wrapper Border Radius', 'popx' ),
              'name' => 'popup_wrap_border_radius',
              'value' => $wrapBorderRadius
            ]
          );

          $getFields->box_shadow_field(
            [
              'title' => esc_html__( 'Wrapper Box Shadow', 'popx' ),
              'name' => 'popup_wrap_box_shadow',
              'value' => $wrapBoxShadow
            ]
          );

          $getFields->color_field(
            [
              'title' => esc_html__( 'Wrapper Background', 'popx' ),
              'name' => 'popup_wrap_bg_color',
              'value' => $wrapBgColor
            ]
          );
          $getFields->switcher_field(
            [
              'title' => esc_html__( 'Background Overly', 'popx' ),
              'name' => 'active_bg_overly',
              'value' => $bgOverly
            ]
          );
          ?>
        </div>

      </div>

    </div>
    <?php


  }
  
  public static function save_meta_data( $post_id ) {

      //
      update_post_meta( $post_id, '_popx_popup_position', sanitize_text_field(  $_POST['popup_position'] ?? ''  ) );
      update_post_meta( $post_id, '_popx_active_popup', sanitize_text_field( $_POST['active_popup'] ?? '' ) );
      update_post_meta( $post_id, '_popx_popup_bg_overly', sanitize_text_field( $_POST['active_bg_overly'] ?? '' ) );
      update_post_meta( $post_id, '_popx_popup_delay_time', sanitize_text_field( $_POST['delay_time'] ?? '' ) );
      update_post_meta( $post_id, '_popx_display_page_type', sanitize_text_field( $_POST['display_page_type'] ?? '' ) );

      update_post_meta( $post_id, '_popx_display_pages', sanitize_text_field( $_POST['display_pages'] ?? '' ) );

      update_post_meta( $post_id, '_popx_popup_popup_width', sanitize_text_field( $_POST['popup_width'] ?? '' ) );
      update_post_meta( $post_id, '_popx_popup_popup_height', sanitize_text_field( $_POST['popup_height'] ?? '' ) );

      update_post_meta( $post_id, '_popx_popup_wrap_bg_color', sanitize_text_field( $_POST['popup_wrap_bg_color'] ?? '' ) );
      update_post_meta( $post_id, '_popx_popup_wrap_border', array_map( 'sanitize_text_field', $_POST['popup_wrap_border'] ?? [] ) );
      update_post_meta( $post_id, '_popx_popup_wrap_box_shadow', array_map( 'sanitize_text_field', $_POST['popup_wrap_box_shadow'] ?? [] ) );
      update_post_meta( $post_id, '_popx_popup_wrap_border_radius', array_map( 'sanitize_text_field', $_POST['popup_wrap_border_radius'] ?? [] ) );
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