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

trait Text {

    public function text_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'value' => '',
            'placeholder' => '',
            'description' => '',
            'condition'   => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->text_markup( $args );
    }

    public function text_markup( $args ) {

        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <div class="input-field-block">
                <input type="text" class="input-control" placeholder="<?php echo esc_html( $args['placeholder'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo esc_html( $args['value'] ); ?>"/>
                <?php 
                if( !empty( $args['description'] ) ) {
                    echo '<p>'.wp_kses_post( $args['description'] ).'</p>';
                }
                ?>
            </div>
        </div>
        <?php
    }
}