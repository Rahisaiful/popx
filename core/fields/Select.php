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

trait Select {

    public function select_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'placeholder' => '',
            'options' => [],
            'condition' => '',
            'value'     => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->select_markup( $args );
    }

    public function select_markup( $args ) {
        $fieldName = $args['name'];
        $value = !empty( $args['value'] ) ? $args['value'] : '';
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            
            <select class="input-control" name="<?php echo esc_attr( $fieldName ); ?>">
                <?php 
                if( !empty( $args['options'] ) ) {
                    foreach( $args['options'] as $key => $opt ) {
                        echo '<option value="'.esc_attr( $key ).'" '.selected( $key, $value ).'>'.esc_html( $opt ).'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }
    
}