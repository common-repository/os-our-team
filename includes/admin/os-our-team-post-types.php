<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Registers post types and taxonomies
 *
 * @class       ourTeamPostType
 * @version     1.7
 * @category    Class
 * @author      Offshorent Solutions Pvt Ltd. | Jinesh.P.V.
 */
 
if ( ! class_exists( 'ourTeamPostType' ) ) :
    
    class ourTeamPostType { 
        
        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'init', array( &$this, 'register_os_bxslider_post_types' ) );
            add_filter( 'manage_edit-os-our-team_columns', array( &$this, 'os_out_team_edit_columns' ), 10, 2 );
            add_action( 'manage_os-our-team_posts_custom_column', array( &$this, 'os_our_team_custom_column' ), 10, 2 );
            add_action( 'save_post', array( &$this, 'os_our_team_save_values' ) );
        }

        /**
         * Register os_bxslider post types.
         */

        public static function register_os_bxslider_post_types() {
            
            self::os_our_team_includes();

            if ( post_type_exists( 'os-our-team' ) )
                return;

            $label              =   'Our Team';
            $labels = array(
                'name'                  =>  _x( $label, 'post type general name' ),
                'singular_name'        =>   _x( $label, 'post type singular name' ),
                'add_new'               =>  _x( 'Add New', OT_TEXT_DOMAIN ),
                'add_new_item'          =>  __( 'Add New Team Member', OT_TEXT_DOMAIN ),
                'edit_item'             =>  __( 'Edit Team Member', OT_TEXT_DOMAIN),
                'new_item'              =>  __( 'New Team Member' , OT_TEXT_DOMAIN ),
                'view_item'             =>  __( 'View Team Member', OT_TEXT_DOMAIN ),
                'search_items'          =>  __( 'Search ' . $label ),
                'not_found'             =>  __( 'Nothing found' ),
                'not_found_in_trash'    =>  __( 'Nothing found in Trash' ),
                'parent_item_colon'     =>  ''
            );

            register_post_type( 'os-our-team', 
                apply_filters( 'os_our_team_register_post_types',
                    array(
                            'labels'                 => $labels,
                            'public'                 => true,
                            'publicly_queryable'     => true,
                            'show_ui'                => true,
                            'exclude_from_search'    => true,
                            'query_var'              => true,
                            'has_archive'            => false,
                            'hierarchical'           => true,
                            'menu_position'          => 20,
                            'menu_icon'              => 'dashicons-groups',
                            'show_in_nav_menus'      => true,
                            'supports'               => array( 'title', 'editor' )
                        )
                )
            );                              
        }
        
        /**
         * Includes the metabox classes and views
         */
        
        public static function os_our_team_includes() {
            
            include_once( 'meta-boxes/class-os-our-team-custom.php' );
            include_once( 'meta-boxes/class-os-our-team-social.php' );
        }
        
        /**
         * os_bxslider slider edit columns.
         */

        public function os_out_team_edit_columns() {

            $columns = array(
                'cb'                          =>    '<input type="checkbox" />',
                'title'                       =>    'Title',
                'osot-designation'            =>    'Designation',
                'osot-email'                  =>    'Email Address',
                'osot-phone'                  =>    'Phone Numer',
                'date'                        =>    'Date'
            );

            return $columns;
        }

        /**
         * display os_bxslider slider custom columns.
         */

        public function os_our_team_custom_column( $column, $post_id ) {

            $custom_meta = self::os_our_team_return_custom_meta( $post_id );
            $designation = isset( $custom_meta['details']['designation'] ) ? $custom_meta['details']['designation'] : '';
            $email_addresss = isset( $custom_meta['details']['email-addresss'] ) ? $custom_meta['details']['email-addresss'] : '';
            $phone_number = isset( $custom_meta['details']['phone-number'] ) ? $custom_meta['details']['phone-number'] : '';

            switch ( $column ) {
                case 'osot-designation':                    
                    if ( ! empty( $designation ) )
                        echo ucwords( $designation );
                    break;
                case 'osot-email':
                    if ( !empty( $email_addresss ) )
                        echo ucwords( $email_addresss );
                    break;
                case 'osot-phone':
                    if ( !empty( $phone_number ) )
                        echo ucwords( $phone_number );
                    break;
            }
        }
        
        /**
        * storing meta fields function for os_bxslider_save_slider_values.
        */

        public function os_our_team_save_values( $post_id ) {

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
                return;

            if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) )
                    return;
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
            }

            if ( ! empty( $_POST['osot'] ) ) {
                update_post_meta( $post_id, 'os_our_team_custom_meta', $_POST['osot'] );
            }
        }
       
       /**
        * return slider custom meta values.
        */

        public function os_our_team_return_custom_meta( $post_id ) {

            return $slider_custom_meta = get_post_meta( $post_id, 'os_our_team_custom_meta', true );
        }
    }
endif;

/**
 * Returns the main instance of ourTeamPostType to prevent the need to use globals.
 *
 * @since  1.7
 * @return ourTeamPostType
 */
 
return new ourTeamPostType();
?>