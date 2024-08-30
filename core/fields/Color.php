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

trait Color {

    public function color_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'placeholder' => '',
            'condition'   => '',
            'value' => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->color_markup( $args );
    }

    public function color_markup( $args ) {
        $fieldName = esc_attr( $args['name'] );
        $condition = !empty( $args['condition'] ) ? 'data-condition='.json_encode( $args['condition'] ) : '';
        ?>
        <div class="admintosh-label admintosh-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h5><?php echo esc_html( $args['title'] ); ?></h5>
            <input type="text" id="bg_color" class="color-field" data-alpha-enabled="true" data-alpha-color-type="rgb" placeholder="<?php echo esc_html( $args['placeholder'] ); ?>" value="<?php echo esc_html( $args['value'] ); ?>" name="<?php echo esc_attr( $fieldName ); ?>" />
        </div>
        <?php
    }

}