<?php
namespace Popx\Core\Fields;
 /**
  * 
  * @package    popx
  * @version    1.0.0
  * @author     wpmobo
  * @Websites: http://wpmobo.com
  *
  */

 


trait Image_Radio_Button {

  public static $args;

  public function image_radio_field( $args ) {
    
    $default = [
      'title' => '',
      'name' => '',
      'options' => [],
      'placeholder' => '',
      'description' => '',
      'condition'   => ''
    ];

    $args = wp_parse_args( $args, $default );
    $this->image_radio_markup( $args );

  }

	public  function image_radio_markup( $args ) {

    $fieldName = 'admintosh_options['.esc_attr( $args['name'] ).']';
    $opt = get_option('admintosh_options');
    $value = !empty( $opt[$args['name']] ) ? $opt[$args['name']] : '';
    $condition = !empty( $args['condition'] ) ? 'data-condition='.json_encode( $args['condition'] ) : '';
    ?>
    <div class="admintosh-label admintosh-field-wrp" <?php echo esc_attr( $condition ); ?>>
        <h5><?php echo esc_html( $args['title'] ); ?></h5>
        <div class="input-field-block">
            <div class="admintosh-img-button-switch">
            <?php
            foreach( $args['options'] as $key => $url ) {
              echo '<label class="radio-img"><input type="radio" name="'.esc_attr( $fieldName ).'" '.checked(  $value,$key,false ).' value="'.esc_attr( $key ).'" /><img src="'.esc_url( $url ).'"></label>';
            }
            ?>
            </div>
            <p><?php echo wp_kses_post( $args['description'] ); ?></p>
        </div>
    </div>
    <?php

	}

}  
