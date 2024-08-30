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

trait Number {

    public function number_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'placeholder' => '',
            'condition'   => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->number_markup( $args );
    }

    public function number_markup( $args ) {
        $fieldName = 'admintosh_options['.esc_attr( $args['name'] ).']';
        $opt = get_option('admintosh_options');
        $value = !empty( $opt[$args['name']] ) ? $opt[$args['name']] : '';
        $condition = !empty( $args['condition'] ) ? 'data-condition='.json_encode( $args['condition'] ) : '';
        ?>
        <div class="admintosh-label admintosh-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h5><?php echo esc_html( $args['title'] ); ?></h5>
            <div class="input-field-block">
            <input class="number-field" type="number" placeholder="<?php echo esc_html( $args['placeholder'] ); ?>" name="<?php echo esc_attr( $fieldName ); ?>" value="<?php echo esc_html( $value ); ?>"/>
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