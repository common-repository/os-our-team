<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * DM Page Creation
 *
 * @class 		OS_Settings
 * @version		1.7
 * @category	Class
 * @author 		Offshorent Solutions Pvt Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'OS_Settings' ) ) :

	class OS_Settings { 
	
		/**
		 * Constructor
		 */
		
		public function __construct() { 
			
			add_action( 'admin_init', array( $this, 'our_team_admin_init' ) );
			add_action( 'admin_menu', array( $this, 'our_team_admin_theme_settings' ) );
		}

		/**
		 * Creating a admin setting menu for design maker
		 */
		 
		public function our_team_admin_theme_settings() {
			
			add_submenu_page( 'edit.php?post_type=os-our-team', __( 'Our Team Settings', OT_TEXT_DOMAIN ), __( 'Settings', OT_TEXT_DOMAIN ), 'manage_options', 'os-settings', array( $this, 'our_team_settings_admin_menu' ) );
		}

		/**
		* Setting function for ourteam blog
		*
		* @since  1.7
		*/
		 
		public function our_team_settings_admin_menu () {
	
			ob_start();
	
			$options = get_option( 'ourteam_settings' );
				 
			// General option values
			$font_family = isset( $options['font_family'] ) ? esc_attr( $options['font_family'] ) : 'Open Sans';
			
			// Heading option values
			$heading_font_size = isset( $options['heading_font_size'] ) ? esc_attr( $options['heading_font_size'] ) : '24px';
			$heading_font_color = isset( $options['heading_font_color'] ) ? esc_attr( $options['heading_font_color'] ) : '#000000';			
	
			// Content option values
			$content_font_size = isset( $options['content_font_size'] ) ? esc_attr( $options['content_font_size'] ) : '14px';
			$content_font_color = isset( $options['content_font_color'] ) ? esc_attr( $options['content_font_color'] ) : '#999999';
			
			// Color option values
			$bg_color = isset( $options['bg_color'] ) ? esc_attr( $options['bg_color'] ) : '#f0e7cd';
			$social_bg_color = isset( $options['social_bg_color'] ) ? esc_attr( $options['social_bg_color'] ) : '#f6c542';
			$custom_css = isset( $options['custom_css'] ) ? esc_attr( $options['custom_css'] ) : '';
			?>
			<div class="wrap">
				<h2><?php _e( "Our Team Blog Settings", "OT_TEXT_DOMAIN" );?></h2>           
				<form method="post" action="options.php">
					<?php settings_fields( 'ourteam_blog' ); ?>
					<div class="form-table">
						<div class="form-widefat">
							<h3><?php _e( "General Settings", "OT_TEXT_DOMAIN" );?></h3>
							<div class="row-table">
								<label><?php _e( "Font Family:", "OT_TEXT_DOMAIN" );?></label>
								<select id="font_family" name="ourteam_settings[font_family]">
									<option value="Arial" <?php selected( $font_family, 'Arial' ); ?>>Arial</option>
									<option value="Verdana" <?php selected( $font_family, 'Verdana' ); ?>>Verdana</option>
									<option value="Helvetica" <?php selected( $font_family, 'Helvetica' ); ?>>Helvetica</option>
									<option value="Comic Sans MS" <?php selected( $font_family, 'Comic Sans MS' ); ?>>Comic Sans MS</option>
									<option value="Georgia" <?php selected( $font_family, 'Georgia' ); ?>>Georgia</option>
									<option value="Trebuchet MS" <?php selected( $font_family, 'Trebuchet MS' ); ?>>Trebuchet MS</option>
									<option value="Times New Roman" <?php selected( $font_family, 'Times New Roman' ); ?>>Times New Roman</option>
									<option value="Tahoma" <?php selected( $font_family, 'Tahoma' ); ?>>Tahoma</option>
									<option value="Oswald" <?php selected( $font_family, 'Oswald' ); ?>>Oswald</option>
									<option value="Open Sans" <?php selected( $font_family, 'Open Sans' ); ?>>Open Sans</option>
									<option value="Fontdiner Swanky" <?php selected( $font_family, 'Fontdiner Swanky' ); ?>>Fontdiner Swanky</option>
									<option value="Crafty Girls" <?php selected( $font_family, 'Crafty Girls' ); ?>>Crafty Girls</option>
									<option value="Pacifico" <?php selected( $font_family, 'Pacifico' ); ?>>Pacifico</option>
									<option value="Satisfy" <?php selected( $font_family, 'Satisfy' ); ?>>Satisfy</option>
									<option value="Gloria Hallelujah" <?php selected( $font_family, 'TGloria Hallelujah' ); ?>>TGloria Hallelujah</option>
									<option value="Bangers" <?php selected( $font_family, 'Bangers' ); ?>>Bangers</option>
									<option value="Audiowide" <?php selected( $font_family, 'Audiowide' ); ?>>Audiowide</option>
									<option value="Sacramento" <?php selected( $font_family, 'Sacramento' ); ?>>Sacramento</option>
								</select>
								<div class="clear"></div>
							</div>
							<h3><?php _e( "Heading Settings", "OT_TEXT_DOMAIN" );?></h3>                            
							<div class="row-table">
								<label><?php _e( "Font Size:", "OT_TEXT_DOMAIN" );?></label>
								<select name="ourteam_settings[heading_font_size]">
									<?php for( $i = 16; $i < 33; $i++ ) { ?> 
									<option value="<?php echo $i;?>px" <?php selected( $heading_font_size, $i . 'px' ); ?>><?php echo $i;?>px</option>
									<?php } ?>
								</select>
								<div class="clear"></div>
							</div>
							<div class="row-table">
								<label><?php _e( "Font Color:", "OT_TEXT_DOMAIN" );?></label>
								<input type="color" name="ourteam_settings[heading_font_color]" value="<?php echo $heading_font_color;?>" class="small" />
								<div class="clear"></div>
							</div>
							<h3><?php _e( "Content Settings", "OT_TEXT_DOMAIN" );?></h3>     
							<div class="row-table">
								<label><?php _e( "Font Size:", "OT_TEXT_DOMAIN" );?></label>
								<select name="ourteam_settings[content_font_size]">
									<?php for( $j = 10; $j < 21; $j++ ) { ?> 
									<option value="<?php echo $j;?>px" <?php selected( $content_font_size, $j . 'px' ); ?>><?php echo $j;?>px</option>
									<?php } ?>
								</select>
								<div class="clear"></div>
							</div>
							<div class="row-table">
								<label><?php _e( "Content Font Color:", "OT_TEXT_DOMAIN" );?></label>
								<input type="color" name="ourteam_settings[content_font_color]" value="<?php echo $content_font_color;?>" class="small" />
								<div class="clear"></div>
							</div>                        
							<h3><?php _e( "Background Color Settings", "OT_TEXT_DOMAIN" );?></h3>
							<div class="row-table">
								<label><?php _e( "Background Color:", "OT_TEXT_DOMAIN" );?></label>
								<input type="color" name="ourteam_settings[bg_color]" value="<?php echo $bg_color;?>" class="small" />
								<div class="clear"></div>
							</div>
							<div class="row-table">
								<label><?php _e( "Social Icons Color:", "OT_TEXT_DOMAIN" );?></label>
								<input type="color" name="ourteam_settings[social_bg_color]" value="<?php echo $social_bg_color;?>" class="small" />
								<div class="clear"></div>
							</div>
                            <h3><?php _e( "Custom CSS", "OT_TEXT_DOMAIN" );?></h3>     
							<div class="row-table">
								<textarea name="ourteam_settings[custom_css]" class="custom_css"><?php echo $custom_css; ?></textarea>
								<div class="clear"></div>
							</div>                    
						</div>
					</div>	                				
					<?php submit_button(); ?>
				</form>
			</div>
			<?php 
	
			return ob_get_contents();
		}  
	
		/**
		* Admin init ourTeam when WordPress Initialises.
		* @since  1.7
		*/
		 
		public function our_team_admin_init() {
	
			register_setting(
				'ourteam_blog', // Option group
				'ourteam_settings', // Option name
				array( $this, 'sanitize' ) // Sanitize
			);
		}
		
		/**
		* Sanitize each setting field as needed
		* @since 1.7
		*/
			 
		public function sanitize( $input ) {
			
			 
			$new_input = array();
			
			// General Settings option values			
	
			if( isset( $input['font_family'] ) )
				$new_input['font_family'] = sanitize_text_field( $input['font_family'] );			
				
			// Heading Settings option values
			if( isset( $input['heading_font_size'] ) )
				$new_input['heading_font_size'] = sanitize_text_field( $input['heading_font_size'] );
				
			if( isset( $input['heading_font_color'] ) )
				$new_input['heading_font_color'] = sanitize_text_field( $input['heading_font_color'] );	
							
			// Content Settings option values
			if( isset( $input['content_font_size'] ) )
				$new_input['content_font_size'] = sanitize_text_field( $input['content_font_size'] );
				
			if( isset( $input['content_font_color'] ) )
				$new_input['content_font_color'] = sanitize_text_field( $input['content_font_color'] );	
			
	
			// Background Color Settings option values	
			if( isset( $input['bg_color'] ) )
				$new_input['bg_color'] = sanitize_text_field( $input['bg_color'] );
				
			if( isset( $input['social_bg_color'] ) )
				$new_input['social_bg_color'] = sanitize_text_field( $input['social_bg_color'] );
							
			if( isset( $input['custom_css'] ) )
				$new_input['custom_css'] = sanitize_text_field( $input['custom_css'] );			
				
			return $new_input;
		}
	}
	
endif;

/**
 * Returns the main instance of OS_Settings to prevent the need to use globals.
 *
 * @since  2.0
 * @return OS_Settings
 */
 
return new OS_Settings();
?>
