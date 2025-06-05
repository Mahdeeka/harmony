<!DOCTYPE HTML>
<html <?php language_attributes(); ?> dir="rtl">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png'; ?>" type="image/png" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick-theme.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/wow.min.js"></script>


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div style="overflow:hidden">
		<header>

			<div style="background:linear-gradient(0deg, rgba(243, 229, 217, 0.03) 0%, rgba(243, 229, 217, 0.03) 100%), #1E7154">
				<div class="container c16 py-2">
					<div class="row align-items-center">
						<div class="col-md-8 d-flex align-items-center mfcc" style="gap:40px;">
							<?php $logo = get_field('logo', 'options');
							if ($logo) { ?>
								<a class="d-block"style="height:45px" href="<?php echo get_option('home'); ?>">
									<img alt="<?php echo $logo['alt']; ?>" class="d-block mmargin imgc" src="<?php echo $logo['url']; ?>" />
								</a>
							<?php } ?>

							<nav id="HeaderNav">
								<?php $logo = get_field('logo', 'options');
								if ($logo) { ?>
									<a class="d-block d-md-none my-4"style="height:50px;" href="<?php echo get_option('home'); ?>">
										<img alt="<?php echo $logo['alt']; ?>" class="d-block mx-auto imgc" src="<?php echo $logo['url']; ?>" />
									</a>
								<?php } ?>
								<div id="navBTN"><span></span><span></span><span></span></div>
								<div class="d-md-block d-none">
									<?php wp_nav_menu(array('theme_location' => 'header-menu', 'depth' => '2', 'container_class' => 'main_menu')); ?>
								</div>
								<div class="d-md-none d-block">
									<?php wp_nav_menu(array('theme_location' => 'mobile-menu', 'depth' => '2', 'container_class' => 'main_menu')); ?>
								</div>
								<?php $socials = get_field('social_media', 'options');
								if ($socials) { ?>
									<div class="d-flex d-md-none headerSocials align-items-center justify-content-center mt-4" style="gap:15px;">
										<?php foreach ($socials as $social) { ?>
											<a href="<?php echo $social['link']; ?>" target="_blank">
												<img style="max-width:32px;" src="<?php echo $social['icon']['url']; ?>" class="d-block mx-auto imgc" />
											</a>
										<?php } ?>
									</div>
								<?php } ?>
							</nav>
						</div>
						<div class="col-md-4 d-md-block d-none">
							<nav id="HeaderNav2">
								<?php wp_nav_menu(array('theme_location' => 'header-menu2', 'depth' => '2', 'container_class' => 'main_menu')); ?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>