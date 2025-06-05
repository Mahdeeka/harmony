<?php

add_theme_support('menus');
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_theme_support('custom-logo', array(
	'height'      => 256,
	'width'       => 256,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array('site-title', 'site-description'),
));

function load_css()
{
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/rtl/bootstrap.min.css');
	wp_enqueue_style('bootstrap');

	wp_register_style('style', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'));
	wp_enqueue_style('style');

	wp_register_style('alaaStyle', get_template_directory_uri() . '/alaaStyle.css', array(), filemtime(get_template_directory() . '/alaaStyle.css'));
	wp_enqueue_style('alaaStyle');
}
add_action('wp_enqueue_scripts', 'load_css');

function load_js()
{
	wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', '', 4, true);
	wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js');

function add_fonts()
{
	wp_register_style('font', get_template_directory_uri() . '/css/fonts/open-sans/OpenSansHebrew-Regular.ttf');
	wp_enqueue_style('font');
}
add_action('wp_enqueue_scripts', 'add_fonts');

function register_menu()
{
	register_nav_menu('header-menu', __('Header Menu'));
	register_nav_menu('header-menu2', __('Secondary Header Menu'));
	register_nav_menu('footer-menu', __('Footer Menu'));
	register_nav_menu('legal-menu', __('Legal Menu'));
	register_nav_menu('mobile-menu', __('Mobile Menu'));
}
add_action('init', 'register_menu');



if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Website Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Home Settings',
		'menu_title'	=> 'Home',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Settings',
		'parent_slug'	=> 'theme-general-settings',
	));
}

function get_dir($dir = 'nodir')
{
	if ($dir == 'nodir') {
		$tdir = get_template_directory_uri() . '/';
	} else {
		$tdir = get_template_directory_uri() . '/' . $dir;
	}
	return $tdir;
}
function get_img($file = '', $class = '', $alt = '')
{
	$img = get_dir('images/' . $file);
	$img = '<img src="' . $img . '" class="' . $class . '" alt="' . $alt . '"/>';
	return $img;
}
function trunc($phrase, $max_words)
{
	$phrase = strip_shortcodes($phrase);
	$phrase = strip_tags($phrase);
	$phrase_array = explode(' ', $phrase);
	if (count($phrase_array) > $max_words && $max_words > 0)
		$phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '...';
	return $phrase;
}

// Register "Projects" Custom Post Type
function create_projects_cpt()
{
	$labels = array(
		'name'          => _x('Projects', 'Post Type General Name', 'textdomain'),
		'singular_name' => _x('Project', 'Post Type Singular Name', 'textdomain'),
		'menu_name'     => __('Projects', 'textdomain'),
		'all_items'     => __('All Projects', 'textdomain'),
		'add_new_item'  => __('Add New Project', 'textdomain'),
		'edit_item'     => __('Edit Project', 'textdomain'),
		'view_item'     => __('View Project', 'textdomain'),
		'search_items'  => __('Search Projects', 'textdomain'),
	);

	$args = array(
		'label'              => __('Projects', 'textdomain'),
		'description'        => __('Projects Custom Post Type', 'textdomain'),
		'labels'             => $labels,
		'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'taxonomies'         => array(), // 🔹 Removed 'category' and 'post_tag'
		'hierarchical'       => false,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'show_in_admin_bar'  => true,
		'show_in_nav_menus'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type'    => 'post',
		'show_in_rest'       => true, // Enable for Gutenberg editor
	);

	register_post_type('projects', $args);
}
add_action('init', 'create_projects_cpt');
function create_project_taxonomy()
{
	$labels = array(
		'name'              => _x('Project Categories', 'taxonomy general name', 'textdomain'),
		'singular_name'     => _x('Project Category', 'taxonomy singular name', 'textdomain'),
		'search_items'      => __('Search Project Categories', 'textdomain'),
		'all_items'         => __('All Project Categories', 'textdomain'),
		'parent_item'       => __('Parent Project Category', 'textdomain'),
		'parent_item_colon' => __('Parent Project Category:', 'textdomain'),
		'edit_item'         => __('Edit Project Category', 'textdomain'),
		'update_item'       => __('Update Project Category', 'textdomain'),
		'add_new_item'      => __('Add New Project Category', 'textdomain'),
		'new_item_name'     => __('New Project Category Name', 'textdomain'),
		'menu_name'         => __('Project Categories', 'textdomain'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'project-category'),
		'show_in_rest'      => true, // Enable for Gutenberg editor
	);

	register_taxonomy('project-category', array('projects'), $args);
}
add_action('init', 'create_project_taxonomy');


