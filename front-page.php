<?php get_header(); ?>

<div id="FrontPage" >
    <?php $main_slider = get_field('main_slider');
    if ($main_slider) { ?>
        <div class="mainslider">
            <?php foreach ($main_slider as $slide) { ?>
                <div class="bgimg" style="background-position:center top;background-image:url('<?php echo $slide['background']; ?>')">
                    <div class="d-flex  align-items-end justify-content-center mbh500" style="height:100vh;background-color:rgba(0,0,0,0.48)">
                        <div class="container c16 pb-5">
                            <div class="row align-items-center justify-content-between pb-5">
                                <div class="col-md-6">
                                    <h4 class="Niloofar sc1 mhfs30 wow fadeInRight " style="font-size:100px;"><?php echo $slide['title']; ?></h4>
                                </div>
                                <div class="col-md-5">
                                    <div class="fs25 sc1">
                                        <?php echo $slide['paragraph']; ?>
                                    </div>
                                    <div class="d-flex mt-4" style="gap:15px">
                                        <?php $link1 = $slide['link_1'];
                                        if ($link1) { ?>
                                            <a href="<?php echo $link1['url']; ?>" class="d-block wow fadeInUp fbold fs25 link1">
                                                <?php echo $link1['title']; ?>
                                            </a>
                                        <?php } ?>
                                        <?php $link2 = $slide['link_2'];
                                        if ($link2) { ?>
                                            <a data-wow-delay="0.2s" href="<?php echo $link2['url']; ?>" class="d-block wow fadeInUp  fbold fs25 link2">
                                                <?php echo $link2['title']; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php $finds = get_field('finds');
    if ($finds) { ?>
        <div class="py-5" style="background-color:#016D47">
            <div class="container c16">
                <h4 class="sectiontitle sc1 text-center Niloofar"><?php echo get_field('find_t'); ?></h4>
                <div class="d-md-block d-none">
                    <div class="harmony-wrapper  mt-5">
                        <?php $z = 0;
                        $i = 1;
                        foreach ($finds as $find) { ?>
                            <div class="harmony-item <?php if ($i == 1) echo 'left pt-5 d-flex flex-row-reverse align-items-center';
                                                        elseif ($i == 2) echo 'center d-flex align-items-center flex-column';
                                                        else echo 'right  d-flex align-items-center mt-5 pt-5'; ?>">
                                <div data-wow-delay="<?php echo $z . 's'; ?>" class="wow rotateIn icon <?php if ($i == 2) echo 'main'; ?>">
                                    <img src="<?php echo $find['icon']['url']; ?>" alt="<?php echo $find['icon']['alt']; ?>">
                                </div>
                                <h4 class="fs25 fbold sc1 itemtitle"><?php echo $find['title']; ?></h4>
                            </div>

                        <?php $z += 0.2;
                            $i++;
                        } ?>
                    </div>
                </div>
                <div class="d-md-none d-block">
                    <div class="d-flex flex-column mt-5  justify-content-center">
                        <?php $z+=0;$i = 1;
                        foreach ($finds as $find) { ?>
                            <div data-wow-delay="<?php echo $z . 's'; ?>" class="harmony-item wow fadeInUp justify-content-center d-flex flex-column  mb-5">
                                <div class="text-center icon <?php if ($i == 2) echo 'main'; ?>">
                                    <img src="<?php echo $find['icon']['url']; ?>" alt="<?php echo $find['icon']['alt']; ?>">
                                </div>
                                <h4 class=" text-center mx-auto fs25 fbold sc1 itemtitle"><?php echo $find['title']; ?></h4>
                            </div>

                        <?php $z += 0.2; $i++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $numbers = get_field('numbers');
    if ($numbers) { ?>
        <div class=" sectionPadding" style="background-color:#013020">
            <div class="container c16">
                <h4 class="sectiontitle sc1 text-center Niloofar"><?php echo get_field('society_t'); ?></h4>
                <div class="mt-5 sc3 fs43 mw100 pb-5 text-center Niloofar d-flex w-75 mx-auto justify-content-center  align-items-end flex-wrap " style="gap:5px;">
                    <?php
                    $society_p = get_field('society_p');

                    if ($society_p) {
                        // Split the text by commas
                        $words = explode(',', $society_p);

                        // Get the last word separately
                        $last_word = array_pop($words);

                        // Display words with a span and class
                        $z = 0;
                        foreach ($words as $word) {
                            echo '<span  class="highlighted-word Niloofar d-block">' . trim($word) . '</span>, ';
                            $z += 0.1;
                        }

                        // Display the last word without wrapping it in a span
                        echo trim($last_word);
                    }
                    ?>
                </div>

                <div class="row pt-md-5 justify-content-md-between justify-content-center mt-md-5 mt-4">
                    <?php $z = 0;
                    foreach ($numbers as $number) { ?>
                        <div data-wow-delay="<?php echo $z . 's'; ?>" style="gap:10px" class="d-flex  wow fadeInRight align-items-center col justify-content-md-start justify-content-center col-md-2 mmb20">
                            <img src="<?php echo $number['icon']['url']; ?>" class="ricon" alt="<?php echo $number['icon']['alt']; ?>">
                            <h4 class="sc1 fs25 mb-0"><?php echo $number['title']; ?></h4>
                        </div>
                    <?php $z += 0.2;
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $reasons = get_field('reasons');
    if ($reasons) { ?>
        <div class="sectionPadding" style="background-color:#016D47">
            <div class="container c16 ">
                <div class="row align-items-start">
                    <div class="col-md-4 mb-5 pb-md-5">
                        <img class="circle wow zoomIn" src="<?php echo get_template_directory_uri() . '/images/circle.svg'; ?>" alt="Circle">
                        <h4 class="sc1 mcenter fs60 Niloofar sectiontitle2 position-relative"><?php echo get_field('reasons_t'); ?>

                        </h4>
                    </div>
                    <?php $z = 0;
                    foreach ($reasons as $reason) { ?>
                        <div class="col-md-4 mb-5 pb-md-5">
                            <img data-wow-delay="<?php echo $z . 's'; ?>" class="wow zoomIn" src="<?php echo $reason['icon']['url']; ?>" alt="<?php echo $reason['icon']['alt']; ?>">
                            <div class="mt-5    ">
                                <h4 class="sc1 fs25 fbold"><?php echo $reason['title']; ?></h4>
                                <div class="sc1 fs25"><?php echo $reason['desc']; ?></div>
                            </div>
                        </div>
                    <?php $z += 0.1;
                    } ?>
                </div>
            </div>
            <?php $vision_link = get_field('vision_link');
            if ($vision_link) { ?>
                <div class="mbh300 d-none d-md-block" style="height:200px">

                </div>
            <?php } ?>
        </div>

    <?php } ?>
    <?php $vision_link = get_field('vision_link');
    if ($vision_link) { ?>
        <div class="bgimg position-relative nobg  hauto" style="height:110vh;background-image:url('<?php echo get_field('vision_bg'); ?>')">
            <div style="position:absolute;height:100%;width:100%;background-color:rgba(0,0,0,0.48)"></div>
            <div class="container c16 p-md-5 p-4 mtop0  position-relative" style="top:-315px;border-radius:8px;background-color:#EFDDCE">
                <h4 class="fs60 Niloofar sc4 fbold"><?php echo get_field('vision_t'); ?></h4>
                <div class="row mt-4 mb-5 pb-md-5 pb-0 justify-content-between">
                    <div class="col-md-5 fs25 sc4 wow fadeInRight" style="text-align:justify;">
                        <?php echo get_field('vision_p1'); ?>
                    </div>
                    <div class="col-md-6 sc4 fs25 wow fadeInRight" data-wow-delay="0.4s" style="text-align:justify;">
                        <?php echo get_field('vision_p2'); ?>
                    </div>
                </div>
                <a class="d-block alink mx-auto" href="<?php echo $vision_link['url']; ?>">
                    <?php echo $vision_link['title']; ?>
                </a>
            </div>
        </div>
        <div class="bgimg position-relative mbh300  d-md-none d-block" style="height:110vh;background-image:url('<?php echo get_field('vision_bg'); ?>')"></div>
    <?php } ?>
    <?php
    $past_events = get_field('past_events');
    $upcoming_events = get_field('upcoming_events');
    if ($upcoming_events || $past_events) { ?>
        <div class="sectionPadding" style="background-color:#016D47;">
            <div class="container c16">
                <div class="row justify-content-between mb-5">
                    <div class="col-md-3">
                        <h4 class="sc1 fs60 Niloofar sectiontitle2 position-relative"><?php echo get_field('up_t'); ?></h4>
                    </div>
                    <div class="col-md-8">
                        <?php if ($upcoming_events) { ?>

                            <?php $z=0; foreach ($upcoming_events as $event) { ?>
                                <div class="p-3 mb-4 d-flex align-items-center mblock mmb20 wow fadeInUp" style="background: #245C48 0% 0% no-repeat padding-box;border:1px solid #EFDDCE;border-radius:8px;gap:20px;">
                                    <div class="bgimg" style="border-radius:8px;background-color:rgba(255,255,255,0.6);height:160px;min-width:160px;max-width:100%;background-image:url('<?php echo get_the_post_thumbnail_url($event->ID); ?>   ">
                                    </div>
                                    <div class="px-4 mcenter">
                                        <h4 class="fs35 sc1 Niloofar"><?php echo $event->post_title; ?></h4>
                                        <div class="sc1 fs20 mhfs13"><?php echo $event->post_content; ?></div>
                                    </div>
<!--                                     <img src="<?php echo get_template_directory_uri() . '/images/arrow.svg'; ?>" /> -->
                                </div>
                            <?php $z+=0.1;} ?>

                        <?php } else { ?>
                            <div class="p-3 mb-4 d-flex align-items-center mblock" style="background: #245C48 0% 0% no-repeat padding-box;
border:1px solid #EFDDCE;border-radius:8px;gap:20px;">
                                <div class="d-flex align-items-center justify-content-center" style="height:160px;min-width:160px;max-width:100%;">
                                    <img class="d-block imgc mx-auto" src="<?php echo get_template_directory_uri() . '/images/notfound.svg'; ?>" />
                                </div>
                                <div class="px-4 mcenter">
                                    <h4 class="fs35 sc1 Niloofar"><?php echo 'فش فعاليات قريبة'; ?></h4>
                                    <div class="sc1 fs20 mhfs13"><?php echo 'بتقدرو تشوفوا فعالياتنا السابقة تحت'; ?></div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-md-3 mmb20">
                        <h4 class="sc1 fs60 Niloofar sectiontitle2 mb-4 position-relative"><?php echo get_field('past_t'); ?></h4>
                        <?php $link = get_field('events_link');
                        if ($link) { ?>
                            <a class="d-block sc1 und fs22" href="<?php echo $link['url']; ?>">
                                <?php echo $link['title']  ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <?php if ($past_events) { ?>

                            <?php $z=0; foreach ($past_events as $event) {
                                $link=get_field('external_link',$event->ID) ? get_field('external_link',$event->ID) : '';
                                ?>
                                <a target="_blank" href="<?php echo $link; ?>" class="p-3 mb-4  wow fadeInUp d-flex align-items-center mblock" style="background: #245C48 0% 0% no-repeat padding-box;
border:1px solid #EFDDCE;border-radius:8px;gap:20px;">
                                    <div class="bgimg mmb20 mbh300" style="border-radius:8px;background-color:rgba(255,255,255,0.6);height:160px;min-width:160px;max-width:100%;background-image:url('<?php echo get_the_post_thumbnail_url($event->ID); ?>   ">
                                    </div>
                                    <div class="px-4 py-md-0 py-2 mcenter">
                                        <h4 class="fs35 sc1 Niloofar"><?php echo $event->post_title; ?></h4>
                                        <div class="sc1 mhfs13 fs20"><?php echo $event->post_content; ?></div>
                                    </div>
                                    <img class="d-block mmargin" src="<?php echo get_template_directory_uri() . '/images/arrow.svg'; ?>" />
                                </a>
                            <?php $z+=0.1; } ?>

                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
    <?php $joinus_link = get_field('joinus_link');
    if ($joinus_link) { ?>
        <div class="sectionPadding2 d-md-block d-none" style="background: linear-gradient(to bottom, #016D47 50%, #EFDDCE 50%);">
            <div class="container c16 bgimg d-flex align-items-center " style="border-radius:16px;height:525px;background-image:url('<?php echo get_field('joinus_bg'); ?>')">
                <div class="px-5">
                    <H4 class="fs60 sc1 Niloofar"><?php echo get_field('joinus_t'); ?></h4>
                    <div class="fs22 my-4 sc1"><?php echo get_field('joinus_p'); ?></div>
                    <a class="d-block alink fbold" href="<?php echo $joinus_link['url']; ?>">
                        <?php echo $joinus_link['title']; ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="sectionPadding2 d-md-none d-block" style="background: linear-gradient(to bottom, #016D47 50%, #EFDDCE 50%);">
            <div class="container c16 bgimg d-flex px-0  align-items-center hauto" style="background-position:left;border-radius:16px;background-image:url('<?php echo get_field('joinus_bg'); ?>')">
                <div class="p-4" style="height:100%;width:100%;background-color:rgba(0,0,0,0.48)">
                    <div class="">
                        <H4 class="fs60 sc1 Niloofar"><?php echo get_field('joinus_t'); ?></h4>
                        <div class="fs22 my-4 sc1"><?php echo get_field('joinus_p'); ?></div>
                        <a class="d-block alink fbold" href="<?php echo $joinus_link['url']; ?>">
                            <?php echo $joinus_link['title']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $projects = get_field('projects');
    if ($projects) { ?>
        <div class="sectionPadding2" style="background-color:#EFDDCE">
            <div class="container c16 ">
                <h4 class="sc4 fs80 Niloofar sectiontitle2 mb-4 fbold position-relative"><?php echo get_field('projects_t'); ?></h4>
                <?php $i = 1; $z=0;
                foreach ($projects as $project) { ?>
                    <div class="<?php if ($i % 2 == 0) echo 'flex-row-reverse'; ?> d-flex mblock justify-content-between align-items-center mb-5" style="overflow:hidden;border-radius:16px;background-color:#DDCBBC;">
                        <div class="w-50 px-5 p-4 mw100">
                            <img  style="<?php if($i==2) echo 'max-height:150px';?>" data-wow-delay="<?php echo $z.'s';?>" class="d-block imgc wow zoomIn" src="<?php echo get_field('project_icon', $project->ID); ?>" />
                            <div class="my-4 fs22 "><?php echo trunc($project->post_content, 20); ?></div>
                            <a class="d-block alink fbold" href="<?php echo get_the_permalink($project->ID) ?>">
                                <?php echo 'لمعلومات اكثر >' ?>
                            </a>
                        </div>
                        <div class="mw100 bgimg mbh300" style="width:40%;border-radius:16px;height:490px;background-image:url('<?php echo get_the_post_thumbnail_url($project->ID); ?>')">

                        </div>
                    </div>

                <?php $z+=0.2; $i++;
                } ?>
            </div>
        </div>
    <?php } ?>
    <?php $team = get_field('team');
    if ($team) { ?>
        <div class="sectionPadding" style="background-color:#016D47">
            <div class="teamContainer container c18 px-md-auto px-0 " style="margin-right:0;">
                <h4 class="text-white text-center fs80 Niloofar sectiontitle2 mb-4 fbold position-relative"><?php echo get_field('team_t'); ?></h4>
                <div class="sc1 text-center fs22"><?php echo get_field('team_p'); ?></div>
                <div class="teamslider pb-md-0 pb-5 my-5">
                    <?php $i = 1;
                    foreach ($team as $emp) { ?>
                        <div>
                            <?php echo get_template_part('parts/emp', null, array('emp' => $emp,'sc4'=>'true')); ?>
                        </div>
                    <?php $i++;
                    } ?>
                </div>
                <?php $link = get_field('team_link');
                if ($link) { ?>
                    <a class="d-block sc1 und mx-auto fs22" style="width:max-content" href="<?php echo $link['url']; ?>">
                        <?php echo $link['title']  ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php $faqs = get_field('faq');
    if ($faqs) { ?>
        <div class="sectionPadding" style="background-color:#EFDDCE">
            <div class="container c16">
                <div class="row justify-content-between">
                    <div class="col-md-4 mmb20">
                        <h4 class="sc4 fs80 Niloofar sectiontitle2 mb-4 fbold position-relative"><?php echo get_field('faq_t'); ?></h4>
                        <h4 class="sc4 fs25"><?php echo get_field('faq_st'); ?></h4>
                    </div>
                    <div class="col-md-7">
                        <?php foreach ($faqs as $faq) { ?>
                            <div class="pb-md-4 pb-2 mb-md-5 mb-4" style="border-bottom:1px solid #318362">
                                <h4 class="faq-question <?php if ($i == 1) echo 'active'; ?> fs30 fbold mb-4 pointer sc4 Niloofar d-flex align-items-center justify-content-between"><?php echo $faq['question']; ?>
                                    <img class="faqarrow" src="<?php echo get_template_directory_uri() . '/images/faqarrow.svg'; ?>" alt="Arrow">
                                </h4>
                                <div class="faq-answer fs20 sc4"><?php echo $faq['answer']; ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
    <?php $clink = get_field('contact_link');
    if ($clink) { ?>
        <div class="sectionPadding2" style="background-color:#EFDDCE">
            <div class="container ">
                <h4 class="text-center sc3 mb-5 fs60 Niloofar fbold"><?php echo get_field('contact_title'); ?></h4>
                <a href="<?php echo $clink['url']; ?>" class="d-block alink mx-auto fbold">
                    <?php echo $clink['title']; ?>
                </a>
            </div>
        </div>
    <?php } ?>

</div>

<?php get_footer(); ?>