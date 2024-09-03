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

trait Dimension {

    public function dimension_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'value' => '',
            'placeholder' => '',
            'condition'   => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->dimension_markup( $args );
    }

    public function dimension_markup( $args ) {

        $fieldName = $args['name'];
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';
        $value = $args['value'];
        

        $valTop    = !empty( $value['top'] ) ? $value['top'] : '';
        $valRight  = !empty( $value['right'] ) ? $value['right'] : '';
        $valBottom = !empty( $value['bottom'] ) ? $value['bottom'] : '';
        $valLeft   = !empty( $value['left'] ) ? $value['left'] : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <div class="dimension-input-group">
                <div class="dimension-field-wrap">
                <span>Top</span>
                <input type="number" class="dimension-field" placeholder="Top" name="<?php echo esc_attr( $fieldName.'[top]' ); ?>" value="<?php echo esc_html( $valTop ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span>Right</span>
                <input type="number" class="dimension-field" placeholder="Right" name="<?php echo esc_attr( $fieldName.'[right]' ); ?>" value="<?php echo esc_html( $valRight ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span>Bottom</span>
                <input type="number" class="dimension-field" placeholder="Bottom" name="<?php echo esc_attr( $fieldName.'[bottom]' ); ?>" value="<?php echo esc_html( $valBottom ); ?>"/>
                </div>
                <div class="dimension-field-wrap">
                <span>Left</span>
                <input type="number" class="dimension-field" placeholder="Left" name="<?php echo esc_attr( $fieldName.'[left]' ); ?>" value="<?php echo esc_html( $valLeft ); ?>"/>
                </div>
            </div>
        </div>
        <?php
    }
}