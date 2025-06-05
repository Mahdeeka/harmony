<?php

/**
 * Template Name: Enhanced Network
 **/

// Function to convert line breaks to bullet points (same as other templates)
function format_bio_content($content) {
    if (empty($content)) return $content;
    
    // Remove any existing bullet symbols
    $content = str_replace(['*', '•', '◦', '-'], '', $content);
    
    // Split content by line breaks and clean up
    $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $content)));
    
    if (count($lines) <= 1) {
        // If only one line or no lines, return as is
        return $content;
    }
    
    // Create bullet points
    $formatted_lines = array();
    foreach ($lines as $line) {
        if (!empty($line)) {
            $formatted_lines[] = '<li>' . $line . '</li>';
        }
    }
    
    return '<ul class="bio-list">' . implode('', $formatted_lines) . '</ul>';
}

?>

<?php get_header(); ?>

<!-- Enhanced Hero Section -->
<div class="enhanced-hero-section">
    <div class="hero-background">
        <!-- Animated Background Elements with Member Photos -->
        <div class="floating-elements">
            <?php
            // Get random team members for floating circles
            $floating_members_args = array(
                'post_type' => 'team',
                'posts_per_page' => 25,
                'orderby' => 'rand',
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    )
                )
            );
            
            $floating_query = new WP_Query($floating_members_args);
            $floating_members = [];
            
            if ($floating_query->have_posts()) {
                while ($floating_query->have_posts()) {
                    $floating_query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if ($thumbnail_url) {
                        $floating_members[] = [
                            'image' => $thumbnail_url,
                            'name' => get_the_title()
                        ];
                    }
                }
            }
            wp_reset_postdata();
            
            // Circle positions - closer to center, distributed on both sides
            $circle_positions = [
                // Right side - closer to center
                ['size' => 70, 'top' => '5%', 'right' => '15%', 'delay' => '0s'],
                ['size' => 60, 'top' => '12%', 'right' => '25%', 'delay' => '-1s'],
                ['size' => 85, 'top' => '18%', 'right' => '18%', 'delay' => '-2s'],
                ['size' => 65, 'top' => '25%', 'right' => '30%', 'delay' => '-3s'],
                ['size' => 80, 'top' => '32%', 'right' => '12%', 'delay' => '-4s'],
                ['size' => 70, 'top' => '38%', 'right' => '22%', 'delay' => '-5s'],
                ['size' => 75, 'top' => '45%', 'right' => '35%', 'delay' => '-6s'],
                ['size' => 90, 'top' => '52%', 'right' => '16%', 'delay' => '-7s'],
                ['size' => 65, 'top' => '58%', 'right' => '28%', 'delay' => '-8s'],
                ['size' => 80, 'top' => '65%', 'right' => '20%', 'delay' => '-9s'],
                ['size' => 70, 'top' => '72%', 'right' => '32%', 'delay' => '-10s'],
                ['size' => 75, 'bottom' => '12%', 'right' => '14%', 'delay' => '-11s'],
                ['size' => 85, 'bottom' => '8%', 'right' => '26%', 'delay' => '-12s'],
                
                // Left side - closer to center
                ['size' => 80, 'top' => '8%', 'left' => '20%', 'delay' => '-13s'],
                ['size' => 65, 'top' => '15%', 'left' => '12%', 'delay' => '-14s'],
                ['size' => 75, 'top' => '22%', 'left' => '28%', 'delay' => '-15s'],
                ['size' => 90, 'top' => '28%', 'left' => '16%', 'delay' => '-16s'],
                ['size' => 70, 'top' => '35%', 'left' => '32%', 'delay' => '-17s'],
                ['size' => 85, 'top' => '42%', 'left' => '14%', 'delay' => '-18s'],
                ['size' => 60, 'top' => '48%', 'left' => '24%', 'delay' => '-19s'],
                ['size' => 80, 'top' => '55%', 'left' => '18%', 'delay' => '-20s'],
                ['size' => 75, 'top' => '62%', 'left' => '30%', 'delay' => '-21s'],
                ['size' => 70, 'top' => '68%', 'left' => '22%', 'delay' => '-22s'],
                ['size' => 85, 'bottom' => '15%', 'left' => '16%', 'delay' => '-23s'],
                ['size' => 65, 'bottom' => '10%', 'left' => '28%', 'delay' => '-24s']
            ];
            
            // Only show circles if we have member photos
            for ($i = 0; $i < min(25, count($floating_members)); $i++) {
                $position = $circle_positions[$i];
                $member = $floating_members[$i];
                $position_style = '';
                
                if (isset($position['top'])) $position_style .= "top: {$position['top']}; ";
                if (isset($position['bottom'])) $position_style .= "bottom: {$position['bottom']}; ";
                if (isset($position['left'])) $position_style .= "left: {$position['left']}; ";
                if (isset($position['right'])) $position_style .= "right: {$position['right']}; ";
                
                ?>
                <div class="floating-circle" 
                     style="width: <?php echo $position['size']; ?>px; 
                            height: <?php echo $position['size']; ?>px; 
                            <?php echo $position_style; ?>
                            animation-delay: <?php echo $position['delay']; ?>;"
                     data-tooltip="<?php echo esc_attr($member['name']); ?>">
                    <div class="member-photo" style="background-image: url('<?php echo esc_url($member['image']); ?>');" 
                         title="<?php echo esc_attr($member['name']); ?>"></div>
                </div>
                <?php
            }
            ?>
        </div>
        
        <div class="container">
            <div class="row align-items-center min-vh-60">
                <div class="col-12">
                    <div class="hero-content">
                        <!-- Main Title with Animation -->
                        <h1 class="hero-title">
                            <span class="title-word" data-text="<?php echo the_title(); ?>"><?php echo the_title(); ?></span>
                        </h1>
                        
                        <!-- Animated Subtitle -->
                        <div class="hero-subtitle">
                            <div class="typing-container">
                                <span class="typing-text" id="typingText"></span>
                                <span class="cursor">|</span>
                            </div>
                        </div>
                        
                        <!-- Stats Counter -->
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number" data-target="<?php echo wp_count_posts('team')->publish; ?>">0</div>
                                <div class="stat-label">عضو في الشبكة</div>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item">
                                <div class="stat-number" data-target="<?php echo wp_count_posts('team')->publish; ?>">0</div>
                                <div class="stat-label">من القادة</div>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item">
                                <div class="stat-number" data-target="50">0</div>
                                <div class="stat-label">مجال متخصص</div>
                            </div>
                        </div>
                        
                        <!-- Interactive CTA -->
                        <div class="hero-cta">
                            <button class="explore-btn" onclick="smoothScrollTo('.search-container')">
                                <span>استكشف الأعضاء</span>
                                <div class="btn-arrow">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 13L12 18L17 13M7 6L12 11L17 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$ceos = get_field('ceos');
