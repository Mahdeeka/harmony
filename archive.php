<?php

$category = get_queried_object();
get_header(); ?>

<div class=" sectionPadding bg2">
    <div class="container c16 p-md-5 p-4 ">
        <div class="row align-items-start justify-content-between">

            <div class="col-md-5">
                <div class="">
                    <h1 class="text-white mb-5 fs60 Niloofar fbold mmb20"><?php echo get_field('top_t', $category); ?></h1>
                    <div class="d-flex align-items-center pb-5">
                        <div class="fs25 sc1 ">
                            <?php echo get_field('main_paragraph', $category); ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <img class="articlePrev d-md-none d-block mx-auto mb-4 pointer" style="transform:rotate(180deg);" src="<?php echo get_template_directory_uri() . '/images/down.png'; ?>" alt="Down">
                <div class="articlesSlider">

                    <?php if (have_posts()) : $i = 1;
                        while (have_posts()) : the_post(); ?>
                            <div class="mb-4">
                                <a href="#postContents" style="border-radius:8px;background-color:#0A6247;" data-content="<?php echo 'postContent' . $i; ?>" class="pointer postLoader px-md-5 px-4 py-4 d-flex align-items-center justify-content-between">
                                    <h4 class="fs25 sc1 Niloofar mb-0"><?php echo get_the_title(); ?></h4>
                                    <img src="<?php echo get_template_directory_uri() . '/images/arrow.svg'; ?>" alt="Arrow">
                                </a>
                            </div>

                        <?php $i++;
                        endwhile; ?>
                    <?php endif; ?>

                </div>
                <img class="articleNext d-block mx-auto mt-4 pointer" src="<?php echo get_template_directory_uri() . '/images/down.png'; ?>" alt="Down">
            </div>
        </div>
    </div>
