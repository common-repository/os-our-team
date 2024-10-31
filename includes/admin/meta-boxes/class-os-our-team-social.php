<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for social
 *
 * @class 		ourTeamSocial
 * @version		1.7
 * @category    Class
 * @author 		Offshorent Solutions Pvt Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'ourTeamSocial' ) ) :

    class ourTeamSocial { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_os-our-team', array( &$this, 'os_our_team_social_meta_box' ), 10, 1 );
        }		

        /**
         * callback function for os_our_team_social_meta_box.
         */

        public function os_our_team_social_meta_box() {
            add_meta_box( 	
                            'display_os_our_team_social_meta_box',
                            'Social',
                            array( &$this, 'display_os_our_team_social_meta_box' ),
                            'os-our-team',
                            'side', 
                            'low'
                        );
        }

        /**
         * display function for display_os_our_team_social_meta_box.
         */

        public function display_os_our_team_social_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'os-our-team', 'os-our-team' );
            include_once( 'views/os-out-team-social.php' );
        }
    }
endif;

/**
 * Returns the main instance of ourTeamSocial to prevent the need to use globals.
 *
 * @since  1.7
 * @return ourTeamSocial
 */
 
return new ourTeamSocial();
?>