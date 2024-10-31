<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * DM Page Creation
 *
 * @class 		OS_Shortcode
 * @version		1.7
 * @category	Class
 * @author 		Offshorent Solutions Pvt Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'OS_Shortcode' ) ) :

	class OS_Shortcode { 
	
		/**
		 * Constructor
		 */
		
		public function __construct() { 
			
			add_shortcode( 'os-our-team', array( $this, 'get_all_our_team' ) );
		}

		/**
		* Core function for shortcode hook
		*
		* @since  1.7
		*/
		 
		public function get_all_our_team ( $atts ) {
			
			ob_start();
			
			$atts = shortcode_atts(
									array(
										'columns' => '4',
										'orderby' => 'id',
										'order' => 'desc',
										'display' => 'os-classic'
									), $atts );
			extract( $atts );
			?>
			<div class="os-team-wrapper <?php echo $display;?>">
			<?php
			query_posts( array ( 
									'post_type' => 'os-our-team',
									'posts_per_page' => -1,
									'orderby' => $orderby,
									'order' => $order,
								)
						);
						
			$columns = 12 / absint( $columns );
				
			while ( have_posts() ) : the_post();
			
				$custom_meta = get_post_meta( get_the_ID(), 'os_our_team_custom_meta', true );
				$front_image = isset( $custom_meta['details']['front-image'] ) ? $custom_meta['details']['front-image'] : '';				
				$designation = isset( $custom_meta['details']['designation'] ) ? $custom_meta['details']['designation'] : '';
				$email_addresss = isset( $custom_meta['details']['email-addresss'] ) ? $custom_meta['details']['email-addresss'] : '';
				$phone_number = isset( $custom_meta['details']['phone-number'] ) ? $custom_meta['details']['phone-number'] : '';
				$social_enable = isset( $custom_meta['social']['enable'] ) ? $custom_meta['social']['enable'] : '';
				$facebook = isset( $custom_meta['social']['facebook'] ) ? $custom_meta['social']['facebook'] : '';
				$twitter = isset( $custom_meta['social']['twitter'] ) ? $custom_meta['social']['twitter'] : '';
				$linked_in = isset( $custom_meta['social']['linked-in'] ) ? $custom_meta['social']['linked-in'] : '';
				$google_plus = isset( $custom_meta['social']['google-plus'] ) ? $custom_meta['social']['google-plus'] : '';
				$you_tube = isset( $custom_meta['social']['you-tube'] ) ? $custom_meta['social']['you-tube'] : '';
				
				?>
				<?php if( $display == 'os-classic' ) { ?>
					<div class="os-team-box team-box-<?php echo $columns;?>">
						<?php 
						if( !empty( $front_image ) ){
							?>
							<img src="<?php echo $front_image;?>" alt="<?php the_title();?>" />
							<?php
						}
						?>
						<div class="details-wrap">
							<h3><?php the_title();?></h3>
							<?php if( !empty( $designation ) ){ ?><span><?php echo $designation; ?></span><?php } ?>
							<?php the_content();?>
							<?php if( !empty( $email_addresss ) ){ ?><a href="mailto:<?php echo $email_addresss; ?>"><?php echo $email_addresss; ?></a><?php } ?>
							<?php if( !empty( $phone_number ) ){ ?><a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a><?php } ?>
							<?php if( $social_enable == 1 ) { ?>
							<ul>
								<?php if( !empty( $facebook ) ){ ?>
								<li>
									<a href="<?php echo $facebook; ?>" target="_blank">
										<span class="icon-stack">
											<i class="icon-facebook icon-light"></i>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php if( !empty( $twitter ) ){ ?>
								<li>
									<a href="<?php echo $twitter; ?>" target="_blank">
										<span class="icon-stack">
											<i class="icon-twitter icon-light"></i>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php if( !empty( $linked_in ) ){ ?>
								<li>
									<a href="<?php echo $linked_in; ?>" target="_blank">
										<span class="icon-stack">
											<i class="icon-linkedin icon-light"></i>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php if( !empty( $google_plus ) ){ ?>
								<li>
									<a href="<?php echo $google_plus; ?>" target="_blank">
										<span class="icon-stack">
											<i class="icon-google-plus icon-light"></i>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php if( !empty( $you_tube ) ){ ?>
								<li>
									<a href="<?php echo $you_tube; ?>" target="_blank">
										<span class="icon-stack">
											<i class="icon-youtube icon-light"></i>
										</span>
									</a>
								</li>
								<?php } ?>
							</ul>
						<?php } ?>
						</div>						
					</div>
				<?php } ?>
				<?php if( $display == 'os-muse' ) {?>
					<div class="os-team-box team-box-<?php echo $columns;?>">						
						<div class="flipper">
							<div class="front">
								<?php if( !empty( $front_image ) ) {?>
									<img src="<?php echo $front_image;?>" alt="<?php the_title();?>" />
								<?php } ?>	
								<div class="detais-box"><h3><?php the_title();?></h3>
								<?php if( !empty( $designation ) ){ ?><span><?php echo $designation; ?></span><?php } ?></div>
							</div>
							<div class="back">
								<div class="content-wrap">
									<?php the_content();?>
									<?php if( !empty( $email_addresss ) ){ ?><a href="mailto:<?php echo $email_addresss; ?>"><?php echo $email_addresss; ?></a><?php } ?>
									<?php if( !empty( $phone_number ) ){ ?><a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a><?php } ?>
									<?php if( $social_enable == 1 ) { ?>
									<ul>
										<?php if( !empty( $facebook ) ){ ?>
										<li>
											<a href="<?php echo $facebook; ?>" target="_blank">
												<span class="icon-stack">
													<i class="icon-facebook icon-light"></i>
												</span>
											</a>
										</li>
										<?php } ?>
										<?php if( !empty( $twitter ) ){ ?>
										<li>
											<a href="<?php echo $twitter; ?>" target="_blank">
												<span class="icon-stack">
													<i class="icon-twitter icon-light"></i>
												</span>
											</a>
										</li>
										<?php } ?>
										<?php if( !empty( $linked_in ) ){ ?>
										<li>
											<a href="<?php echo $linked_in; ?>" target="_blank">
												<span class="icon-stack">
													<i class="icon-linkedin icon-light"></i>
												</span>
											</a>
										</li>
										<?php } ?>
										<?php if( !empty( $google_plus ) ){ ?>
										<li>
											<a href="<?php echo $google_plus; ?>" target="_blank">
												<span class="icon-stack">
													<i class="icon-google-plus icon-light"></i>
												</span>
											</a>
										</li>
										<?php } ?>
										<?php if( !empty( $you_tube ) ){ ?>
										<li>
											<a href="<?php echo $you_tube; ?>" target="_blank">
												<span class="icon-stack">
													<i class="icon-youtube icon-light"></i>
												</span>
											</a>
										</li>
										<?php } ?>
									</ul>
									<?php } ?>
								</div>
							</div>
							<div class="clear"></div>
						</div>							
					</div>
				<?php } ?>
                <?php if( $display == 'os-grid' ) {?>
                	<div class="os-team-box team-box-<?php echo $columns;?>">
						<?php if( !empty( $front_image ) ){ ?>
                        <div class="team-box-6 left">
            				<img src="<?php echo $front_image;?>" alt="<?php the_title();?>" />
                            <div class="author-box">
                                <h3><?php the_title();?></h3>
                                <?php if( !empty( $designation ) ){ ?><span><?php echo $designation; ?></span><?php } ?>
                            </div>
                        </div>
                       	<?php } ?>
                        <div class="team-box-<?php if( !empty( $front_image ) ){ ?>6<?php } else { ?>12<?php } ?> right">
                            <?php the_content();?>
							<?php if( !empty( $email_addresss ) ){ ?><a href="mailto:<?php echo $email_addresss; ?>"><?php echo $email_addresss; ?></a><?php } ?>
                            <?php if( !empty( $phone_number ) ){ ?><a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a><?php } ?>
                            <?php if( $social_enable == 1 ) { ?>
                            <ul>
                                <?php if( !empty( $facebook ) ){ ?>
                                <li>
                                    <a href="<?php echo $facebook; ?>" target="_blank">
                                        <span class="icon-stack">
                                            <i class="icon-facebook icon-light"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if( !empty( $twitter ) ){ ?>
                                <li>
                                    <a href="<?php echo $twitter; ?>" target="_blank">
                                        <span class="icon-stack">
                                            <i class="icon-twitter icon-light"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if( !empty( $linked_in ) ){ ?>
                                <li>
                                    <a href="<?php echo $linked_in; ?>" target="_blank">
                                        <span class="icon-stack">
                                            <i class="icon-linkedin icon-light"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if( !empty( $google_plus ) ){ ?>
                                <li>
                                    <a href="<?php echo $google_plus; ?>" target="_blank">
                                        <span class="icon-stack">
                                            <i class="icon-google-plus icon-light"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if( !empty( $you_tube ) ){ ?>
                                <li>
                                    <a href="<?php echo $you_tube; ?>" target="_blank">
                                        <span class="icon-stack">
                                            <i class="icon-youtube icon-light"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
				<?php
			endwhile;			
			wp_reset_query();
			?>
			</div>
			<?php
			
			return ob_get_clean();
		}
	}
	
endif;

/**
 * Returns the main instance of OS_Shortcode to prevent the need to use globals.
 *
 * @since  2.0
 * @return OS_Shortcode
 */
 
return new OS_Shortcode();
?>