$excludes = []; // Array to store CEO IDs

if ($ceos) { ?>
    <!-- Leadership Section -->
    <div class="leadership-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">القيادة</h2>
                <div class="section-divider"></div>
                <p class="section-description">الرؤساء والقادة الذين يقودون رؤيتنا نحو المستقبل</p>
            </div>
            
            <div class="leadership-grid">
                <?php foreach ($ceos as $index => $ceo) {
                    $excludes[] = $ceo->ID; // Store CEO IDs in $excludes
                    
                    // Get CEO data
                    $ceo_role = get_field('role', $ceo->ID) ?: get_field('field_job_title', $ceo->ID);
                    $ceo_company = get_field('company', $ceo->ID) ?: get_field('field_university', $ceo->ID);
                    $ceo_instagram = get_field('field_instagram', $ceo->ID);
                    $ceo_linkedin = get_field('field_linkedin', $ceo->ID);
                    
                    // Fallback for social media
                    if (!$ceo_instagram && !$ceo_linkedin) {
                        $socials = get_field('socials', $ceo->ID);
                        $ceo_instagram = $socials['instagram'] ?? '';
                        $ceo_linkedin = $socials['linkedin'] ?? '';
                    }
                ?>
                    <div class="leadership-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 150; ?>">
                        <?php 
                        echo get_template_part('parts/emp', null, array(
                            'emp' => $ceo,
                            'display_role' => $ceo_role,
                            'display_company' => $ceo_company,
                            'display_instagram' => $ceo_instagram,
                            'display_linkedin' => $ceo_linkedin,
                            'card_type' => 'leadership'
                        )); 
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php
// Query to get the rest of the team members excluding the CEOs
$args = array(
    'post_type'      => 'team',
    'posts_per_page' => -1,
    'post__not_in'   => $excludes, // Exclude the CEO IDs
);

$query = new WP_Query($args);

// Get all posts and calculate content length for sorting
$team_members = [];
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        
        // Calculate total content length
        $content_length = 0;
        
        // Get all content fields
        $content_fields = [
            get_field('field_edu_resume'),
            get_field('field_pro_resume'), 
            get_field('field_personal_resume'),
            get_field('harmony_experience'),
            get_field('field_message'),
            get_field('role'),
            get_field('field_job_title'),
            get_field('company'),
            get_field('field_university')
        ];
        
        // Calculate length of all content
        foreach ($content_fields as $content) {
            if ($content) {
                $content_length += strlen(strip_tags($content));
            }
        }
        
        // Add skills length
        $skills = get_field('field_selected_skills');
        if ($skills && is_array($skills)) {
            foreach ($skills as $skill) {
                $content_length += strlen(get_the_title($skill));
            }
        }
        
        // Check legacy info fields
        $legacy_info = get_field('info_new');
        if ($legacy_info && is_array($legacy_info)) {
            foreach ($legacy_info as $info_item) {
                if (isset($info_item['content'])) {
                    $content_length += strlen(strip_tags($info_item['content']));
                }
                if (isset($info_item['title'])) {
                    $content_length += strlen($info_item['title']);
                }
            }
        }
        
        // Store post with content length
        $team_members[] = [
            'post' => $post,
            'content_length' => $content_length
        ];
    }
    
    // Sort by content length (descending - most content first)
    usort($team_members, function($a, $b) {
        return $b['content_length'] - $a['content_length'];
    });
}

