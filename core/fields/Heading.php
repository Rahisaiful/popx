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

trait Heading {

    public function heading_field( $args ) {

        $default = [
            'title' => '',
            'name' => '',
            'placeholder' => ''
        ];

        $args = wp_parse_args( $args, $default );
        $this->heading_markup( $args );
    }

    public function heading_markup( $args ) {
        ?>
        <div class="admintosh-label admintosh-field-wrp block-heading">
            <h3><?php echo esc_html( $args['title'] ); ?></h3>
        </div>
        <?php
    }
}