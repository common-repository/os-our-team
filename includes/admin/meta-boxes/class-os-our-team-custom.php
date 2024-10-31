<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for custom
 *
 * @class 		ourTeamCustom
 * @version		1.7
 * @category    Class
 * @author 		Offshorent Solutions Pvt Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'ourTeamCustom' ) ) :

    class ourTeamCustom { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_os-our-team', array( &$this, 'os_our_team_custom_meta_box' ), 10, 1 );
        }		

        /**
         * callback function for os_our_team_auto_meta_box.
         */

        public function os_our_team_custom_meta_box() {
            add_meta_box( 	
                            'display_os_our_team_custom_meta_box',
                            'Team Details',
                            array( &$this, 'display_os_our_team_custom_meta_box' ),
                            'os-our-team',
                            'normal', 
                            'low'
                        );
        }

        /**
         * display function for display_os_our_team_custom_meta_box.
         */

        public function display_os_our_team_custom_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'os-our-team', 'os-our-team' );
            include_once( 'views/os-out-team-custom.php' );
        }
    }
endif;

/**
 * Returns the main instance of ourTeamCustom to prevent the need to use globals.
 *
 * @since  1.7
 * @return ourTeamCustom
 */
 
return new ourTeamCustom();
?>