wp_reset_postdata();

if (!empty($team_members)) : ?>
    <!-- Team Section -->
    <div class="team-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo get_field('members_title') ?: 'أعضاء الشبكة'; ?></h2>
                <div class="section-divider"></div>
                <p class="section-description">مجتمع متنوع من الخبراء والمتخصصين في مختلف المجالات</p>
            </div>
            
            <!-- Enhanced Search Interface -->
            <div class="search-container">
                <div class="search-wrapper">
                    <div class="search-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <input type="text" id="employeeSearch" class="modern-search-input" placeholder="ابحث بالاسم، الوظيفة، الشركة...">
                    <div class="search-clear" id="searchClear" style="display: none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="search-results-count" id="resultsCount"></div>
            </div>

            <!-- Team Grid - Zoom Responsive -->
            <div class="team-grid-5" id="employeeList">
                <?php $index = 0; foreach ($team_members as $member_data) : 
                    $post = $member_data['post'];
                    setup_postdata($post);
                    
                    // Use consistent field names with fallbacks
                    $role = get_field('role') ?: get_field('field_job_title');
                    $company = get_field('company') ?: get_field('field_university');
                    $network = get_field('network');
                    
                    // Get social media with fallbacks
                    $instagram = get_field('field_instagram');
                    $linkedin = get_field('field_linkedin');
                    if (!$instagram && !$linkedin) {
                        $socials = get_field('socials');
                        $instagram = $socials['instagram'] ?? '';
                        $linkedin = $socials['linkedin'] ?? '';
                    }
                    $social_links = $instagram . ' ' . $linkedin;
                    
                    // Get comprehensive info for search
                    $info_content = '';
                    $new_fields = [
                        'field_edu_resume' => get_field('field_edu_resume'),
                        'field_pro_resume' => get_field('field_pro_resume'),
                        'field_personal_resume' => get_field('field_personal_resume'),
                        'harmony_experience' => get_field('harmony_experience'),
                        'field_message' => get_field('field_message')
                    ];
                    
                    foreach ($new_fields as $field_value) {
                        if ($field_value) {
                            $info_content .= strtolower(strip_tags($field_value)) . ' ';
                        }
                    }
                    
                    // Fallback to legacy info structure
                    if (empty(trim($info_content)) && have_rows('info')) {
                        while (have_rows('info')) {
                            the_row();
                            $info_content .= strtolower(get_sub_field('title')) . ' ';
                            $info_content .= strtolower(strip_tags(get_sub_field('content'))) . ' ';
                        }
                    }
                    
                    // Also check info_new field
                    if (empty(trim($info_content))) {
                        $info_new = get_field('info_new');
                        if ($info_new) {
                            foreach ($info_new as $row) {
                                $info_content .= strtolower($row['title'] ?? '') . ' ';
                                $info_content .= strtolower(strip_tags($row['content'] ?? '')) . ' ';
                            }
                        }
                    }
                ?>
                    <div class="team-card-5 employee-box" 
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo ($index % 15) * 50; ?>"
                         data-name="<?php echo esc_attr(strtolower(get_the_title())); ?>"
                         data-role="<?php echo esc_attr(strtolower($role)); ?>"
                         data-company="<?php echo esc_attr(strtolower($company)); ?>"
                         data-network="<?php echo esc_attr(strtolower(implode(', ', (array)$network))); ?>"
                         data-socials="<?php echo esc_attr(strtolower($social_links)); ?>"
                         data-info="<?php echo esc_attr($info_content); ?>"
                         data-content-length="<?php echo $member_data['content_length']; ?>">
                        
                        <?php 
                        // Set global variables for parts/emp to use
                        global $temp_role, $temp_company, $temp_instagram, $temp_linkedin;
                        
                        $temp_role = $role;
                        $temp_company = $company;
                        $temp_instagram = $instagram;
                        $temp_linkedin = $linkedin;
                        
                        echo get_template_part('parts/emp', null, array(
                            'emp' => $post,
                            'card_type' => 'team-5'
                        )); 
                        ?>
                    </div>
                <?php $index++; endforeach; ?>
            </div>
            
            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
                <div class="no-results-content">
                    <div class="no-results-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>لم يتم العثور على نتائج</h3>
                    <p>جرب البحث بكلمات مختلفة أو تحقق من الإملاء</p>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
