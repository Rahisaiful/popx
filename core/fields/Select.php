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
            'condition'   => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->select_markup( $args );
    }

    public function select_markup( $args ) {
        $fieldName = 'admintosh_options['.esc_attr( $args['name'] ).']';
        $opt = get_option('admintosh_options');
        $value = !empty( $opt[$args['name']] ) ? $opt[$args['name']] : '';
        $condition = !empty( $args['condition'] ) ? 'data-condition='.json_encode( $args['condition'] ) : '';
        ?>
        <div class="admintosh-label admintosh-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h5><?php echo esc_html( $args['title'] ); ?></h5>
            
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