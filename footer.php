</div>
<footer class="" style="background-color:#013020;">
	<div class="container c16 py-5">
		<div class="row justify-content-between">
			<div class="col-md-3 mmb20">
				<?php $logo = get_field('logo', 'options');
				if ($logo) { ?>
					<a class="d-block" href="<?php echo get_option('home'); ?>">
						<img alt="<?php echo $logo['alt']; ?>" class="d-block mx-auto imgc" src="<?php echo $logo['url']; ?>" />
					</a>
				<?php } ?>
				<?php $socials = get_field('social_media', 'options');
				if ($socials) { ?>
					<div class="d-flex align-items-center justify-content-center mt-4" style="gap:15px;">
						<?php foreach ($socials as $social) { ?>
							<a href="<?php echo $social['link']; ?>" target="_blank">
								<img style="max-width:32px;" src="<?php echo $social['icon']['url']; ?>" class="d-block mx-auto imgc" />
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-md-3 row mx-0 mmb20">
				<div class="col">
					<nav id="FooterNav">
						<?php wp_nav_menu(array('theme_location' => 'footer-menu', 'depth' => '1', 'container_class' => 'main_menu')); ?>
					</nav>
				</div>
				<div class="col">
					<nav id="FooterNav">
						<?php wp_nav_menu(array('theme_location' => 'legal-menu', 'depth' => '1', 'container_class' => 'main_menu')); ?>
					</nav>
				</div>
			</div>
			<div class="col-md-5">
				<h4 class="text-center fs60 Niloofar sc3"><?php echo get_field('newletter_t', 'options'); ?></h4>
				<h4 class="text-center fs22 sc1"><?php echo get_field('newletter_st', 'options'); ?></h4>
				<div class="newsletterform pb-3 mt-4" style="    border-bottom: 2px solid #efddce;">
					<?php echo do_shortcode('[contact-form-7 id="6ac2584" title="Newletter Form"]'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
		<h4 class="fs20 py-3" style="color:#83A89C;opacity:0.54">
			<?php echo get_field('rights', 'options'); ?>
		</h4>
	</div>
</footer>
<div id="employeePopup" class="employee-popup" style="display: none;">
	<div class="popup-content bg1">
		<div class="close pointer">&times;</div>
		<div class="p-4" style="background-image:linear-gradient(to bottom,#016D47 50%,#EFDDCE 50%)">
			<div class="employee-imagewrapper"><img src="" alt="Employee Image" class="employee-image"></div>
		</div>
		<Div class="p-4">
			<h3 class="employee-name text-center fbold sc4 fs43"></h3>

			<!-- Display role and company under the employee's name -->
			<h4 class="d-flex fs18 align-items-center text-center text-white">
				<?php echo get_field('role'); ?>
				<?php echo ' - '; ?>
				<?php echo get_field('company'); ?>
			</h4>

			<h4 class="employee-desc text-center sc4 fs20 w-75 mx-auto"></h4>
			<div class="employee-info d-flex justify-content-center my-4 sc4 fs18 flight" style="gap:10px;"></div>
			<div class="d-flex align-items-center justify-content-between">
				<!-- Updated link to include data-link dynamically -->
				<a class="sc4 fs25 networklink" href="<?php echo get_page_link(345); ?>" data-link="<?php echo get_the_permalink($emp->ID); ?>"></a>
				<a href="" class="d-block fbold fs25 link1" style="border:2px solid;"><?php echo 'إقرأ المزيد'; ?></a>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/slick.min.js"></script>
<script>
	jQuery(document).ready(function($) {
		wow = new WOW({
			boxClass: 'wow', // default
			animateClass: 'animated', // default
			mobile: true, // default
			live: true // default
		})
		wow.init();

		jQuery('#navBTN').on('click', function() {
			jQuery('#HeaderNav').toggleClass('active');
		});
		jQuery('.mainslider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			fade: true,
			rtl: true,
			autoplaySpeed: 3000,
			arrows: true,
			autoplay: true,
			speed: 500,

		});

		jQuery('.articlesSlider').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			dots: false,
			infinite: true,
			fade: false,
			vertical: true,

			verticalSwiping: true,
			autoplaySpeed: 3000,
			arrows: true,
			autoplay: false,
			nextArrow: jQuery('.articleNext'),
			prevArrow: jQuery('.articlePrev'),
			speed: 500,


		});
		jQuery('.teamslider').slick({
			slidesToShow: 5.5,
			slidesToScroll: 1,
			dots: false,
			infinite: true,
			fade: false,
			rtl: true,
			draggable: false,
			autoplaySpeed: 3000,
			arrows: true,
			autoplay: true,
			speed: 500,
			responsive: [{
					breakpoint: 1455,
					settings: {

						slidesToShow: 4,

					}
				},
				{
					breakpoint: 800,
					settings: {
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 1,

					}
				},

			],


		});

		jQuery('.teamslider2').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			dots: true,
			infinite: false,
			fade: false,
			rtl: true,
			autoplaySpeed: 3000,
			arrows: true,
			autoplay: true,
			speed: 500,
			responsive: [{
				breakpoint: 800,
				settings: {
					centerMode: true,
					centerPadding: '40px',
					infinite: true,
					slidesToShow: 1,
					dots: false,

				}
			}, ],

		});
		$('.faq-question').click(function() {
			var $answer = $(this).next('.faq-answer');
			$answer.slideToggle(200);
			$(this).toggleClass('active');
			$(this).attr('aria-expanded', $(this).hasClass('active'));
			$answer.attr('aria-hidden', !$answer.is(':visible'));
		});

		// Optional: Close all other FAQ items when one is opened
		$('.faq-question').click(function() {
			$('.faq-answer').not($(this).next()).slideUp(200).prev().removeClass('active');
		});


	});
	jQuery(document).ready(function($) {
		var $slider = $('.event-slider');
		var totalSlides = $slider.children('div').length;
		if (totalSlides > 4) {
			$slider.slick({
				infinite: true,
				slidesToShow: 4,
				draggable: true,
				centerMode: true,
				slidesToScroll: 1,
				rtl: true,
				focusOnSelect: true,
				initialSlide: $slider.children('div').length - 1,
				responsive: [{
					breakpoint: 800,
					settings: {
						slidesToShow: 1,
					}
				}, ],
			});

			// Function to update the 'active' class and show the correct eventContent
			function updateActiveContent() {
				$('.eventlink').removeClass('active');
				$('.event-slider .slick-current .eventlink').addClass('active');

				var activeIndex = $('.event-slider .slick-current').data('slick-index');
				$('.eventContent').removeClass('active').hide();
				$('.eventContent').eq(activeIndex).stop(true, true).fadeIn(300).addClass('active');
			}

			// Initial update on page load
			updateActiveContent();

			// Update active class and event content **only after the slide has changed**
			$slider.on('afterChange', function(event, slick, currentSlide) {
				updateActiveContent();
			});

			// Handle click on .eventlink to navigate to corresponding slide
			$('.event-slider').on('click', '.eventlink', function(e) {
				var $parentSlide = $(this).closest('.slick-slide');
				var slideIndex = $parentSlide.data('slick-index');

				if (slideIndex !== undefined) {
					$slider.slick('slickGoTo', slideIndex);
				}
			});

			// Handle click on a slide to move to the center and update content
			$slider.on('click', '.slick-slide', function(e) {
				var index = $(this).data('slick-index');
				var centerIndex = Math.floor(($slider.slick('getSlick').options.slidesToShow - 1) / 2);
				var goToIndex = index - centerIndex;

				if (goToIndex < 0) {
					goToIndex = 0;
				} else if (goToIndex + $slider.slick('getSlick').options.slidesToShow > $slider.slick('getSlick').slideCount) {
					goToIndex = $slider.slick('getSlick').slideCount - $slider.slick('getSlick').options.slidesToShow;
				}

				$slider.slick('slickGoTo', goToIndex, true);
			});
		}
	});