wp_reset_postdata();
?>

<style>
:root {
    --primary-color: #016D47;
    --primary-light: #02a663;
    --primary-dark: #014a32;
    --secondary-color: #f8f9fa;
    --beige-color: #EFDDCE;
    --beige-light: #F7EADC;
    --accent-color: #ff6b6b;
    --text-dark: #2c3e50;
    --text-light: #6c757d;
    --white: #ffffff;
    --shadow-light: 0 2px 10px rgba(1, 109, 71, 0.1);
    --shadow-medium: 0 8px 30px rgba(1, 109, 71, 0.15);
    --shadow-heavy: 0 15px 40px rgba(1, 109, 71, 0.2);
    --border-radius: 16px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced Hero Section */
.enhanced-hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    position: relative;
    overflow: hidden;
    min-height: 40vh;
}

.hero-background {
    position: relative;
    width: 100%;
    height: 100%;
}

/* Floating Background Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.floating-circle {
    position: absolute;
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
    opacity: 0.8;
    transition: var(--transition);
}

.floating-circle.has-member {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
    cursor: pointer;
    position: relative;
}

.floating-circle::before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: -35px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: var(--transition);
    z-index: 10;
    direction: rtl;
    text-align: center;
}

.floating-circle:hover::before {
    opacity: 1;
    bottom: -30px;
}

.floating-circle.empty-circle {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.floating-circle:hover {
    transform: scale(1.1);
    opacity: 1;
}

.member-photo {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 50%;
    position: relative;
}

.member-photo::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(1, 109, 71, 0.3), rgba(2, 166, 99, 0.2));
    border-radius: 50%;
    opacity: 0;
    transition: var(--transition);
}

.floating-circle:hover .member-photo::after {
    opacity: 1;
}

/* Different animation delays and variations */
.floating-circle:nth-child(odd) {
    animation-direction: reverse;
}

.floating-circle:nth-child(3n) {
    animation-duration: 10s;
}

.floating-circle:nth-child(4n) {
    animation-duration: 6s;
}

@keyframes float {
    0%, 100% { 
        transform: translateY(0px); 
        opacity: 0.7;
    }
    50% { 
        transform: translateY(-15px); 
        opacity: 0.9;
    }
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 100px 0 40px 0;
}

/* Animated Title */
.hero-title {
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 800;
    color: var(--white);
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
}

.title-word {
    position: relative;
    display: inline-block;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    animation: titleGlow 4s ease-in-out infinite;
}

