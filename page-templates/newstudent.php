<?php

/**
 * Template Name: NewStudent
 **/
?>

<?php get_header(); ?>

<div class="pb-5 sectionPadding3 bg2">
    <div class="container c16 py-md-5 py-4">
        <div class="row align-items-start justify-content-between">

            <div class="col-md-5 mmb20">
                <h1 class="text-white mb-5 fs60 Niloofar fbold"><?php echo get_field('top_t'); ?></h1>
                <div class="d-flex align-items-center pb-5 mblock">
                    <div class="fs20 sc1 ">
                        <?php echo get_field('main_paragraph'); ?>
                    </div>
                    <?php $img = get_field('main_image');
                    if ($img) { ?>
                        <img class="d-block imgc mx-auto" src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                    <?php } ?>
                </div>
                <?php $note = get_field('ps_note');
                if ($note) { ?>

                    <div class="mt-5  mmb20 mw100  fs22 sc1 pl-3" style="border-right:8px solid #EFDDCE;">
                        <?php echo $note; ?>
                    </div>
                <?php } ?>
                <?php $img=get_the_post_thumbnail_url();if($img) {?>
                    <div>
                        <h4 class="text-white mb-3"><?php echo 'مثال لكيف رح تكون البطاقة الشخصية من الجهة الأخرى';?></h4>
                        <img src="<?php echo $img;?>" class="d-block imgc" alt="">
                    </div>
                <?php }?>
            </div>
            <div class="col-md-6">
                <div class=" pform2 bg1" style="padding:50px;border-radius:16px">
                    <div class="joinusform">
                        <?php echo do_shortcode('[contact-form-7 id="1581" title="New Student"]'); ?>
                    </div>
                    <div class="formsucc " style="padding:80px 0;display:none;">
                        <img class="d-block mx-auto imgc" src="<?php echo get_template_directory_uri() . '/images/succ.png'; ?>" alt="Success">
                        <h4 class="text-center fs43 Niloofar my-4 fbold sc4"><?php echo get_field('success_title'); ?></h4>
                        <div class="sc4 text-center fs25"><?php echo get_field('success_par'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    document.addEventListener('wpcf7mailsent', function(event) {
        if ('1581' == event.detail.contactFormId) { // Check if it's the specific form
            jQuery('.joinusform').slideUp(); // Hide the form
            jQuery('.formsucc').slideDown(); // Show the success message
        }
    }, false);
    document.addEventListener('DOMContentLoaded', function() {
        // Restore logic
        function restoreFormValues() {
            const form = document.querySelector('form.wpcf7-form');
            if (!form) return;

            const inputs = form.querySelectorAll('input, textarea, select');

            inputs.forEach(input => {
                if (input.type === 'file') return;

                const savedValue = localStorage.getItem(input.name);
                if (savedValue !== null) {
                    if (input.type === 'checkbox' || input.type === 'radio') {
                        input.checked = savedValue === 'true';
                    } else {
                        input.value = savedValue;
                    }
                }

                input.addEventListener('input', () => {
                    if (input.type === 'file') return;
                    if (input.type === 'checkbox' || input.type === 'radio') {
                        localStorage.setItem(input.name, input.checked);
                    } else {
                        localStorage.setItem(input.name, input.value);
                    }
                });
            });
        }

        // Wait after wpcf7init (when CF7 re-renders)
        document.addEventListener('wpcf7init', function() {
            setTimeout(() => {
                restoreFormValues();
            }, 500); // You may increase to 700ms if needed
        });

        // Backup: Also run on load (some themes bypass wpcf7init)
        setTimeout(() => {
            restoreFormValues();
        }, 1000);

        // Clear saved fields on submit
        document.addEventListener('wpcf7mailsent', () => {
            const inputs = document.querySelectorAll('form.wpcf7-form input, textarea, select');
            inputs.forEach(input => {
                if (input.type !== 'file') {
                    localStorage.removeItem(input.name);
                }
            });
        });
    });
</script>