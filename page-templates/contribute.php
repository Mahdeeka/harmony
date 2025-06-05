<?php

/**
 * Template Name: Contribute
 **/
?>

<?php get_header(); ?>

<div class="py-5 bg2">
    <div class="container c16 py-md-5 py-4">
        <div class="row align-items-start justify-content-between">

            <div class="col-md-7">
                <h1 class="text-white mb-5 fs60 Niloofar fbold"><?php echo get_field('top_t'); ?></h1>
                <div class="d-flex align-items-center pb-5 mblock">
                    <div class="fs25 sc1 ">
                        <?php echo get_field('main_paragraph'); ?>
                    </div>
                    <?php $img = get_field('main_image');
                    if ($img) { ?>
                        <img class="d-block imgc mx-auto"src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                    <?php } ?>
                </div>
                <?php $note = get_field('ps_note');
                if ($note) { ?>

                    <div class="mt-5 w-75 mmb20 mw100  fs22 sc1 pl-3" style="border-right:8px solid #EFDDCE;">
                        <?php echo $note; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-5">
                <div class=" pform" style="padding:50px;background-color:#065A3C;border-radius:16px">
                    <div class="joinusform">
                        <?php echo do_shortcode('[contact-form-7 id="ba5a514" title="Contribute"]'); ?>
                    </div>
                    <div class="formsucc " style="padding:80px 0;display:none;">
                        <img class="d-block mx-auto imgc"src="<?php echo get_template_directory_uri() . '/images/succ.png'; ?>" alt="Success">
                        <h4 class="text-center fs43 Niloofar my-4 fbold sc1"><?php echo get_field('success_title'); ?></h4>
                        <div class="text-white text-center fs25"><?php echo get_field('success_par'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    document.addEventListener('wpcf7mailsent', function(event) {
        if ('363' == event.detail.contactFormId) { // Check if it's the specific form
            jQuery('.joinusform').slideUp(); // Hide the form
            jQuery('.formsucc').slideDown(); // Show the success message
        }
    }, false);
</script>