@keyframes titleGlow {
    0%, 100% { 
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        transform: scale(1);
    }
    50% { 
        text-shadow: 0 4px 30px rgba(255,255,255,0.3), 0 0 40px rgba(255,255,255,0.2);
        transform: scale(1.02);
    }
}

/* Typing Animation */
.hero-subtitle {
    margin-bottom: 2rem;
}

.typing-container {
    font-size: 1.5rem;
    color: rgba(255,255,255,0.9);
    font-weight: 300;
    letter-spacing: 0.5px;
    min-height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.typing-text {
    border-right: 2px solid rgba(255,255,255,0.8);
    padding-right: 5px;
}

.cursor {
    animation: blink 1s infinite;
    color: rgba(255,255,255,0.8);
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}

/* Stats Counter */
.hero-stats {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    color: var(--white);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    font-weight: 300;
}

.stat-divider {
    width: 1px;
    height: 40px;
    background: rgba(255, 255, 255, 0.3);
}

/* Interactive CTA */
.hero-cta {
    margin-top: 2rem;
}

.explore-btn {
    background: var(--beige-light);
    color: var(--primary-color);
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.explore-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    background: var(--beige-color);
}

.btn-arrow {
    transition: var(--transition);
}

.explore-btn:hover .btn-arrow {
    transform: translateY(3px);
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.section-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    margin: 0 auto 1rem;
    border-radius: 2px;
    position: relative;
}

.section-divider::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 12px;
    height: 12px;
    background: var(--beige-light);
    border: 3px solid var(--primary-color);
    border-radius: 50%;
}

.section-description {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Leadership Section */
.leadership-section {
    padding: 100px 0;
    background: var(--beige-color);
}

.leadership-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    justify-items: center;
}

.leadership-card {
    background: var(--beige-light);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-medium);
    overflow: hidden;
    transition: var(--transition);
    position: relative;
    max-width: 350px;
    width: 100%;
}

.leadership-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
}

.leadership-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-heavy);
}

/* Team Section */
.team-section {
    padding: 100px 0;
    background: #EFDDCE;
    min-height: 100vh;
}

/* Modern Search */
.search-container {
    margin-bottom: 4rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.search-wrapper {
    position: relative;
    background: var(--beige-light);
    border-radius: 50px;
    box-shadow: var(--shadow-medium);
    display: flex;
    align-items: center;
    padding: 0 24px;
    transition: var(--transition);
    border: 2px solid transparent;
}

.search-wrapper:focus-within {
    box-shadow: 0 8px 40px rgba(1, 109, 71, 0.15);
    transform: translateY(-2px);
    border-color: var(--primary-color);
}

.search-icon {
    color: var(--primary-color);
    margin-left: 12px;
    display: flex;
    align-items: center;
}

.modern-search-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 20px 0;
    font-size: 1.1rem;
    color: var(--text-dark);
    background: transparent;
    text-align: right;
    direction: rtl;
}

.modern-search-input::placeholder {
    color: var(--text-light);
    opacity: 0.8;
}

.search-clear {
    color: var(--text-light);
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: var(--transition);
    display: flex;
    align-items: center;
}

.search-clear:hover {
    background: rgba(1, 109, 71, 0.1);
    color: var(--primary-color);
}

.search-results-count {
    text-align: center;
    margin-top: 1rem;
    color: var(--text-light);
    font-size: 0.95rem;
    opacity: 0;
    transition: var(--transition);
}

.search-results-count.show {
    opacity: 1;
}

/* Team Grid - Zoom Responsive Layout */
.team-grid-5 {
    display: grid;
    /* Auto-fit creates responsive columns based on available space and zoom level */
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 1.2rem;
    justify-items: center;
    padding: 0 0.5rem;
}

.team-card-5 {
    background: var(--beige-light);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    overflow: hidden;
    transition: var(--transition);
    position: relative;
    width: 100%;
    /* Prevent cards from becoming too large when zoomed out */
    max-width: 240px;
    /* Prevent cards from becoming too small when zoomed in */
    min-width: 140px;
}

.team-card-5:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

.team-card-5::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    transform: scaleX(0);
    transition: var(--transition);
    transform-origin: left;
}

.team-card-5:hover::after {
    transform: scaleX(1);
}

