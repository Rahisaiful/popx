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

trait Switcher {

    public function switcher_field( $args ) {

        $default = [
            'title'      => '',
            'name'       => '',
            'condition'  => '',
            'value'      => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->switcher_markup( $args );
    }

    public function switcher_markup( $args ) {

        $fieldName = $args['name'];
        
        $value = !empty( $args['value'] ) ? $args['value'] : '';
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <label class="switcher-switch">
              <input name="<?php echo esc_attr( $fieldName ); ?>" type="checkbox" <?php echo checked( $value, 'on' ); ?>>
              <span class="switcher-slider switcher-round"></span>
            </label>

        </div>
        <?php
    }

}