
<?php get_header();?>

<div id="ThePage">
	<div class="container">
		<h1><?php the_title(); ?></h1>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		 <?php the_title(); ?>
		 <?php the_content(); ?>
		 <?php echo get_the_date(); ?>

		<?php endwhile; ?>
		<?php endif; ?>

	</div>
</div>

<?php get_footer();?>