/* Bio Lists */
.bio-list {
    margin: 0;
    padding: 0 20px 0 0;
    list-style: none;
    direction: rtl;
    text-align: right;
}

.bio-list li {
    position: relative;
    margin-bottom: 12px;
    padding-right: 20px;
    line-height: 1.6;
    color: var(--text-dark);
}

.bio-list li::before {
    content: '';
    position: absolute;
    right: 0;
    top: 12px;
    width: 6px;
    height: 6px;
    background: var(--primary-color);
    border-radius: 50%;
    transform: translateY(-50%);
}

/* No Results */
.no-results {
    text-align: center;
    padding: 4rem 0;
    color: var(--text-light);
}

.no-results-content {
    max-width: 400px;
    margin: 0 auto;
}

.no-results-icon {
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.no-results h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
}

.no-results p {
    font-size: 1rem;
    line-height: 1.6;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeInUp 0.6s ease-out forwards;
}

/* Enhanced Responsive Design for Zoom Levels */

/* Small screens and high zoom levels */
@media (max-width: 480px) {
    .team-grid-5 {
        /* For small screens, use larger minimum width for readability */
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        padding: 0 0.5rem;
        gap: 1rem;
    }
    
    .team-card-5 {
        max-width: 100%;
        min-width: 260px;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .stat-divider {
        display: none;
    }
    
    .hero-title {
        font-size: 2.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3), 0 4px 8px rgba(0,0,0,0.2);
        font-weight: 900;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .leadership-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .search-wrapper {
        margin: 0 1rem;
    }
    
    .team-section,
    .leadership-section {
        padding: 60px 0;
    }
    
    .hero-content {
        padding: 80px 0 30px 0;
    }
    
    .typing-container {
        font-size: 1.2rem;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        font-weight: 500;
    }
    
    .stat-number {
        font-size: 2rem;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        font-weight: 800;
    }
    
    .stat-label {
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        font-weight: 500;
    }
    
    /* Show only 8 floating circles on mobile - moved to far sides */
    .floating-circle {
        display: none;
    }
    
    /* Show first 4 right side circles (1-4) - moved to far right */
    .floating-circle:nth-child(1) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 25% !important;
        right: 2% !important;
    }
    
    .floating-circle:nth-child(2) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 15% !important;
        right: 5% !important;
    }
    
    .floating-circle:nth-child(3) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 35% !important;
        right: 1% !important;
    }
    
    .floating-circle:nth-child(4) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 10% !important;
        right: 4% !important;
    }
    
    /* Show first 4 left side circles (14-17) - moved to far left */
    .floating-circle:nth-child(14) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 20% !important;
        left: 3% !important;
    }
    
    .floating-circle:nth-child(15) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 30% !important;
        left: 1% !important;
    }
    
    .floating-circle:nth-child(16) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 12% !important;
        left: 5% !important;
    }
    
    .floating-circle:nth-child(17) {
        display: block;
        opacity: 0.3;
        transform: scale(0.6);
        top: auto !important;
        bottom: 40% !important;
        left: 2% !important;
    }
    
    .floating-circle .member-photo {
        filter: blur(1px) grayscale(40%);
    }
    
    .floating-circle:hover .member-photo {
        filter: blur(0px) grayscale(0%);
        opacity: 1;
    }
}

@media (max-width: 360px) {
    .team-grid-5 {
        /* Force single column on very small screens */
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }
    
    .team-card-5 {
        max-width: 100%;
        min-width: auto;
    }
    
    /* Show only 8 floating circles on small mobile - 4 from right, 4 from left */
    .floating-circle {
        display: none;
    }
    
    /* Show first 4 right side circles (1-4) - repositioned to bottom */
    .floating-circle:nth-child(1) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 22% !important;
        right: 12% !important;
    }
    
    .floating-circle:nth-child(2) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 12% !important;
        right: 20% !important;
    }
    
    .floating-circle:nth-child(3) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 32% !important;
        right: 15% !important;
    }
    
    .floating-circle:nth-child(4) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 8% !important;
        right: 8% !important;
    }
    
    /* Show first 4 left side circles (14-17) - repositioned to bottom */
    .floating-circle:nth-child(14) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 18% !important;
        left: 16% !important;
    }
    
    .floating-circle:nth-child(15) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 28% !important;
        left: 8% !important;
    }
    
    .floating-circle:nth-child(16) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 10% !important;
        left: 22% !important;
    }
    
    .floating-circle:nth-child(17) {
        display: block;
        opacity: 0.35;
        transform: scale(0.6);
        top: auto !important;
        bottom: 38% !important;
        left: 12% !important;
    }
    
    .floating-circle .member-photo {
        filter: blur(0.5px) grayscale(25%);
    }
    
    .floating-circle:hover .member-photo {
        filter: blur(0px) grayscale(0%);
        opacity: 1;
    }
}

