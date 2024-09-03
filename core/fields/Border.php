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

trait Border {

    public function border_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'condition'   => '',
            'value' => '',
        ];

        $args = wp_parse_args( $args, $default );
        $this->border_markup( $args );
    }

    public function border_markup( $args ) {

        $name = $args['name'];

        $value = $args['value'];

        $fieldName = esc_attr( $name );
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';

        $width    = !empty( $value['width'] ) ? $value['width'] : '';
        $style    = !empty( $value['style'] ) ? $value['style'] : '';
        $color    = !empty( $value['color'] ) ? $value['color'] : '';

        $options = [
            'none'   => esc_html__( 'None', 'popx' ),
            'solid'  => esc_html__( 'Solid', 'popx' ),
            'dotted' => esc_html__( 'Dotted', 'popx' ),
            'dashed' => esc_html__( 'Dashed', 'popx' ),
            'double' => esc_html__( 'Double', 'popx' ),
            'groove' => esc_html__( 'Groove', 'popx' )
        ];
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <div class="border-input-group">
                <div class="border-field-wrap">
                    <input type="number" class="border-number-field" placeholder="px" name="<?php echo esc_attr( $fieldName ); ?>[width]" value="<?php echo esc_html( $width ); ?>"/>
                </div>

                <div class="border-field-wrap">
                    <select name="<?php echo esc_attr( $fieldName ); ?>[style]">
                        <?php 
                        if( !empty( $options ) ) {
                            foreach( $options as $key => $option ) {
                                echo '<option value="'.esc_attr( $key ).'" '.selected( $style, $key, false ).'>'.esc_html( $option ).'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="border-field-wrap">
                    <input type="text" id="bg_color" data-alpha-enabled="true" data-alpha-color-type="rgb" class="color-field" value="<?php echo esc_html( $color ); ?>" name="<?php echo esc_attr( $fieldName ); ?>[color]" />
                </div>

            </div>
        </div>
        <?php
    }
}