</script>

<div style="display:none;" id="tempid" data-temp="<?php echo get_template_directory_uri() . '/images'; ?>"></div>
<script>
	document.querySelectorAll('.employee-card').forEach(item => {
		item.addEventListener('click', function() {
			if (this.classList.contains('no-popup')) return; 
			const imageUrl = this.getAttribute('data-image');
			const name = this.getAttribute('data-name');
			const role = this.getAttribute('data-role');
			const link = this.getAttribute('data-link');
			const temp = this.getAttribute('data-template-uri');
			const network = this.getAttribute('data-network');
			const desc = this.getAttribute('data-desc');
			const socials = JSON.parse(this.getAttribute('data-socials'));

			showPopup(imageUrl, name, role, desc, socials, temp, link, network);
		});
	});

	function showPopup(imageUrl, name, role, desc, socials, temp, link, network) {
		const popup = document.getElementById('employeePopup');
		popup.querySelector('.employee-image').src = imageUrl;
		popup.querySelector('.employee-name').textContent = name;
		popup.querySelector('.employee-desc').textContent = desc ? role + ' - ' + desc : role;

		popup.querySelector('.link1').href = link;
		popup.querySelector('.networklink').textContent = network;
		// let temp = getElementById('tempid').getAttribute('data-temp')
		// console.log(temp);
		const socialsContainer = popup.querySelector('.employee-info');
		socialsContainer.innerHTML = ''; // Clear previous content

		if (socials) {
			const socialMediaIcons = {
				'instagram': '/images/instagram3.png',
				'linkedin': '/images/linkedin3.png'
			};

			Object.keys(socials).forEach(key => {
				if (socials[key] && socialMediaIcons[key]) {
					socialsContainer.innerHTML += `<a href="${socials[key]}" target="_blank"><img src="${temp}${socialMediaIcons[key]}" alt="${key}"></a>`;
				}

			});
		}

		popup.style.display = 'flex'; // Show the popup
	}

	document.getElementById('employeePopup').addEventListener('click', function(event) {
		if (event.target === this) {
			this.style.display = 'none';
		}
	});

	document.querySelector('.popup-content').addEventListener('click', function(event) {
		event.stopPropagation();
	});

	document.querySelector('.employee-popup .close').onclick = function() {
		document.getElementById('employeePopup').style.display = 'none';
	};
</script>

</body>

</html>