/* Medium screens and moderate zoom */
@media (max-width: 768px) {
    .hero-stats {
        gap: 1rem;
    }
    
    .stat-divider {
        display: none;
    }
    
    /* Hide some floating circles on tablets */
    .floating-circle:nth-child(n+16) {
        display: none;
    }
    
    .floating-circle {
        opacity: 0.6;
    }
}

@media (max-width: 992px) {
    /* Hide some floating circles on tablets */
    .floating-circle:nth-child(n+16) {
        display: none;
    }
    
    .floating-circle {
        opacity: 0.6;
    }
}

@media (min-width: 1200px) and (max-width: 1399px) {
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 1.3rem;
    }
    
    .team-card-5 {
        max-width: 250px;
        min-width: 150px;
    }
}

/* Large screens when zoomed out - allows more columns */
@media (min-width: 1400px) {
    .team-section .container {
        max-width: 1400px;
    }
    
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.2rem;
    }
    
    .team-card-5 {
        max-width: 220px;
        min-width: 130px;
    }
}

@media (min-width: 1600px) {
    .team-section .container {
        max-width: 1600px;
    }
    
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1.1rem;
    }
    
    .team-card-5 {
        max-width: 200px;
        min-width: 120px;
    }
}

@media (min-width: 1920px) {
    .team-section .container {
        max-width: 1920px;
    }
    
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
    }
    
    .team-card-5 {
        max-width: 180px;
        min-width: 110px;
    }
}

@media (min-width: 2400px) {
    .team-section .container {
        max-width: 2400px;
    }
    
    .team-grid-5 {
        /* Allow even smaller minimum width for very large screens */
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 0.8rem;
    }
    
    .team-card-5 {
        max-width: 160px;
        min-width: 100px;
    }
}

@media (min-width: 3000px) {
    .team-section .container {
        max-width: none; /* Remove container limit for ultra-wide screens */
        padding: 0 2rem;
    }
    
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
        gap: 0.7rem;
        padding: 0;
    }
    
    .team-card-5 {
        max-width: 150px;
        min-width: 90px;
    }
}

@media (min-width: 4000px) {
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 0.6rem;
    }
    
    .team-card-5 {
        max-width: 140px;
        min-width: 80px;
    }
}

/* Print Styles */
@media print {
    .search-container,
    .floating-elements,
    .hero-cta {
        display: none;
    }
    
    .team-card-5,
    .leadership-card {
        box-shadow: none;
        border: 1px solid #ddd;
        break-inside: avoid;
    }
    
    .team-grid-5 {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 8px;
    }
}
</style>

<?php get_footer(); ?>

