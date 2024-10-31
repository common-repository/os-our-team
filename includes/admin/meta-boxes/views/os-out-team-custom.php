<?php 
$post_type = new ourTeamPostType();
$custom_meta = $post_type->os_our_team_return_custom_meta( $post_id );
$enable = isset( $custom_meta['details']['enable'] ) ? $custom_meta['details']['enable'] : '';
$front_image = isset( $custom_meta['details']['front-image'] ) ? $custom_meta['details']['front-image'] : '';
$designation = isset( $custom_meta['details']['designation'] ) ? $custom_meta['details']['designation'] : '';
$email_addresss = isset( $custom_meta['details']['email-addresss'] ) ? $custom_meta['details']['email-addresss'] : '';
$phone_number = isset( $custom_meta['details']['phone-number'] ) ? $custom_meta['details']['phone-number'] : '';
?>
<div id="os-bxslider-type-wrapper">
    <div class="option-box">
        <label><b>Front Image</b></label>
        <p class="description">This image is used for the profile picture of team member.</p>
        <input type="text" class="os-input-md" name="osot[details][front-image]" value="<?php echo esc_attr( $front_image ); ?>" id="front_image" />
        <input type="button" class="front_button button insert-media add_media" value="Upload" id="front-<?php echo $post_id; ?>" />        
        <div class="front_image_preview">
            <?php if( !empty( $front_image ) ) {?>
                <img src="<?php echo $front_image;?>" alt="" width="140">
                <span class="img_delete" id="front-<?php echo $post_id; ?>"></span>
            <?php } ?>
        </div>       
    </div>
    <div class="option-box">
        <label><b>Designation</b></label>
        <p class="description">Designation or position of the team member.</p>
        <input type="text" class="os-input" name="osot[details][designation]" value="<?php echo $designation;?>">
    </div>
    <div class="option-box">
        <label><b>Email Addresss</b></label>
        <p class="description">Designation or position of the team member.</p>
        <input type="text" class="os-input" name="osot[details][email-addresss]" value="<?php echo $email_addresss;?>">
    </div>
    <div class="option-box">
        <label><b>Phone Number</b></label>
        <p class="description">Designation or position of the team member.</p>
        <input type="text" class="os-input" name="osot[details][phone-number]" value="<?php echo $phone_number;?>">
    </div>
    <div class="clear"></div>
</div>                                                                                    