<?php if (isset($args['emp'])) {
    $emp = $args['emp'];
    $img_url = get_the_post_thumbnail_url($emp->ID) ? get_the_post_thumbnail_url($emp->ID) : get_template_directory_uri() . '/images/favicon.png';
    $emp_name = $emp->post_title;
    $emp_role = get_field('role',$emp->ID) ?: get_field('field_job_title',$emp->ID);
    $emp_desc = get_field('company', $emp->ID);
	$type=$args['card_type'];
    $socials = get_field('socials', $emp->ID);
    $network = get_field('network', $emp->ID);
    if (isset($args['sc4']) && $args['sc4'] === 'true') {
        $sc4 = 'text-white';
    } else {
        $sc4 = 'sc4';
    }
    if ($network) {
        $network = $network[0];
    } else {
        $network = 'لطاقم هارموني';
    }

?>

    <div
        data-template-uri="<?php echo get_template_directory_uri(); ?>"
        data-name="<?php echo esc_attr($emp_name); ?>"
        data-link="<?php echo esc_url(get_the_permalink($emp->ID)); ?>"
        data-role="<?php echo esc_attr($emp_role); ?>"
        data-desc="<?php echo esc_attr($emp_desc); ?>"
        data-network="<?php echo esc_attr($network); ?>"
        data-socials='<?php echo esc_attr(json_encode($socials)); ?>'
        data-image="<?php echo esc_url($img_url); ?>"
        class="d-block employee-card bgimg <?php echo (get_post_type($emp->ID) === 'students') ? 'no-popup' : ''; ?>"
        href="<?php echo esc_url(get_the_permalink($emp->ID)); ?>"
        style="border-radius:8px;overflow:hidden;background-image:url('')">
        <div class="bgimg mx-auto pointer" style="background-position:top;background-color:#fff;max-width:100%;height:220px;width:220px;<?php if($type!=='team-5') echo 'border-radius:50%';?> ;background-image:url('<?php echo esc_url($img_url) ?>')">

        </div>
        <div class="pointer d-flex align-items-end justify-content-center" style="">
            <div class="mt-3">
                <h4 class="text-center  <?php echo $sc4; ?> fs25 fbold"><?php echo esc_html($emp_name); ?></h4>
                <h4 class="<?php echo $sc4; ?>  flight fs18 text-center"><?php echo esc_html($emp_role); ?></h4>
                <?php if (get_post_type($emp->ID) === 'students') { ?>
                    <div class="text-center">
                        <label class=" d-block fbold"><?php echo 'معلومة عني :'; ?></label>
                        <div class="flight"><?php echo get_field('personal_bio', $emp->ID); ?></div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

<?php } ?>