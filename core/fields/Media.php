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
            'value' => '',
            'condition'   => '',
            'description' => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->media_markup( $args );
    }

    public function media_markup( $args ) {
        
        $value = !empty( $args['value'] ) ? $args['value'] : '';
        $condition = !empty( $args['condition'] ) ? 'data-condition='.wp_json_encode( $args['condition'] ) : '';
        ?>
        <div class="popx-label popx-field-wrp" <?php echo esc_attr( $condition ); ?>>
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
            <div>
                <?php
                if( !empty( $args['description'] ) ) {
                    echo '<p>'.esc_html( $args['description'] ).'</p>';
                }
                ?>
            <input class="popx_background_image" type="text" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
            <input type="button" class="popx_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload', 'popx' ) ?>" />
            </div>
        </div>
        <?php
    }
}