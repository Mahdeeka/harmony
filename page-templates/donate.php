<?php

/**
 * Template Name: Donate
 **/
?>

<?php get_header(); ?>

<div class="pb-5 sectionPadding3 bg2">
    <div class="container c16 py-5">
        <div class="row align-items-start justify-content-between">

            <div class="col-md-5">
                <div class="joinusform">
                    <h1 class="text-white mb-5 fs60 Niloofar fbold"><?php echo get_field('top_t'); ?></h1>
                    <div class="d-flex align-items-center pb-5">
                        <div class="fs25 sc1 ">
                            <?php echo get_field('main_paragraph'); ?>
                        </div>
                    </div>
                </div>
                <div class=" pform">
                    <div class="joinusform">
                        <?php echo do_shortcode('[contact-form-7 id="497" title="Donate"]'); ?>
                    </div>
                    <div class="formsucc " style="padding:80px 0;display:none;">
                        <img class="d-block imgc" src="<?php echo get_template_directory_uri() . '/images/succ.png'; ?>" alt="Success">
                        <h4 class=" fs43 Niloofar my-4 fbold sc1"><?php echo get_field('success_title'); ?></h4>
                        <div class="sc1 fs25"><?php echo get_field('success_par'); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="d-block mx-auto imgc" alt="Contact">
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    document.addEventListener('wpcf7mailsent', function(event) {
        if ('497' == event.detail.contactFormId) { // Check if it's the specific form
            jQuery('.joinusform').slideUp(); // Hide the form
            jQuery('.formsucc').slideDown(); // Show the success message
        }
    }, false);
</script>