<?php 
$post_type = new ourTeamPostType();
$custom_meta = $post_type->os_our_team_return_custom_meta( $post_id );
$enable = isset( $custom_meta['social']['enable'] ) ? $custom_meta['social']['enable'] : '';
$facebook = isset( $custom_meta['social']['facebook'] ) ? $custom_meta['social']['facebook'] : '';
$twitter = isset( $custom_meta['social']['twitter'] ) ? $custom_meta['social']['twitter'] : '';
$linked_in = isset( $custom_meta['social']['linked-in'] ) ? $custom_meta['social']['linked-in'] : '';
$google_plus = isset( $custom_meta['social']['google-plus'] ) ? $custom_meta['social']['google-plus'] : '';
$you_tube = isset( $custom_meta['social']['you-tube'] ) ? $custom_meta['social']['you-tube'] : '';
?>
<div id="os-bxslider-type-wrapper">
    <div class="option-box box-2">
        <label><b>Enable Social Icons</b></label>
        <p class="description">If <b>true</b>, social icons will be shown on the front end.</p>
        <input type="checkbox" name="osot[social][enable]" value="1" <?php checked( $enable, 1 );?>/>        
    </div>
    <div class="option-box box-2">
        <label><b>Facebook</b></label>
        <p class="description">Facebook profile link for team member eg: <b>https://www.facebook.com/Offshorent</b>.</p>
        <input type="text" class="os-input" name="osot[social][facebook]" value="<?php echo $facebook;?>" />        
    </div>
    <div class="option-box box-2 last">
        <label><b>Twitter</b></label>
        <p class="description">Twitter profile link for team member eg: <b>https://twitter.com/Offshorent</b>.</p>
        <input type="text" class="os-input" name="osot[social][twitter]" value="<?php echo $twitter;?>" />        
    </div>
    <div class="option-box box-2">
        <label><b>Linked In</b></label>
        <p class="description">Linked In profile link for team member eg: <b>https://www.linkedin.com/company/offshorent</b>.</p>
        <input type="text" class="os-input" name="osot[social][linked-in]" value="<?php echo $linked_in;?>" />        
    </div>
    <div class="option-box box-2 last">
        <label><b>Google Plus</b></label>
        <p class="description">Google Plus profile link for team member eg: <b>https://plus.google.com/+Offshorent/posts</b>.</p>
        <input type="text" class="os-input" name="osot[social][google-plus]" value="<?php echo $google_plus;?>" />        
    </div>
    <div class="option-box box-2 last">
        <label><b>You Tube</b></label>
        <p class="description">You Tube profile link for team member eg: <b>http://www.youtube.com/user/Offshorent</b>.</p>
        <input type="text" class="os-input" name="osot[social][you-tube]" value="<?php echo $you_tube;?>" />        
    </div>
    <div class="clear"></div>
</div>                                                                                    