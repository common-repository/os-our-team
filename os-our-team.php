<?php
/**
 * Plugin Name: OS Our Team
 * Plugin URI: http://offshorent.com/blog/extensions/os-our-team
 * Description: Display your employees, team members, or any type of list.
 * Version: 1.7
 * Author: Offshorent Solutions Pvt Ltd. | Jinesh.P.V
 * Author URI: http://www.offshorent.com/
 * Requires at least: 4.3
 * Tested up to: 4.7.4
**/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ourTeam' ) ) :

/**
 * Main ourTeam Class
 *
 * @class ourTeam
 * @version	1.7
 */

final class ourTeam {
	
	/**
	* @var string
	* @since 1.7
	*/
	 
	public $version = '1.7';

	/**
	* @var ourTeam The single instance of the class
	* @since 1.7
	*/
	 
	protected static $_instance = null;

	/**
	* Main ourTeam Instance
	*
	* Ensures only one instance of ourTeam is loaded or can be loaded.
	*
	* @since 1.7
	* @static
	* @return ourTeam - Main instance
	*/
	 
	public static function init_instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
	}

	/**
	* Cloning is forbidden.
	*
	* @since 1.7
	*/

	public function __clone() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'our-team' ), '1.7' );
	}

	/**
	* Unserializing instances of this class is forbidden.
	*
	* @since 1.7
	*/
	 
	public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'our-team' ), '1.7' );
	}
        
	/**
	* Get the plugin url.
	*
	* @since 1.7
	*/

	public function plugin_url() {
        return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	* Get the plugin path.
	*
	* @since 1.7
	*/

	public function plugin_path() {
        return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	* Get Ajax URL.
	*
	* @since 1.7
	*/

	public function ajax_url() {
        return admin_url( 'admin-ajax.php', 'relative' );
	}
        
	/**
	* ourTeam Constructor.
	* @access public
	* @return ourTeam
	* @since 1.7
	*/
	 
	public function __construct() {
		
        register_activation_hook( __FILE__, array( $this, 'our_team_install' ) );

        // Define constants
        self::our_team_constants();

        // Include required files
        self::our_team_includes();

        // Action Hooks
        add_action( 'init', array( $this, 'our_team_init' ) );
        add_action( 'admin_head', array( &$this, 'our_team_admin_media_scripts' ) );
        add_action( 'after_setup_theme', array( $this, 'add_image_sizes' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'our_team_admin_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'our_team_frontend_styles' ) ); 

        //Filter Hook
        add_filter( 'widget_text', 'do_shortcode', 11 );
	}
        
	/**
	* Install ourTeam
	* @since 1.7
	*/
	 
	public function our_team_install (){
		
        // Flush rules after install
        flush_rewrite_rules();

        // Redirect to welcome screen
        set_transient( '_our_team_activation_redirect', 1, 60 * 60 );
	}
        
	/**
	* Define ourTeam Constants
	* @since 1.7
	*/
	 
	private function our_team_constants() {
		
		define( 'OT_PLUGIN_FILE', __FILE__ );
		define( 'OT_PLUGIN_BASENAME', plugin_basename( dirname( __FILE__ ) ) );
		define( 'OT_PLUGIN_URL', plugins_url() . '/' . OT_PLUGIN_BASENAME );
		define( 'OT_VERSION', $this->version );
		define( 'OT_TEXT_DOMAIN', 'our_team' );
		define( 'OT_PERMALINK_STRUCTURE', get_option( 'permalink_struture' ) ? '&' : '?' );
		
	}
        
	/**
	* includes defaults files
	*
	* @since 1.7
	*/
	 
	private function our_team_includes() {
		
		if( is_admin() ) {
			include_once( 'includes/admin/os-our-team-post-types.php' );
			include_once( 'includes/admin/os-our-team-about.php' );
			include_once( 'includes/admin/os-our-team-settings.php' );
		}
		include_once( 'includes/os-our-team-shortcode.php' );
	}
        
	/**
	* Init ourTeam when WordPress Initialises.
	* @since 1.7
	*/
	 
	public function our_team_init() {
            
        self::our_team_do_output_buffer();
	}
    
    /**
	* Add web portfolio image sizes to WP
	* @since 1.7
	*/
	public function add_image_sizes() {

		add_image_size( 'our_team', 197, 197, true );
	}

	/**
	* Clean all output buffers
	*
	* @since  1.7
	*/
	 
	public function our_team_do_output_buffer() {
            
        ob_start( array( $this, "our_team_do_output_buffer_callback" ) );
	}

	/**
	* Callback function
	*
	* @since  1.7
	*/
	 
	public function our_team_do_output_buffer_callback( $buffer ){
        return $buffer;
	}
	
	/**
	* Clean all output buffers
	*
	* @since  1.7
	*/
	 
	public function our_team_flush_ob_end(){
        ob_end_flush();
	}

	/**
	 * Admin side media js hook for designMaker
	 *
	 * @return @void
	*/
	 
	public function our_team_admin_media_scripts() {
		
        if( get_post_type() == 'os-our-team' ) {
			if( function_exists( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			} else {
				wp_enqueue_style( 'thickbox' );
				wp_enqueue_script( 'media-upload' );
				wp_enqueue_script( 'thickbox' );
			}
		}
	}

	/**
	* admin style hook for ourTeam
	*
	* @since  1.7
	*/
	 
	public function our_team_admin_styles() {	        
        wp_enqueue_style( 'admin-style', plugins_url( 'css/admin/style-min.css', __FILE__ ) ); 
        wp_enqueue_script( 'admin-init', plugins_url( 'js/admin/custom-min.js', __FILE__ ), array(), '1.7.2', true );
		wp_localize_script( 'admin-init', 'ot_admin_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );    
	}

	/**
	* Frontend style hook for ourTeam
	*
	* @since  1.7
	*/
	 
	public function our_team_frontend_styles() {
		
		if( !is_admin() ){

			$options = get_option( 'ourteam_settings' );

			// General option values
			$font_family = isset( $options['font_family'] ) ? esc_attr( $options['font_family'] ) : '';

			// Heading option values
			$heading_font_size = isset( $options['heading_font_size'] ) ? esc_attr( $options['heading_font_size'] ) : '';
			$heading_font_color = isset( $options['heading_font_color'] ) ? esc_attr( $options['heading_font_color'] ) : '';         

			// Content option values
			$content_font_size = isset( $options['content_font_size'] ) ? esc_attr( $options['content_font_size'] ) : '';
			$content_font_color = isset( $options['content_font_color'] ) ? esc_attr( $options['content_font_color'] ) : '';

			// Color option values
			$bg_color = isset( $options['bg_color'] ) ? esc_attr( $options['bg_color'] ) : '';
			$social_bg_color = isset( $options['social_bg_color'] ) ? esc_attr( $options['social_bg_color'] ) : '';
			$back_custom_css = isset( $options['custom_css'] ) ? esc_attr( $options['custom_css'] ) : '';
			$custom_css = ".os-team-wrapper .os-team-box {
								font:300 {$content_font_size} {$font_family};
								color: {$content_font_color}
							}
							.os-team-wrapper .os-team-box h3 {
								font:300 {$heading_font_size} {$font_family};
								color: {$heading_font_color}
							}
							.os-team-wrapper .os-team-box ul li span i {
								background: {$social_bg_color};
							}
							.os-team-wrapper .os-team-box ul li span i:hover {
								background: {$bg_color};
							}
							.os-muse .os-team-box .flipper .content-wrap {
								background: {$bg_color};
							}
							.os-team-wrapper.os-muse .os-team-box ul li span i:hover {
								color: {$bg_color};
								background: {$social_bg_color};
							}
							.os-team-wrapper.os-grid .os-team-box .author-box {
								background: {$bg_color};
								padding: 3px 0;
							}
							.os-team-wrapper.os-grid .os-team-box .right {
								border-bottom: 5px solid {$bg_color};
							}";
			$custom_css = $custom_css . $back_custom_css;

	        wp_enqueue_style( 'os-team-fonts', '//fonts.googleapis.com/css?family=Oswald|Open+Sans|Fontdiner+Swanky|Crafty+Girls|Pacifico|Satisfy|Gloria+Hallelujah|Bangers|Audiowide|Sacramento' );							 			wp_enqueue_style( 'os-team-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' );
	        wp_enqueue_style( 'os-team-main', plugins_url( 'css/frontend-style-min.css', __FILE__ ) );
	        wp_enqueue_script( 'os-team-flip', plugins_url( 'js/flip-min.js', __FILE__ ), array(), '2.0.2', true );
	        wp_enqueue_script( 'os-team-init', plugins_url( 'js/init-min.js', __FILE__ ), array(), '1.1.7', true );
	        wp_add_inline_style( 'os-team-main', $custom_css );  
        }      
	}
}

endif;

/**
 * Returns the main instance of ourTeam to prevent the need to use globals.
 *
 * @since  1.7
 * @return ourTeam
 */
 
return new ourTeam;
?>