</div>
<?php $args = array('posts_per_page' => 1, 'post_type' => 'post', 'order' => 'ASC', 'orderby' => 'DATE');
$post = get_posts($args);
if ($post) { ?>
    <div class="bg1 py-5" id="postContents">
        <?php $i = 1;
        foreach ($posts as $post) { ?>
            <div style="display:none;" class="postContent postContent<?php echo $i; ?>">
                <div class="container c16">

                    <h2 class="text-center fs60 mb-5 sc4 Niloofar fbold"><?php echo $post->post_title; ?></h2>
                    <?php $article_group = get_field('article', $post->ID);
                    if ($article_group) {
                        $main_title = $article_group['main_title'];
                        $main_image = $article_group['main_image'];
                        $date = $article_group['date'];
                        $main_paragraph = $article_group['main_paragraph'];
                    ?>
                        <div class="d-flex mblock articlebox align-items-center mb-4">
                            <div class=" bgimg mw100 mbh300" style="width:30%;border-radius:16px;height:490px;background-image:url('<?php echo $main_image['url']; ?>')">

                            </div>
                            <div class="p-md-5 p-4 mw100" style="width:70%;">
                                <h4 class="sc5 fs30 fbold"><?php echo $main_title . ' - ' . $date; ?></h4>
                                <div class="fs20 sc5 flight"><?php echo $main_paragraph; ?></div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <?php
                            $workshop_title = $article_group['workshop_title'];
                            $workshop_paragraph = $article_group['workshop_paragraph']; ?>
                            <div class="col-md-6 mmb20 ">
                                <div class="articlebox d-flex align-items-center justify-content-center">
                                    <div class="w-100 px-md-5 p-4">
                                        <h4 class="sc5 fs30 fbold"><?php echo $workshop_title; ?></h4>
                                        <div class="fs20 sc5 flight"><?php echo $workshop_paragraph; ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $quote_t = $article_group['quote_t'];
                            $quote = $article_group['quote']; ?>
                            <div class="col-md-6 mmb20">
                                <div class="articlebox d-flex align-items-center justify-content-center  position-relative">
                                    <div class="w-100  px-md-5 p-4">
                                        <img class="quote1" src="<?php echo get_template_directory_uri() . '/images/q1.png'; ?>" alt="Q1">
                                        <h4 class="sc5 fs60 Niloofar text-center fbold"><?php echo $quote_t; ?></h4>
                                        <div class="fs20 sc5 mt-4 text-center "><?php echo $quote; ?></div>
                                        <img class="quote2" src="<?php echo get_template_directory_uri() . '/images/q2.png'; ?>" alt="Q2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $members = $article_group['members'];
                        $members_t = $article_group['members_t'];
                        if ($members) { ?>
                            <div class="articlebox p-md-5 p-4 mb-4">
                                <h4 class="fs60 fbold Niloofar text-center sc5 mmb20"><?php echo $members_t; ?></h4>
                                <div>
                                    <?php foreach ($members as $member) { ?>
                                        <div class="d-flex align-items-start mb-4 mblock" style="gap:20px;">
                                            <?php if ($member['image']) { ?>
                                                <div class=" bgimg mw100 mbh300" style="width:30%;border-radius:16px;height:420px;background-image:url('<?php echo $member['image']['url']; ?>')">

                                                </div>
                                            <?php } ?>
                                            <div class="p-md-5 p-4 mw100" style="width:70%;">
                                                <h4 class="sc5 fs25 fbold" style="gap:20px;"><?php echo $member['name'] ?>
                                                    <?php if ($member['linkedin']) { ?>
                                                        <a target="_blank" class="sc5 freg und " href="<?php echo $member['linkedin']['url']; ?>">
                                                            <?php echo $member['linkedin']['title']; ?>
                                                        </a>
                                                    <?php } ?>
                                                </h4>
                                                <div class="fs20 sc5 flight"><?php echo $member['description']; ?></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php $opps = $article_group['opps'];
                        $opps_t = $article_group['opp_t'];
                        if ($opps) { ?>
                            <div class="articlebox p-md-5 p-4 mb-4">
                                <h4 class="fs60 fbold Niloofar text-center sc5 mmb20"><?php echo $opps_t; ?></h4>
                                <div class="row p-md-5  justify-content-between">
                                    <?php foreach ($opps as $opp) { ?>
                                        <div class="col-md-5 ">

                                            <h4 class="sc5 fs25 fbold"><?php echo $opp['title'] ?>

                                            </h4>
                                            <div class="fs20 sc5 mb-4 flight"><?php echo $opp['description']; ?></div>
                                            <?php if ($opp['link']) { ?>
                                                <a target="_blank" class="sc5 fbold und " href="<?php echo $opp['link']['url']; ?>">
                                                    <?php echo $opp['link']['title']; ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php $arts = $article_group['articles2'];
                        $arts_t = $article_group['articles_t'];
                        if ($arts) { ?>
                            <div class="articlebox  p-md-5 p-4 ">
                                <h4 class="fs60 fbold Niloofar text-center sc5 mmb20"><?php echo $arts_t; ?></h4>
                                <div class="row p-md-5 justify-content-between">
                                    <?php foreach ($arts as $art) { ?>
                                        <div class="col-md-6 mmb20">
                                            <?php $img = $art['image'];
                                            if ($img) { ?>
                                                <div class="bgimg mbh300" style="border-radius:16px;height:390px;background-image:url('<?php echo $img['url']; ?>')"></div>
                                            <?php } ?>
                                            <div class="py-3">
                                                <h4 class="fs25 sc5 fbold"><?php echo $art['title']; ?></h4>
                                                <div class="fs20 sc5 mb-4 flight"><?php echo $art['description']; ?></div>
                                                <?php if ($art['link']) { ?>
                                                    <a target="_blank" class="sc5 fbold und " href="<?php echo $art['link']['url']; ?>">
                                                        <?php echo $art['link']['title']; ?>
                                                    </a>
                                                <?php } ?>
                                                <?php $author = $art['author'];
                                                if ($author) { ?>
                                                    <div class="d-flex align-items-center mt-4" style="gap:10px;">
                                                        <?php $empimg = get_the_post_thumbnail_url($author->ID);
                                                        if ($empimg) { ?>
                                                            <div class="bgimg" style="height:95px;width:95px;border-radius:50%;background-image:url('<?php echo $empimg; ?>"></div>
                                                        <?php } ?>
                                                        <div>
                                                            <h4 class="sc5 fs18 fbold"><?php echo $author->post_title; ?></h4>
                                                            <h4 class="sc5 fs18 flight"><?php echo get_field('role', $author->ID); ?></h4>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>


                        <?php $books = $article_group['books'];
                        $books_t = $article_group['books_t'];
                        if ($books) { ?>
                            <div class="articlebox p-md-5 p-4 mb-4">
                                <h4 class="fs60 fbold Niloofar text-center sc5 mmb20"><?php echo $books_t; ?></h4>
                                <div class="row p-md-5 justify-content-between">
                                    <?php foreach ($books as $book) { ?>
                                        <div class="col-md-6 mmb20">
                                            <?php $img = $book['image'];
                                            if ($img) { ?>
                                                <div class="bgimg mbh300" style="border-radius:16px;height:390px;background-image:url('<?php echo $img['url']; ?>')"></div>
                                            <?php } ?>
                                            <div class="py-3">
                                                <h4 class="fs25 sc5 fbold"><?php echo $book['title']; ?></h4>
                                                <div class="fs20 sc5 mb-4 flight"><?php echo $book['description']; ?></div>
                                                <?php if ($book['link']) { ?>
                                                    <a target="_blank" class="sc5 fbold und " href="<?php echo $book['link']['url']; ?>">
                                                        <?php echo $book['link']['title']; ?>
                                                    </a>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        <?php $i++;
        } ?>
    </div>
<?php } ?>
<?php get_footer(); ?>
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    jQuery(document).ready(function($) {
        jQuery('.postContent1').fadeIn();
        jQuery('.postLoader').on('click', function() {
            var id = jQuery(this).attr('data-content');
            jQuery('.postContent').hide();
            jQuery('.' + id).fadeIn();
        });
    });
</script>