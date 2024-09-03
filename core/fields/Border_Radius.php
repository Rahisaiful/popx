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

trait Border_Radius {

    public function border_radius_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'value' => '',
            'placeholder' => '',
            'condition'   => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->border_radius_markup( $args );
    }

    public function border_radius_markup( $args ) {

        $fieldName = $args['name'];
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';
        $value = $args['value'];
        

        $topLeft    = !empty( $value['top_left'] ) ? $value['top_left'] : '';
        $topRight  = !empty( $value['top_right'] ) ? $value['top_right'] : '';
        $bottomLeft = !empty( $value['bottom_left'] ) ? $value['bottom_left'] : '';
        $bottomRight   = !empty( $value['bottom_right'] ) ? $value['bottom_right'] : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <div class="dimension-input-group">
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Top Left', 'popx' ); ?></span>
                <input type="number" class="dimension-field" name="<?php echo esc_attr( $fieldName.'[top_left]' ); ?>" value="<?php echo esc_html( $topLeft ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Top Right', 'popx' ); ?></span>
                <input type="number" class="dimension-field" name="<?php echo esc_attr( $fieldName.'[top_right]' ); ?>" value="<?php echo esc_html( $topRight ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Bottom Left', 'popx' ); ?></span>
                <input type="number" class="dimension-field" name="<?php echo esc_attr( $fieldName.'[bottom_left]' ); ?>" value="<?php echo esc_html( $bottomLeft ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Bottom Right', 'popx' ); ?></span>
                <input type="number" class="dimension-field" name="<?php echo esc_attr( $fieldName.'[bottom_right]' ); ?>" value="<?php echo esc_html( $bottomRight ); ?>"/>
                </div>
            </div>
        </div>
        <?php
    }
}