<script>
jQuery(document).ready(function($) {
    const $searchInput = $("#employeeSearch");
    const $employeeBoxes = $(".employee-box");
    const $resultsCount = $("#resultsCount");
    const $noResults = $("#noResults");
    const $searchClear = $("#searchClear");
    
    let searchTimeout;
    
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    }
    
    // Log content length statistics for debugging
    const contentLengths = [];
    $employeeBoxes.each(function() {
        const length = parseInt($(this).data('content-length')) || 0;
        if (length > 0) {
            contentLengths.push({
                name: $(this).data('name'),
                length: length
            });
        }
    });
    
    if (contentLengths.length > 0) {
        console.log('📊 Content Statistics:');
        console.log('Most content:', contentLengths[0]?.name, '(' + contentLengths[0]?.length + ' chars)');
        console.log('Least content:', contentLengths[contentLengths.length - 1]?.name, '(' + contentLengths[contentLengths.length - 1]?.length + ' chars)');
        console.log('Average content length:', Math.round(contentLengths.reduce((sum, item) => sum + item.length, 0) / contentLengths.length));
    }
    
    // Typing animation
    const typingTexts = [
        "شبكة من المواهب المتميزة",
        "خبراء في مختلف المجالات", 
        "قادة يصنعون الفرق",
        "مجتمع من المبدعين"
    ];
    
    let currentTextIndex = 0;
    let currentCharIndex = 0;
    let isDeleting = false;
    
    function typeWriter() {
        const currentText = typingTexts[currentTextIndex];
        const $typingText = $("#typingText");
        
        if (isDeleting) {
            $typingText.text(currentText.substring(0, currentCharIndex - 1));
            currentCharIndex--;
        } else {
            $typingText.text(currentText.substring(0, currentCharIndex + 1));
            currentCharIndex++;
        }
        
        let typeSpeed = isDeleting ? 50 : 100;
        
        if (!isDeleting && currentCharIndex === currentText.length) {
            typeSpeed = 2000; // Pause at end
            isDeleting = true;
        } else if (isDeleting && currentCharIndex === 0) {
            isDeleting = false;
            currentTextIndex = (currentTextIndex + 1) % typingTexts.length;
            typeSpeed = 500; // Pause before next text
        }
        
        setTimeout(typeWriter, typeSpeed);
    }
    
    // Start typing animation
    typeWriter();
    
    // Counter animation
    function animateCounter($element, target) {
        const start = 0;
        const duration = 2000;
        const startTime = performance.now();
        
        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const current = Math.floor(progress * target);
            
            $element.text(current);
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                $element.text(target);
            }
        }
        
        requestAnimationFrame(updateCounter);
    }
    
    // Trigger counter animation when hero is visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                $('.stat-number').each(function() {
                    const target = parseInt($(this).data('target'));
                    animateCounter($(this), target);
                });
                observer.unobserve(entry.target);
            }
        });
    });
    
    observer.observe(document.querySelector('.hero-stats'));
    
    // Smooth scroll function
    window.smoothScrollTo = function(target) {
        $('html, body').animate({
            scrollTop: $(target).offset().top - 100
        }, 800);
    };
    
    // Search functionality with debouncing
    $searchInput.on("input", function() {
        clearTimeout(searchTimeout);
        const value = $(this).val().toLowerCase().trim();
        
        // Show/hide clear button
        if (value) {
            $searchClear.show();
        } else {
            $searchClear.hide();
        }
        
        searchTimeout = setTimeout(function() {
            performSearch(value);
        }, 300);
    });
    
    // Clear search
    $searchClear.on("click", function() {
        $searchInput.val("").focus();
        $(this).hide();
        performSearch("");
    });
    
    // Perform search with improved logic
    function performSearch(searchValue) {
        let visibleCount = 0;
        
        if (!searchValue) {
            // Show all employees (maintain original order by content length)
            $employeeBoxes.each(function() {
                $(this).show().addClass('fade-in');
                visibleCount++;
            });
            $resultsCount.removeClass('show');
            $noResults.hide();
        } else {
            // Filter employees
            $employeeBoxes.each(function() {
                const $box = $(this);
                const searchableContent = [
                    $box.data("name") || "",
                    $box.data("role") || "",
                    $box.data("company") || "",
                    $box.data("network") || "",
                    $box.data("socials") || "",
                    $box.data("info") || ""
                ].join(" ").toLowerCase();
                
                if (searchableContent.includes(searchValue)) {
                    $box.show().addClass('fade-in');
                    visibleCount++;
                } else {
                    $box.hide().removeClass('fade-in');
                }
            });
            
            // Update results count
            if (visibleCount > 0) {
                $resultsCount.text(`تم العثور على ${visibleCount} عضو`).addClass('show');
                $noResults.hide();
            } else {
                $resultsCount.removeClass('show');
                $noResults.show();
            }
        }
        
        // Stagger animation for visible cards
        setTimeout(function() {
            $(".employee-box:visible").each(function(index) {
                $(this).css('animation-delay', (index * 50) + 'ms');
            });
        }, 50);
    }
    
    // Enhanced keyboard navigation
    $searchInput.on("keydown", function(e) {
        if (e.key === 'Escape') {
            $(this).blur();
        }
    });
    
    // Loading animation for cards
    $employeeBoxes.each(function(index) {
        $(this).css('animation-delay', (index * 50) + 'ms');
    });
});
</script>