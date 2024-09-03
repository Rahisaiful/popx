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

class Fields_Maping {

    use Text;
    use Color;
    use Media;
    use Switcher;
    use Heading;
    use Dimension;
    use Number;
    use Border;
    use Select;
    use Box_Shadow;
    use Image_Radio_Button;
    use Border_Radius;

    public function get_name() {
        return '';
    }

    public function scripts() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function enqueue_scripts( $hook ) {

            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_media();
            wp_enqueue_style( 'jquery-ui', \POPX_DIR_URL.'/core/fields/assets/css/jquery-ui.css', array(), \POPX_VERSION, false );
            wp_enqueue_style( 'popx-fields', \POPX_DIR_URL.'/core/fields/assets/css/fields.css', array(), \POPX_VERSION, false  );

            wp_enqueue_script( 'wp-color-picker-alpha', \POPX_DIR_URL.'/core/fields/assets/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker' ), \POPX_VERSION, true );
            wp_enqueue_script( 'popx-fields', \POPX_DIR_URL.'/core/fields/assets/js/fields.js', array('jquery', 'wp-color-picker','jquery-ui-slider' ), \POPX_VERSION, true );
        
    }

}
