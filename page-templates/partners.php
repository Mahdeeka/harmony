<?php

/**
 * Template Name: Partners
 **/
// header('Location: https://harmony.techro.co.il/comingsoon/', true, 301);

?>
<?php get_header(); ?>

<div class="pb-5 sectionPadding3 bg2">
    <div class="container c16 py-5">
        <div class="row align-items-start ">
            <div class="col-md-4">
                <h1 class="text-white Niloofar fbold fs60"><?php echo the_title(); ?></h1>
                <div class="sc1 fs20 mt-3">
                    <?php echo the_content();?>
                </div>
            </div>
            <?php $partners = get_field('partners');
            if ($partners) { ?>

                <?php foreach ($partners as $partner) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="d-flex align-items-center justify content-center" style="padding:10px;overflow:hidden;backdrop-filter:5px;height:280px;border-radius:5px;background-color:rgba(255,255,255,1);">
                            <img class="d-block mx-auto imgc" src="<?php echo $partner['url']; ?>" alt="<?php echo $partner['alt']; ?>">
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="col-md-4 mb-4">
                <a href="<?php echo get_the_permalink(13);?>"class="d-flex justify-content-center align-items-center justify content-center" style="overflow:hidden;height:280px;border-radius:5px;background-color:#EFDDCE;">
                    <h4 class="text-center fbold sc4 fs43"><?php echo 'كن شريك لنا';?></h4>  
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>