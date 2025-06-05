<?php

/**
 * Template Name: Coming Soon
 **/
?>

<?php get_header(); ?>

<div class="py-5 bg2">
    <div class="container c16 py-5">
        <div class="row align-items-start justify-content-between">

            <div class="col-md-7">
                <div class="joinusform">
                    <h1 class="text-white mb-5 fs60  fbold"><?php echo the_title(); ?></h1>

                    <div class="fs60 sc1 ">
                        <?php echo the_content() ?>
                    </div>
                    <a class="d-block cslink"  href="<?php echo get_page_link(356);?>">
                        <?php echo 'إنضموا إالينا';?>
                    </a>
                </div>

            </div>
            <div class="col-md-5">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="d-block mx-auto imgc" alt="Contact">
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
