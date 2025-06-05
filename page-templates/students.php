<?php

/**
 * Template Name: Students
 **/



?>

<?php get_header(); ?>

<div class="bg2 pb-5 sectionPadding3">
    <div class="container c16 py-md-5">
        <div class="row align-items-start justify-content-between">
            <div class="col-md-2 mmb20">
                <h1 class="text-white mcenter mb-0 fs60 mhfs30 Niloofar fbold"><?php echo the_title(); ?></h1>
            </div>

        </div>
    </div>
</div>

<?php
// Query to get the rest of the team members excluding the CEOs
$args = array(
    'post_type'      => 'students',
    'posts_per_page' => -1,
    'post__not_in'   => $excludes, // Exclude the CEO IDs
);

$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <div class="bg1 py-5">
        <div class="container c16">
            <h2 class="h1 text-center fs43 mhfs30 sc4"><?php echo get_field('members_title'); ?></h2>
            <div class="my-5">
                <input type="text" id="studentSearch" class="form-control" placeholder="ابحث عن طالب بالاسم، التخصص، الجامعة أو أي معلومات أخرى..">
            </div>

            <div class="row justify-content-start " id="employeeList" style="min-height:383px">
                <?php while ($query->have_posts()) : $query->the_post();
                    $role = get_field('role'); // Get role field from ACF
                ?>
                    <div class="col-md-2 mb-4 employee-box"
                        data-name="<?php echo strtolower(get_the_title()); ?>"
                        data-role="<?php echo strtolower(get_field('role')); ?>"
                        data-company="<?php echo strtolower(get_field('company')); ?>"
                        data-network="<?php echo strtolower(implode(', ', (array)get_field('network'))); ?>"
                        data-socials="<?php echo strtolower(get_field('linkedin') . ' ' . get_field('instagram')); ?>"
                        data-info="<?php
                                    $info_content = '';
                                    if (have_rows('info')) {
                                        while (have_rows('info')) {
                                            the_row();
                                            $info_content .= strtolower(get_sub_field('title')) . ' ';
                                            $info_content .= strtolower(strip_tags(get_sub_field('content'))) . ' ';
                                        }
                                    }
                                    echo esc_attr($info_content);
                                    ?>">
                        <?php echo get_template_part('parts/emp', null, array('emp' => $post)); ?>
                    </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php
endif;
wp_reset_postdata(); // Reset query
?>


<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($) {
        $("#employeeSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            $(".employee-box").filter(function() {
                var name = $(this).data("name"); // Employee name (post title)
                var role = $(this).data("role"); // Role from ACF
                var company = $(this).data("company"); // Company from ACF
                var network = $(this).data("network"); // Network from ACF
                var socials = $(this).data("socials"); // Social links from ACF
                var info = $(this).data("info"); // Info repeater from ACF

                // Check if any of the fields contain the search value
                if (name.includes(value) || role.includes(value) || company.includes(value) || network.includes(value) || socials.includes(value) || info.includes(value)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>