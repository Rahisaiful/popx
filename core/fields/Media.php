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

trait Media {

    public function media_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'condition'   => '',
            'description' => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->media_markup( $args );
    }

    public function media_markup( $args ) {
        $fieldName = 'admintosh_options['.esc_attr( $args['name'] ).']';
        $opt = get_option('admintosh_options');
        $value = !empty( $opt[$args['name']] ) ? $opt[$args['name']] : '';
        $condition = !empty( $args['condition'] ) ? 'data-condition='.json_encode( $args['condition'] ) : '';
        ?>
        <div class="admintosh-label admintosh-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h5><?php echo esc_html( $args['title'] ); ?></h5>
            <div>
                <?php
                if( !empty( $args['description'] ) ) {
                    echo '<p>'.esc_html( $args['description'] ).'</p>';
                }
                ?>
            <input class="admintosh_background_image" type="text" name="<?php echo esc_attr( $fieldName ); ?>" value="<?php echo esc_attr( $value ); ?>" />
            <input type="button" class="admintosh_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload', 'admintosh' ) ?>" />
            </div>
        </div>
        <?php
    }
}