function allow_svg_uploads($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');

// Fixes SVG display in Media Library
function fix_svg_display()
{
	echo '<style>
        td.media-icon img[src$=".svg"], img[src$=".svg"] {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'fix_svg_display');


function register_event_post_type()
{
	$labels = array(
		'name'                  => _x('Events', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('Event', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('Events', 'Admin Menu text', 'textdomain'),
		'name_admin_bar'        => _x('Event', 'Add New on Toolbar', 'textdomain'),
		'add_new'               => __('Add New', 'textdomain'),
		'add_new_item'          => __('Add New Event', 'textdomain'),
		'new_item'              => __('New Event', 'textdomain'),
		'edit_item'             => __('Edit Event', 'textdomain'),
		'view_item'             => __('View Event', 'textdomain'),
		'all_items'             => __('All Events', 'textdomain'),
		'search_items'          => __('Search Events', 'textdomain'),
		'parent_item_colon'     => __('Parent Events:', 'textdomain'),
		'not_found'             => __('No events found.', 'textdomain'),
		'not_found_in_trash'    => __('No events found in Trash.', 'textdomain'),
		'featured_image'        => _x('Event Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
		'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'archives'              => _x('Event archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
		'insert_into_item'      => _x('Insert into event', 'Overrides the “Insert into post”/“Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
		'uploaded_to_this_item' => _x('Uploaded to this event', 'Overrides the “Uploaded to this post”/“Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
		'filter_items_list'     => _x('Filter events list', 'Screen reader text for the filter links heading on the admin screen. Added in 4.4', 'textdomain'),
		'items_list_navigation' => _x('Events list navigation', 'Screen reader text for the pagination heading on the admin screen. Added in 4.4', 'textdomain'),
		'items_list'            => _x('Events list', 'Screen reader text for the items list heading on the admin screen. Added in 4.4', 'textdomain'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'events'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
		'show_in_rest'       => true, // Set to true if you want to enable the Gutenberg editor for this post type
	);

	register_post_type('event', $args);
}

add_action('init', 'register_event_post_type');



function register_team_post_type()
{
	$labels = array(
		'name'                  => _x('Team Members', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('Team Member', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('Team', 'Admin Menu text', 'textdomain'),
		'name_admin_bar'        => _x('Team Member', 'Add New on Toolbar', 'textdomain'),
		'add_new'               => __('Add New', 'textdomain'),
		'add_new_item'          => __('Add New Team Member', 'textdomain'),
		'new_item'              => __('New Team Member', 'textdomain'),
		'edit_item'             => __('Edit Team Member', 'textdomain'),
		'view_item'             => __('View Team Member', 'textdomain'),
		'all_items'             => __('All Team Members', 'textdomain'),
		'search_items'          => __('Search Team Members', 'textdomain'),
		'parent_item_colon'     => __('Parent Team Members:', 'textdomain'),
		'not_found'             => __('No team members found.', 'textdomain'),
		'not_found_in_trash'    => __('No team members found in Trash.', 'textdomain'),
		'featured_image'        => _x('Team Member Photo', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
		'set_featured_image'    => _x('Set team member photo', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'remove_featured_image' => _x('Remove team member photo', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'use_featured_image'    => _x('Use as team member photo', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'archives'              => _x('Team Member Archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
		'insert_into_item'      => _x('Insert into team member', 'Overrides the “Insert into post”/“Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
		'uploaded_to_this_item' => _x('Uploaded to this team member', 'Overrides the “Uploaded to this post”/“Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
		'filter_items_list'     => _x('Filter team members list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/“Filter pages list”. Added in 4.4', 'textdomain'),
		'items_list_navigation' => _x('Team Members list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/“Pages list navigation”. Added in 4.4', 'textdomain'),
		'items_list'            => _x('Team Members list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/“Pages list”. Added in 4.4', 'textdomain'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'team'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
		'show_in_rest'       => true, // This enables the Gutenberg editor for this post type.
	);

	register_post_type('team', $args);
}

add_action('init', 'register_team_post_type');


function register_students_post_type()
{
	$labels = array(
		'name'                  => _x('Students', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('Student', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('Students', 'Admin Menu text', 'textdomain'),
		'name_admin_bar'        => _x('Student', 'Add New on Toolbar', 'textdomain'),
		'add_new'               => __('Add New', 'textdomain'),
		'add_new_item'          => __('Add New Student', 'textdomain'),
		'new_item'              => __('New Student', 'textdomain'),
		'edit_item'             => __('Edit Student', 'textdomain'),
		'view_item'             => __('View Student', 'textdomain'),
		'all_items'             => __('All Students', 'textdomain'),
		'search_items'          => __('Search Students', 'textdomain'),
		'parent_item_colon'     => __('Parent Students:', 'textdomain'),
		'not_found'             => __('No students found.', 'textdomain'),
		'not_found_in_trash'    => __('No students found in Trash.', 'textdomain'),
		'featured_image'        => _x('Student Photo', 'Overrides the “Featured Image” phrase for this post type.', 'textdomain'),
		'set_featured_image'    => _x('Set student photo', 'Overrides the “Set featured image” phrase.', 'textdomain'),
		'remove_featured_image' => _x('Remove student photo', 'Overrides the “Remove featured image” phrase.', 'textdomain'),
		'use_featured_image'    => _x('Use as student photo', 'Overrides the “Use as featured image” phrase.', 'textdomain'),
		'archives'              => _x('Student Archives', 'The post type archive label used in nav menus.', 'textdomain'),
		'insert_into_item'      => _x('Insert into student', 'Used when inserting media.', 'textdomain'),
		'uploaded_to_this_item' => _x('Uploaded to this student', 'Used when viewing media attached to a post.', 'textdomain'),
		'filter_items_list'     => _x('Filter students list', 'Screen reader text for the filter links heading.', 'textdomain'),
		'items_list_navigation' => _x('Students list navigation', 'Screen reader text for the pagination heading.', 'textdomain'),
		'items_list'            => _x('Students list', 'Screen reader text for the items list heading.', 'textdomain'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'students'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
		'show_in_rest'       => true,
	);

	register_post_type('students', $args);
}

add_action('init', 'register_students_post_type');



function register_finjan_post_type()
{
	$labels = array(
		'name'                  => _x('Finjans', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('Finjan', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('فنجان', 'text_domain'),
		'name_admin_bar'        => __('Finjan', 'text_domain'),
		'archives'              => __('Finjan Archives', 'text_domain'),
		'attributes'            => __('Finjan Attributes', 'text_domain'),
		'parent_item_colon'     => __('Parent Finjan:', 'text_domain'),
		'all_items'             => __('All Finjans', 'text_domain'),
		'add_new_item'          => __('Add New Finjan', 'text_domain'),
		'add_new'               => __('Add New', 'text_domain'),
		'new_item'              => __('New Finjan', 'text_domain'),
		'edit_item'             => __('Edit Finjan', 'text_domain'),
		'update_item'           => __('Update Finjan', 'text_domain'),
		'view_item'             => __('View Finjan', 'text_domain'),
		'view_items'            => __('View Finjans', 'text_domain'),
		'search_items'          => __('Search Finjan', 'text_domain'),
		'not_found'             => __('Not found', 'text_domain'),
		'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
		'featured_image'        => __('Featured Image', 'text_domain'),
		'set_featured_image'    => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image'    => __('Use as featured image', 'text_domain'),
		'insert_into_item'      => __('Insert into Finjan', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this Finjan', 'text_domain'),
		'items_list'            => __('Finjans list', 'text_domain'),
		'items_list_navigation' => __('Finjans list navigation', 'text_domain'),
		'filter_items_list'     => __('Filter Finjans list', 'text_domain'),
	);
	$args = array(
		'label'                 => __('Finjan', 'text_domain'),
		'description'           => __('Post Type Description', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-customizer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true, // Enables Gutenberg editor
	);
	register_post_type('finjan', $args);
}
add_action('init', 'register_finjan_post_type', 0);


add_filter('wpcf7_autop_or_not', '__return_false');

add_action('wpcf7_before_send_mail', 'create_team_member_post', 10, 3);
function create_team_member_post($contact_form, &$abort, $submission)
{
	$form_id = 1158;
	if ($contact_form->id() != $form_id) {
		return $contact_form;
	}

	try {
		$data = $submission->get_posted_data();
		$uploaded_files = $submission->uploaded_files();

		if (!function_exists('media_handle_sideload')) {
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
		}

		$full_name = sanitize_text_field($data['full_name']);
		$role = sanitize_text_field($data['role']);
		$company = sanitize_text_field($data['company']);
		$phone = sanitize_text_field($data['phone_number']);
		$joined_harmony = sanitize_text_field($data['joined_harmony']);
		$cups_in_harmony = sanitize_text_field($data['cups_in_harmony']);
		$harmony_experience = sanitize_text_field($data['harmony_experience']);
		$network = isset($data['network']) ? implode(', ', $data['network']) : '';
		$email = sanitize_email($data['email']);
		$linkedin = sanitize_text_field($data['linkedin']);
		$instagram = sanitize_text_field($data['instagram']);
		$profile_picture = $uploaded_files['profile_picture'][0];

		$academic_cv = sanitize_textarea_field($data['academic_cv']);
		$professional_cv = sanitize_textarea_field($data['professional_cv']);
		$personal_bio = sanitize_textarea_field($data['personal_bio']);
		$skills = sanitize_textarea_field($data['skills']);

		$post_id = wp_insert_post([
			'post_title'   => $full_name,
			'post_status'  => 'pending',
			'post_type'    => 'team',
		]);


		if (is_wp_error($post_id) || !$post_id) {
			error_log('Error creating post: ' . $post_id->get_error_message());
			return $contact_form;
		}

		update_field('role', $role, $post_id);
		update_field('company', $company, $post_id);
		update_field('email', $email, $post_id);
		update_field('phone', $phone, $post_id);
		update_field('harmony_experience', $harmony_experience, $post_id);
		update_field('joined_harmony', $joined_harmony, $post_id);
		update_field('cups_in_harmony', $cups_in_harmony, $post_id);
		update_field('network', explode(', ', $network), $post_id);

		update_field('socials', [
			'instagram' => $instagram,
			'linkedin'  => $linkedin,
		], $post_id);

		$repeater_data = [
			[
				'title'   => 'الخلفية الاكاديمية Academic CV',
				'content' => $academic_cv,
				'icon'    => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/mortarboard-1.png')
			],
			[
				'title'   => 'السيرة المهنية Professional CV',
				'content' => $professional_cv,
				'icon'    => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/resume.png')
			],
			[
				'title'   => 'السيرة الذاتية الشخصية Personal Bio',
				'content' => $personal_bio,
				'icon'    => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/user-1.png')
			],
			[
				'title'   => 'المهارات Skills',
				'content' => $skills,
				'icon'    => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/puzzle.png')
			]
		];


		$rows = [];

		foreach ($repeater_data as $item) {
			$rows[] = [
				'icon'    => $item['icon'],
				'title'   => $item['title'],
				'content' => $item['content'],
			];
		}

		update_field('info_new', $rows, $post_id);


		if (!empty($profile_picture) && file_exists($profile_picture)) {
			$file_array = [
				'name'     => basename($profile_picture),
				'tmp_name' => $profile_picture,
			];
			$attachment_id = media_handle_sideload($file_array, $post_id);
			if (!is_wp_error($attachment_id)) {
				set_post_thumbnail($post_id, $attachment_id);
			} else {
				error_log('Profile picture error: ' . $attachment_id->get_error_message());
			}
		}

		$user_message = '
		<!DOCTYPE html>
		<html>
		<head>
			<style>
				body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; direction: rtl; text-align: right; }
				.email-container { width: 100%; max-width: 600px; margin: auto; background-color: #f9f9f9; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
				.header { background-color: #016D47; color: white; padding: 10px 20px; text-align: center; }
				.content { padding: 20px; }
				.footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
			</style>
		</head>
		<body>
			<div class="email-container">
				<div class="header">
					<h1>مرحبًا بك في مجتمع هارموني!</h1>
				</div>
				<div class="content">
					<p>عزيزي/عزيزتي <strong>' . $full_name . '</strong>,</p>
					<p>شكرًا لانضمامك إلى مجتمع هارموني!</p>
					<p>تم استلام تفاصيلك بنجاح وهي قيد المراجعة حاليًا. ستتلقى إشعارًا فور الموافقة على ملفك الشخصي.</p>
					<p>إذا كان لديك أي استفسار أو تحتاج إلى مساعدة، لا تتردد في التواصل معنا.</p>
					<p>نتطلع لرؤيتك كجزء من مجتمعنا النابض بالحياة!</p>
				</div>
				<div class="footer">
					<p>مع أطيب التحيات،<br>فريق هارموني</p>
				</div>
			</div>
		</body>
		</html>';

		$mail_success = wp_mail(
			$email,
			'تفاصيلك قيد المراجعة',
			$user_message,
			['Content-Type: text/html; charset=UTF-8']
		);

		if (!$mail_success) {
			error_log('Failed to send welcome email to: ' . $email);
		}
		// Send admin notification manually in HTML
		$admin_emails = [
			'nadine@prox.co.il',
			'Mays.ailabouni@gmail.com',
			'contact@harmony-network.org',
			'mas.wattad98@gmail.com',
			'noor.abuhjool@gmail.com',
			'Karajasallyy@gmail.com'
		];

		// Get file paths from uploaded files
		$profile_picture_path = $uploaded_files['profile_picture'][0] ?? '';
		$cv_path = $uploaded_files['CV'][0] ?? '';

		$attachments = [];
		if (!empty($profile_picture_path) && file_exists($profile_picture_path)) {
			$attachments[] = $profile_picture_path;
		}
		if (!empty($cv_path) && file_exists($cv_path)) {
			$attachments[] = $cv_path;
		}

		$admin_message = '
				<!DOCTYPE html>
				<html>
				<head>
					<style>
						body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
						.email-container { width: 100%; max-width: 600px; margin: auto; background-color: #f9f9f9; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
						.header { background-color: #016D47; color: white; padding: 10px 20px; text-align: center; }
						.content { padding: 20px; }
						.field { margin-bottom: 10px; }
						.field strong { color: #333; }
						.footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
						.link { color: #016D47; text-decoration: none; }
					</style>
				</head>
				<body>
					<div class="email-container">
						<div class="header">
							<h1>New Member</h1>
						</div>
						<div class="content">
							<div class="field"><strong>Full Name:</strong> ' . esc_html($full_name) . '</div>
							<div class="field"><strong>Phone Number:</strong> ' . esc_html($phone) . '</div>
							<div class="field"><strong>Email:</strong> ' . esc_html($email) . '</div>
							<div class="field"><strong>Role/Occupation:</strong> ' . esc_html($role) . '</div>
							<div class="field"><strong>Company/Organization:</strong> ' . esc_html($company) . '</div>

							<h3>Academic CV</h3>
							<div class="field">' . nl2br(esc_html($academic_cv)) . '</div>

							<h3>Professional CV</h3>
							<div class="field">' . nl2br(esc_html($professional_cv)) . '</div>

							<h3>Personal Bio</h3>
							<div class="field">' . nl2br(esc_html($personal_bio)) . '</div>

							<h3>Skills</h3>
							<div class="field">' . nl2br(esc_html($skills)) . '</div>

							<h3>Harmony Experience</h3>
							<div class="field"><strong>Joined Harmony:</strong> ' . esc_html($joined_harmony) . '</div>
							<div class="field"><strong>Cups in Harmony:</strong> ' . esc_html($cups_in_harmony) . '</div>
							<div class="field"><strong>Harmony Experience:</strong> ' . nl2br(esc_html($harmony_experience)) . '</div>

							<h3>Social Links</h3>
							<div class="field"><strong>LinkedIn:</strong> <a class="link" href="' . esc_url($linkedin) . '" target="_blank">' . esc_html($linkedin) . '</a></div>
							<div class="field"><strong>Instagram:</strong> <a class="link" href="https://instagram.com/' . esc_attr($instagram) . '" target="_blank">@' . esc_html($instagram) . '</a></div>

							<h3>Attachments</h3>
							<div class="field">
								' . (!empty($profile_picture_path) ? '📎 Profile Picture uploaded.' : '❌ No Profile Picture') . '<br>
								' . (!empty($cv_path) ? '📎 CV uploaded.' : '❌ No CV') . '
							</div>
						</div>
						<div class="footer">
							This is a notification that a contact form was submitted on your website (' . get_bloginfo('name') . ' - ' . get_home_url() . ').
						</div>
					</div>
				</body>
				</html>
				';

		$subject = 'Harmony - New Member';
		$headers = ['Content-Type: text/html; charset=UTF-8'];

		// wp_mail($admin_emails, $subject, $admin_message, $headers, $attachments);
	} catch (Exception $e) {
		error_log('Error in form processing: ' . $e->getMessage());
	}

	return $contact_form;
}




add_action('transition_post_status', 'send_approval_notification', 10, 3);
function send_approval_notification($new_status, $old_status, $post)
{
	if ($post->post_type == 'team' && $old_status == 'pending' && $new_status == 'publish') {
		$post_id = $post->ID;
		$email = get_field('email', $post_id);
		if (!$email) return;

		$post_url = get_permalink($post_id);
		$subject = 'تهانينا! تم اعتماد ملفك الشخصي';
		$message = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; direction: rtl; text-align: right; }
                .email-container { width: 100%; max-width: 600px; margin: auto; background-color: #f9f9f9; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
                .header { background-color: #016D47; color: white; padding: 10px 20px; text-align: center; }
                .content { padding: 20px; }
                .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
                .link { color: #016D47; text-decoration: none; }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>أهلًا وسهلًا الى شبكة هارموني! نتمنى لك تجربة رائعة</h1>
                </div>
                <div class="content">
                    <p>عزيزي/عزيزتي،</p>
                    <p>نود إعلامك بأنه تم اعتماد ملفك الشخصي في مجتمع هارموني بنجاح!</p>
                    <p>يمكنك الآن زيارة صفحتك الشخصية من خلال الرابط التالي:</p>
                    <p><a class="link" href="' . esc_url($post_url) . '" target="_blank">عرض الملف الشخصي</a></p>
                    <p>شكراً لانضمامك إلى مجتمع هارموني! نتمنى لك تجربة رائعة.</p>
                </div>
                <div class="footer">
                    <p>مع أطيب التحيات،<br>فريق هارموني</p>
                </div>
            </div>
        </body>
        </html>';


		wp_mail($email, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
	}
}

// Optional spam override if needed
add_filter('wpcf7_spam', '__return_false');



add_action('wp_mail_failed', function ($wp_error) {
	error_log('📧 wp_mail FAILED: ' . print_r($wp_error->get_error_message(), true));
	error_log('📧 wp_mail DETAILS: ' . print_r($wp_error, true));
});




add_action('wpcf7_before_send_mail', 'create_student_post', 10, 3);
function create_student_post($contact_form, &$abort, $submission)
{
	$form_id = 1581; // Student form ID
	if ($contact_form->id() != $form_id) {
		return $contact_form;
	}

	try {
		$data = $submission->get_posted_data();
		$uploaded_files = $submission->uploaded_files();

		if (!function_exists('media_handle_sideload')) {
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
		}

		$full_name         = sanitize_text_field($data['full_name']);
		$birth_date        = sanitize_text_field($data['birth_date']);
		$phone             = sanitize_text_field($data['phone_number']);
		$email             = sanitize_email($data['email']);
		$role              = sanitize_text_field($data['role']); // field for "تعريفك المهني"
		$personal_bio      = sanitize_textarea_field($data['personal_bio']);
		$networking_pref   = sanitize_textarea_field($data['networking_preference']);
		$skills_info = sanitize_textarea_field($data['skills_info']);
		$gender = isset($data['gender']) ? sanitize_text_field($data['gender'][0]) : '';

		$linkedin          = sanitize_text_field($data['linkedin']);
		$instagram         = sanitize_text_field($data['instagram']);
		$profile_picture   = $uploaded_files['profile_picture'][0] ?? '';

		$post_id = wp_insert_post([
			'post_title'   => $full_name,
			'post_status'  => 'pending',
			'post_type'    => 'students',
		]);

		if (is_wp_error($post_id) || !$post_id) {
			error_log('Error creating student post: ' . $post_id->get_error_message());
			return $contact_form;
		}

		// Update ACF fields (adjust ACF field names as needed)
		update_field('birth_date', $birth_date, $post_id);
		update_field('email', $email, $post_id);
		update_field('phone', $phone, $post_id);
		update_field('role', $role, $post_id);
		update_field('networking_preference', $networking_pref, $post_id);
		update_field('personal_bio', $personal_bio, $post_id);
		update_field('skills_info', $skills_info, $post_id);

		update_field('gender', $gender, $post_id);

		update_field('socials', [
			'instagram' => $instagram,
			'linkedin'  => $linkedin,
		], $post_id);

		// Repeater or grouped fields (optional)
		$repeater_data = [
			[
				'title'   => 'معلومة حلوة عنك',
				'content' => $personal_bio,
				'icon'    => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/user-1.png')
			],
			[
				'title'   => 'مهارات',
				'content' => $skills,
				'icon'    => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/puzzle.png')
			]
		];

		foreach ($repeater_data as $item) {
			add_row('field_67bf62bb14c68', [
				'field_67bf62c114c69' => $item['title'],
				'field_67bf62c714c6a' => $item['content'],
				'field_67d736b973930' => $item['icon'],
			], $post_id);
		}

		if (!empty($profile_picture) && file_exists($profile_picture)) {
			// If a custom profile picture was uploaded, use it
			$file_array = [
				'name'     => basename($profile_picture),
				'tmp_name' => $profile_picture,
			];
			$attachment_id = media_handle_sideload($file_array, $post_id);

			if (!is_wp_error($attachment_id)) {
				set_post_thumbnail($post_id, $attachment_id);
			} else {
				error_log('Student photo error: ' . $attachment_id->get_error_message());
			}
		} else {
			// Use gender-based default image if no custom photo uploaded
			$default_thumb_id = ($gender === 'صبية') ? 1751 : 1750;
			set_post_thumbnail($post_id, $default_thumb_id);
		}

		// Send welcome email to student
		$user_message = '
		<!DOCTYPE html>
		<html>
		<head><style>
		body { font-family: Arial; direction: rtl; text-align: right; }
		.email-container { max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; }
		.header { background: #016D47; color: white; padding: 10px; text-align: center; }
		</style></head>
		<body>
		<div class="email-container">
			<div class="header"><h1>مرحبًا بك في برنامج فنجان ستودنتس!</h1></div>
			<p>عزيزي/عزيزتي <strong>' . $full_name . '</strong>,</p>
			<p>تم استلام معلوماتك بنجاح، ونحن متحمّسين لمشاركتك في البرنامج.</p>
			<p>إذا عندك أي سؤال أو استفسار، تواصل معنا بأي وقت.</p>
			<p><strong>فريق هارموني</strong></p>
		</div>
		</body>
		</html>';

		wp_mail($email, 'تم استلام تسجيلك في فنجان ستودنتس', $user_message, ['Content-Type: text/html; charset=UTF-8']);
	} catch (Exception $e) {
		error_log('Student form error: ' . $e->getMessage());
	}

	return $contact_form;
}



add_action('transition_post_status', 'send_student_approval_notification', 10, 3);
function send_student_approval_notification($new_status, $old_status, $post)
{
	if ($post->post_type == 'students' && $old_status == 'pending' && $new_status == 'publish') {
		$post_id = $post->ID;
		$email = get_field('email', $post_id);
		if (!$email) return;

		// Event page link
		$event_link = 'https://harmony-network.org/projects/%d8%a7%d9%84%d9%81%d9%86%d8%ac%d8%a7%d9%86-%d8%b3%d8%aa%d9%88%d8%af%d9%8a%d9%86%d8%aa%d8%b3/';

		$subject = 'تم اعتماد مشاركتك في فنجان ستودنتس 🎉';

		$message = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; direction: rtl; text-align: right; }
                .email-container { width: 100%; max-width: 600px; margin: auto; background-color: #f9f9f9; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
                .header { background-color: #016D47; color: white; padding: 10px 20px; text-align: center; }
                .content { padding: 20px; }
                .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
                .link { color: #016D47; text-decoration: none; }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>أهلًا بك في فنجان ستودنتس!</h1>
                </div>
                <div class="content">
                    <p>عزيزي/عزيزتي،</p>
                    <p>يسعدنا إبلاغك بأنه تم اعتماد مشاركتك في برنامج <strong>فنجان ستودنتس</strong> 🎉</p>
                    <p>يمكنك الآن الاطلاع على تفاصيل اللقاء وقائمة المشاركين من خلال الرابط التالي:</p>
                    <p><a class="link" href="' . esc_url($event_link) . '" target="_blank">رؤية تفاصيل اللقاء والمشاركين</a></p>
                    <p>نتمنى لك تجربة ملهمة ومليئة بالتعارف والتواصل.</p>
                </div>
                <div class="footer">
                    <p>مع تحيات فريق هارموني</p>
                </div>
            </div>
        </body>
        </html>';

		wp_mail($email, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);

		// Append to Finjan attendees
		$finjan_post_id = 1632; // Replace with your actual Finjan post ID
		$existing_attendees = get_field('attendees', $finjan_post_id);

		if (!is_array($existing_attendees)) {
			$existing_attendees = [];
		}

		if (!in_array($post_id, $existing_attendees)) {
			$existing_attendees[] = $post_id;
			update_field('attendees', $existing_attendees, $finjan_post_id);
		}
	}
}



// add_action('init', function () {
//     // Get all posts of the relevant post type
//     $posts = get_posts([
//         'post_type' => 'team', // Change if needed
//         'numberposts' => -1,
//         'post_status' => ['publish', 'pending', 'draft'],
//     ]);

//     foreach ($posts as $post) {
//         $post_id = $post->ID;

//         // Clear existing new repeater data first
//         delete_field('info_new', $post_id);

//         // Get old repeater data
//         $old_rows = get_field('info', $post_id);

//         if (!empty($old_rows)) {
//             foreach ($old_rows as $row) {
//                 add_row('info_new', [
//                     'icon'    => $row['icon'],
//                     'title'   => $row['title'],
//                     'content' => $row['content'],
//                 ], $post_id);
//             }
//         }
//     }

//     echo '✅ Repeater field migrated and reset!';
//     exit;
// });


function register_skills_post_type()
{
	$labels = array(
		'name'                  => 'Skills',
		'singular_name'         => 'Skill',
		'menu_name'             => 'Skills',
		'name_admin_bar'        => 'Skill',
		'add_new'               => 'Add New',
		'add_new_item'          => 'Add New Skill',
		'new_item'              => 'New Skill',
		'edit_item'             => 'Edit Skill',
		'view_item'             => 'View Skill',
		'all_items'             => 'All Skills',
		'search_items'          => 'Search Skills',
		'not_found'             => 'No skills found.',
		'not_found_in_trash'    => 'No skills found in Trash.',
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-lightbulb',
		'supports'              => array('title'),
		'has_archive'           => false,
		'rewrite'               => array('slug' => 'skills'),
		'show_in_rest'          => true,
	);

	register_post_type('skill', $args);
}
add_action('init', 'register_skills_post_type');




add_action('wp_ajax_submit_team_form', 'handle_team_form_ajax');
add_action('wp_ajax_nopriv_submit_team_form', 'handle_team_form_ajax');

function handle_team_form_ajax()
{
	$post_id = wp_insert_post([
		'post_type'   => 'team',
		'post_status' => 'pending',
		'post_title'  => sanitize_text_field($_POST['full_name'] ?? 'Team Member')
	]);

	if (is_wp_error($post_id)) {
		wp_send_json_error(['message' => 'Post creation failed.']);
	}

	// ✅ Save standard ACF fields using field keys
	$acf_fields = [
		'field_full_name'         => 'full_name',
		'field_job_title'         => 'job_title',
		'field_university'        => 'university',
		'field_birth_date'        => 'birth_date',
		'field_email'             => 'email',
		'field_phone'             => 'phone',
		'field_origin_country'    => 'origin_country',
		'field_current_country'   => 'current_country',
		'field_instagram'         => 'instagram',
		'field_linkedin'          => 'linkedin',
		'field_pro_resume'        => 'pro_resume',
		'field_edu_resume'        => 'edu_resume',
		'field_personal_resume'   => 'personal_resume',
		'field_message'           => 'message',
		'field_harmony_experience' => 'experience', // true/false switch	
	];

	foreach ($acf_fields as $key => $field_name) {
		if (isset($_POST[$field_name])) {
			update_field($key, sanitize_text_field($_POST[$field_name]), $post_id);
		}
	}


	if (!empty($_POST['projects'])) {
		$project_values = array_filter(array_map('trim', explode(',', $_POST['projects'])));
		$project_rows = [];

		foreach ($project_values as $project) {
			$project_rows[] = ['project' => $project]; // 'project' = subfield name
		}

		update_field('field_projects', $project_rows, $post_id);
	}

	$skill_ids = [];

	// ✅ Match existing selected skills
	if (!empty($_POST['selected_skills'])) {
		$titles = array_filter(array_map('trim', explode(',', $_POST['selected_skills'])));
		foreach ($titles as $title) {
			$matched = get_posts([
				'post_type'        => 'skill',
				'post_status'      => 'publish',
				'title'            => $title,
				'numberposts'      => 1,
				'suppress_filters' => false
			]);

			if (!empty($matched)) {
				$skill_ids[] = $matched[0]->ID;
			} else {
				error_log("❌ Skill not found (selected): $title");
			}
		}
	}

	// ✅ Create or match new skills
	if (!empty($_POST['new_skills'])) {
		$new_titles = array_filter(array_map('trim', explode(',', $_POST['new_skills'])));
		foreach ($new_titles as $title) {
			if (!$title) continue;

			$matched = get_posts([
				'post_type'        => 'skill',
				'post_status'      => ['publish', 'pending'],
				'title'            => $title,
				'numberposts'      => 1,
				'suppress_filters' => false
			]);

			if (!empty($matched)) {
				$skill_ids[] = $matched[0]->ID;
			} else {
				$new_id = wp_insert_post([
					'post_type'   => 'skill',
					'post_status' => 'pending',
					'post_title'  => $title
				]);

				if (!is_wp_error($new_id)) {
					$skill_ids[] = $new_id;
					error_log("✅ New skill created (pending): $title");
				} else {
					error_log("❌ Failed to create skill: $title");
				}
			}
		}

		// Save raw string to text field
		update_field('field_new_skills', sanitize_text_field($_POST['new_skills']), $post_id);
	}

	// ✅ Save all collected skill IDs to ACF Post Object field
	if (!empty($skill_ids)) {
		update_field('field_selected_skills', $skill_ids, $post_id);
		error_log('✅ Updated selected_skills with IDs: ' . implode(', ', $skill_ids));
	} else {
		error_log('⚠️ No skills matched or were added.');
	}


	// ✅ Handle image upload
	if (!function_exists('media_handle_upload')) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	if (!empty($_FILES['profile_image']['tmp_name'])) {
		$attachment_id = media_handle_upload('profile_image', $post_id);
		if (!is_wp_error($attachment_id)) {
			set_post_thumbnail($post_id, $attachment_id);
		}
	}

	wp_send_json_success(['message' => 'Team member created successfully']);
}



function register_attendees_post_type()
{
	register_post_type('attendees', array(
		'labels' => array(
			'name' => 'Attendees',
			'singular_name' => 'Attendee',
			'add_new_item' => 'Add New Attendee',
			'edit_item' => 'Edit Attendee',
			'all_items' => 'All Attendees',
		),
		'public' => true,
		'menu_icon' => 'dashicons-groups',
		'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'attendees'),
		'show_in_rest' => true,
	));
}
add_action('init', 'register_attendees_post_type');


add_action('wp_ajax_submit_attendees_form', 'handle_attendees_form_ajax');
add_action('wp_ajax_nopriv_submit_attendees_form', 'handle_attendees_form_ajax');

function handle_attendees_form_ajax()
{

	// if (!isset($_POST['attendees_nonce']) || !wp_verify_nonce($_POST['attendees_nonce'], 'attendees_form_nonce')) {
	// 	wp_send_json_error(['message' => 'Security check failed']);
	// }

	// if (empty($_POST['full_name']) || !isset($_POST['email'])) {
	// 	wp_send_json_error(['message' => 'Missing required fields']);
	// }
	$post_id = wp_insert_post([
		'post_type'   => 'attendees',
		'post_status' => 'pending',
		'post_title'  => sanitize_text_field($_POST['full_name'] ?? 'Attendee')
	]);

	if (is_wp_error($post_id)) {
		wp_send_json_error(['message' => 'Post creation failed.']);
	}

	$acf_fields = [
		'field_full_name'         => 'full_name',
		'field_job_title'         => 'job_title',
		'field_university'        => 'university',
		'field_birth_date'        => 'birth_date',
		'field_email'             => 'email',
		'field_phone'             => 'phone',
		'field_origin_country'    => 'origin_country',
		'field_current_country'   => 'current_country',
		'field_instagram'         => 'instagram',
		'field_linkedin'          => 'linkedin',
		'field_pro_resume'        => 'pro_resume',
		'field_edu_resume'        => 'edu_resume',
		'field_personal_resume'   => 'personal_resume',
		'field_682c7a2cd4550'          => 'fun_fact',        // 🆕 NEW
		'field_682c7a3bd4551'      => 'connect_with',    // 🆕 NEW
	];

	foreach ($acf_fields as $key => $field_name) {
		if (isset($_POST[$field_name])) {
			update_field($key, sanitize_text_field($_POST[$field_name]), $post_id);
		}
	}

	$skill_ids = [];

	if (!empty($_POST['selected_skills'])) {
		$titles = array_filter(array_map('trim', explode(',', $_POST['selected_skills'])));
		foreach ($titles as $title) {
			$matched = get_posts([
				'post_type'        => 'skill',
				'post_status'      => 'publish',
				'title'            => $title,
				'numberposts'      => 1,
				'suppress_filters' => false
			]);
			if (!empty($matched)) {
				$skill_ids[] = $matched[0]->ID;
			}
		}
	}

	if (!empty($_POST['new_skills'])) {
		$new_titles = array_filter(array_map('trim', explode(',', $_POST['new_skills'])));
		foreach ($new_titles as $title) {
			if (!$title) continue;
			$matched = get_posts([
				'post_type'        => 'skill',
				'post_status'      => ['publish', 'pending'],
				'title'            => $title,
				'numberposts'      => 1,
				'suppress_filters' => false
			]);
			if (!empty($matched)) {
				$skill_ids[] = $matched[0]->ID;
			} else {
				$new_id = wp_insert_post([
					'post_type'   => 'skill',
					'post_status' => 'pending',
					'post_title'  => $title
				]);
				if (!is_wp_error($new_id)) {
					$skill_ids[] = $new_id;
				}
			}
		}
		update_field('field_new_skills', sanitize_text_field($_POST['new_skills']), $post_id);
	}

	if (!empty($skill_ids)) {
		update_field('field_selected_skills', $skill_ids, $post_id);
	}

	if (!function_exists('media_handle_upload')) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	if (!empty($_FILES['profile_image']['tmp_name'])) {
		$attachment_id = media_handle_upload('profile_image', $post_id);
		if (!is_wp_error($attachment_id)) {
			set_post_thumbnail($post_id, $attachment_id);
		}
	}

	wp_send_json_success(['message' => 'Attendee created successfully']);
}


add_action('publish_attendees', 'add_attendee_to_current_finjan', 10, 2);

function add_attendee_to_current_finjan($attendee_id, $post)
{
	if ($post->post_type !== 'attendees') return;

	// Get the current Finjan target from ACF Options
	$finjan_post = get_field('current_finjan_target', 'option');
	if (!$finjan_post || !is_a($finjan_post, 'WP_Post')) return;

	$finjan_id = $finjan_post->ID;

	// Get current attendees_2 list
	$existing = get_field('attendees_2', $finjan_id);
	if (!is_array($existing)) $existing = [];

	$existing_ids = wp_list_pluck($existing, 'ID');
	if (!in_array($attendee_id, $existing_ids)) {
		$existing[] = get_post($attendee_id);
		update_field('attendees_2', $existing, $finjan_id);
	}
}

add_action('restrict_manage_posts', 'attendees_export_button');
function attendees_export_button()
{
	global $typenow;
	if ($typenow == 'attendees') {
?>
		<a href="<?php echo admin_url('edit.php?post_type=attendees&export_csv=1'); ?>" class="button button-primary" style="margin-left: 10px;">
			<?php _e('Export CSV'); ?>
		</a>
<?php
	}
}


add_action('admin_init', 'export_attendees_to_csv');
function export_attendees_to_csv()
{
	if (!is_admin() || !isset($_GET['export_csv']) || $_GET['post_type'] !== 'attendees') {
		return;
	}

	if (!current_user_can('manage_options')) {
		wp_die('Not allowed');
	}

	$filename = 'attendees-export-' . date('Y-m-d') . '.csv';

	header('Content-Encoding: UTF-8');
	header('Content-Type: text/csv; charset=UTF-8');
	header("Content-Disposition: attachment; filename={$filename}");

	// Add UTF-8 BOM to fix Arabic character issues in Excel
	echo "\xEF\xBB\xBF";

	$output = fopen('php://output', 'w');

	$acf_fields = [
		'full_name' => 'الاسم الكامل',
		'job_title' => 'تعريف مهني',
		'university' => 'جامعة/شركة',
		'birth_date' => 'تاريخ الميلاد',
		'email' => 'البريد الإلكتروني',
		'phone' => 'رقم الهاتف',
		'origin_country' => 'بلد السكن الأصلي',
		'current_country' => 'بلد السكن الحالي',
		'instagram' => 'إنستغرام',
		'linkedin' => 'لينكدإن',
		'pro_resume' => 'السيرة المهنية',
		'edu_resume' => 'السيرة الأكاديمية',
		'personal_resume' => 'السيرة الشخصية',
		'fun_fact' => 'معلومة مثيرة',
		'connect_with' => 'تود التعارف مع',
		'selected_skills' => 'مهارات مختارة',
		'new_skills' => 'مهارات جديدة',
	];

	fputcsv($output, array_values($acf_fields));

	$attendees = get_posts([
		'post_type' => 'attendees',
		'posts_per_page' => -1,
		'post_status' => 'any',
	]);

	foreach ($attendees as $post) {
		$row = [];
		foreach ($acf_fields as $field_key => $label) {
			$value = get_field($field_key, $post->ID);
			if (is_array($value)) {
				$value = implode(', ', $value);
			}
			if ($field_key === 'phone') {
				$value = '="' . $value . '"';
			}
			$row[] = $value;
		}
		fputcsv($output, $row);
	}

	fclose($output);
	exit;

}

 require_once get_template_directory() . '/migrate-attendees.php';