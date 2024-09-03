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

trait Box_Shadow {

    public function box_shadow_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'value' => '',
            'placeholder' => '',
            'condition'   => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->box_shadow_markup( $args );
    }

    public function box_shadow_markup( $args ) {

        $value = $args['value'];

        $fieldName = $args['name'];
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';


        $horizontal = !empty( $value['horizontal'] ) ? $value['horizontal'] : '';
        $vertical   = !empty( $value['vertical'] ) ? $value['vertical'] : '';
        $blur       = !empty( $value['blur'] ) ? $value['blur'] : '';
        $spread     = !empty( $value['spread'] ) ? $value['spread'] : '';
        $color      = !empty( $value['color'] ) ? $value['color'] : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <div class="dimension-input-group">
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Horizontal Length', 'popx' ); ?></span>
                <input type="number" class="dimension-field" placeholder="Horizontal" name="<?php echo esc_attr( $fieldName.'[horizontal]' ); ?>" value="<?php echo esc_html( $horizontal ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Vertical Length', 'popx' ); ?></span>
                <input type="number" class="dimension-field" placeholder="Vertical" name="<?php echo esc_attr( $fieldName.'[vertical]' ); ?>" value="<?php echo esc_html( $vertical ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Blur Radius', 'popx' ); ?></span>
                <input type="number" class="dimension-field" placeholder="Bottom" name="<?php echo esc_attr( $fieldName.'[blur]' ); ?>" value="<?php echo esc_html( $blur ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span><?php esc_html_e( 'Spread Radius', 'popx' ); ?></span>
                <input type="number" class="dimension-field" placeholder="Left" name="<?php echo esc_attr( $fieldName.'[spread]' ); ?>" value="<?php echo esc_html( $spread ); ?>"/>
                </div>
                <div class="border-field-wrap bs-color-field-wrap">
                    <span class="bs-color-field-wrap"><?php esc_html_e( 'Color', 'popx' ); ?></span>
                    <input type="text" id="bg_color" data-alpha-enabled="true" data-alpha-color-type="rgb" class="color-field" value="<?php echo esc_html( $color ); ?>" name="<?php echo esc_attr( $fieldName ); ?>[color]" />
                </div>
            </div>
        </div>
        <?php
    }
}