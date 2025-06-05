<?php 
function format_bio_content($content) {
    if (empty($content)) return '';
    
    $content = strip_tags($content);
    $content = str_replace(['*', '•', '◦', '-', '→', '←', '↑', '↓'], '', $content);
    $content = preg_replace('/\r\n|\r|\n/', "\n", $content);
    $content = preg_replace('/\n\s*\n+/', "\n", $content);
    $content = preg_replace('/\s+\n/', "\n", $content);
    $content = trim($content);
    
    $lines = array_filter(array_map('trim', explode("\n", $content)), function($line) {
        return !empty($line);
    });
    
    if (count($lines) <= 1) {
        return '<p class="bio-text">' . esc_html($content) . '</p>';
    }
    
    $formatted_lines = [];
    foreach ($lines as $line) {
        $formatted_lines[] = '<li>' . esc_html($line) . '</li>';
    }
    
    return '<ul class="bio-list">' . implode('', $formatted_lines) . '</ul>';
}

function format_instagram_url($instagram_input) {
    if (empty($instagram_input)) return '';
    
    $instagram_input = trim($instagram_input);
    
    // If it's already a full URL (starts with http or https), return as is
    if (preg_match('/^https?:\/\//', $instagram_input)) {
        return $instagram_input;
    }
    
    // If it contains instagram.com but no protocol, add https://
    if (strpos($instagram_input, 'instagram.com') !== false && strpos($instagram_input, 'http') === false) {
        return 'https://' . $instagram_input;
    }
    
    // Remove @ symbol if present
    $username = ltrim($instagram_input, '@');
    
    // Remove any leading/trailing slashes and spaces
    $username = trim($username, '/ ');
    
    // Remove any instagram.com prefix if someone entered it
    $username = preg_replace('/^(www\.)?instagram\.com\//', '', $username);
    $username = trim($username, '/');
    
    // If it looks like a username, build the full URL
    if (!empty($username) && preg_match('/^[a-zA-Z0-9._]+$/', $username)) {
        return 'https://www.instagram.com/' . $username . '/';
    }
    
    // If nothing else works, assume it's a username and force the URL
    if (!empty($username)) {
        return 'https://www.instagram.com/' . $username . '/';
    }
    
    return '';
}

function format_linkedin_url($linkedin_input) {
    if (empty($linkedin_input)) return '';
    
    $linkedin_input = trim($linkedin_input);
    
    // If it's already a full URL (starts with http or https), return as is
    if (preg_match('/^https?:\/\//', $linkedin_input)) {
        return $linkedin_input;
    }
    
    // If it contains linkedin.com but no protocol, add https://
    if (strpos($linkedin_input, 'linkedin.com') !== false && strpos($linkedin_input, 'http') === false) {
        return 'https://' . $linkedin_input;
    }
    
    // If it starts with /in/ or similar LinkedIn path, make it a full URL
    if (preg_match('/^\/?(in\/|pub\/|company\/)/', $linkedin_input)) {
        return 'https://www.linkedin.com/' . ltrim($linkedin_input, '/');
    }
    
    // Remove any linkedin.com prefix if someone entered it
    $name = preg_replace('/^(www\.)?linkedin\.com\//', '', $linkedin_input);
    $name = trim($name, '/');
    
    // If it looks like a person's name (contains spaces or common name patterns), create search URL
    if (!empty($name) && (strpos($name, ' ') !== false || strlen($name) > 15 || !preg_match('/^[a-zA-Z0-9._-]+$/', $name))) {
        // Encode the name for URL
        $encoded_name = urlencode($name);
        return 'https://www.linkedin.com/search/results/all/?keywords=' . $encoded_name . '&origin=GLOBAL_SEARCH_HEADER';
    }
    
    // If it looks like a username/handle, create direct profile URL
    if (!empty($name) && preg_match('/^[a-zA-Z0-9._-]+$/', $name)) {
        return 'https://www.linkedin.com/in/' . $name . '/';
    }
    
    // If nothing else works, assume it's a name and create search URL
    if (!empty($name)) {
        $encoded_name = urlencode($name);
        return 'https://www.linkedin.com/search/results/all/?keywords=' . $encoded_name . '&origin=GLOBAL_SEARCH_HEADER';
    }
    
    return '';
}

get_header(); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary: #016D47;
    --primary-light: #02a66a;
    --primary-dark: #014532;
    --accent: #EFDDCE;
    --accent-light: #f7ebe0;
    --white: #ffffff;
    --dark: #1a1a1a;
    --gray: #5a5a5a;
    --light-gray: #f8f9fa;
    --border: #e9ecef;
    --volunteer-gold: #ffd700;
    --volunteer-amber: #ffb700;
}

body {
    font-family: 'Inter', 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.6;
    color: var(--dark);
    background: var(--white);
    overflow-x: hidden;
}

/* Main Container */
.profile-container {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 50%, var(--primary) 100%);
    position: relative;
    padding: 1rem;
    padding-top: 3.5rem;
}

/* Volunteer Special Styling */
.profile-container.volunteer {
    background: linear-gradient(135deg, var(--volunteer-amber) 0%, var(--volunteer-gold) 30%, var(--primary) 60%, var(--primary-dark) 100%);
    animation: volunteerGlow 3s ease-in-out infinite alternate;
}

@keyframes volunteerGlow {
    0% { 
        box-shadow: inset 0 0 20px rgba(255, 215, 0, 0.3);
    }
    100% { 
        box-shadow: inset 0 0 40px rgba(255, 215, 0, 0.6);
    }
}

.volunteer-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(45deg, var(--volunteer-gold), var(--volunteer-amber));
    color: var(--dark);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.85rem;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    z-index: 3;
    animation: volunteerPulse 2s infinite;
    font-family: 'Tajawal', sans-serif;
}

@keyframes volunteerPulse {
    0%, 100% { 
        transform: scale(1);
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }
    50% { 
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.6);
    }
}

.volunteer .profile-image-container {
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3), 0 0 30px rgba(255, 215, 0, 0.5);
    border: 3px solid var(--volunteer-gold);
}

.volunteer .header-info {
    border: 2px solid var(--volunteer-gold);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 0 0 20px rgba(255, 215, 0, 0.3);
}

@media (min-width: 769px) {
    .profile-container {
        padding: 2rem;
        padding-top: 4rem;
    }
    
    .content-wrapper {
        width: 100%;
        max-width: 1600px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 450px 1fr;
        gap: 3rem;
        align-items: start;
        position: relative;
        z-index: 1;
        padding-top: 1rem;
    }
    
    .profile-left {
        position: sticky;
        top: 5rem;
    }
}

/* Mobile Layout */
@media (max-width: 768px) {
    .profile-container {
        padding: 0.75rem;
        padding-top: 3rem;
    }
    
    .content-wrapper {
        width: 100%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: relative;
        z-index: 1;
    }
    
    .profile-left {
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }
}

/* Profile Image */
.profile-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    background: var(--dark);
}

.profile-image-container::before {
    content: '';
    display: block;
    padding-top: 120%;
}

@media (max-width: 768px) {
    .profile-image-container {
        max-height: 50vh;
    }
    
    .profile-image-container::before {
        padding-top: 80%;
    }
}

.profile-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
}

.network-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: rgba(255, 255, 255, 0.95);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    color: var(--primary);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 2;
    font-size: 0.85rem;
}

/* Header Info */
.header-info {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .header-info {
        padding: 1.25rem;
    }
}

.member-name {
    font-size: clamp(1.5rem, 5vw, 2.5rem);
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 0.5rem;
    line-height: 1.2;
    font-family: 'Tajawal', sans-serif;
}

.volunteer .member-name {
    background: linear-gradient(45deg, var(--volunteer-gold), var(--volunteer-amber), var(--primary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.member-title {
    font-size: clamp(0.9rem, 2vw, 1.15rem);
    color: var(--gray);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .member-name {
        text-align: center;
    }
    
    .member-title {
        justify-content: center;
        text-align: center;
    }
}

.title-separator {
    width: 30px;
    height: 2px;
    background: var(--accent);
    display: inline-block;
}

.volunteer .title-separator {
    background: linear-gradient(45deg, var(--volunteer-gold), var(--volunteer-amber));
}

/* Quote Section */
.quote-wrapper {
    margin: 2rem 0;
}

.quote-container {
    background: linear-gradient(135deg, var(--accent-light) 0%, rgba(239, 221, 206, 0.3) 100%);
    padding: 2rem;
    border-radius: 20px;
    position: relative;
    box-shadow: 0 10px 30px rgba(1, 109, 71, 0.1);
    overflow: hidden;
}

@media (max-width: 768px) {
    .quote-wrapper {
        margin: 1rem 0;
    }
    
    .quote-container {
        padding: 1rem;
        background: var(--light-gray);
        border-left: 3px solid var(--primary);
    }
}

.quote-marks {
    position: absolute;
    top: 15px;
    left: 20px;
    font-size: 4rem;
    color: var(--primary);
    opacity: 0.2;
    font-family: Georgia, serif;
    line-height: 1;
}

@media (max-width: 768px) {
    .quote-marks {
        display: none;
    }
}

.quote-content {
    position: relative;
    z-index: 1;
    padding-left: 2rem;
}

@media (max-width: 768px) {
    .quote-content {
        padding-left: 0;
    }
}

/* Bio Lists */
.bio-list {
    list-style: none;
    padding: 0;
    margin: 0;
    direction: rtl;
    text-align: right;
}

.bio-list li {
    position: relative;
    padding-right: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--dark);
    line-height: 1.7;
}

.bio-list li::before {
    content: '•';
    position: absolute;
    right: 0;
    color: var(--primary);
    font-weight: bold;
}

.bio-text {
    color: var(--dark);
    direction: rtl;
    text-align: right;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .social-links {
        justify-content: center;
    }
}

.social-link {
    width: 45px;
    height: 45px;
    background: var(--primary);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.social-link:hover {
    transform: translateY(-3px);
    background: var(--primary-light);
}

.social-link.coming-soon {
    background: var(--gray);
    position: relative;
}

.social-link.coming-soon:hover {
    background: #6a6a6a;
}

.social-link.share-card {
    background: linear-gradient(45deg, #833AB4, #FD1D1D, #F77737);
    position: relative;
    overflow: hidden;
}

.social-link.share-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.social-link.share-card:hover::before {
    left: 100%;
}

.social-link.share-card:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(131, 58, 180, 0.4);
}

.social-link img {
    width: 22px;
    height: 22px;
    filter: brightness(0) invert(1);
}

/* Popup Styles */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.popup-overlay.show {
    opacity: 1;
    visibility: visible;
}

.popup-content {
    background: var(--white);
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    text-align: center;
    max-width: 400px;
    margin: 1rem;
    transform: scale(0.8);
    transition: transform 0.3s ease;
    direction: rtl;
}

.popup-overlay.show .popup-content {
    transform: scale(1);
}

.popup-content h3 {
    color: var(--primary);
    margin-bottom: 1rem;
    font-family: 'Tajawal', sans-serif;
    font-size: 1.5rem;
}

.popup-content p {
    color: var(--gray);
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
}

.popup-close {
    background: var(--primary);
    color: var(--white);
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Tajawal', sans-serif;
}

.popup-close:hover {
    background: var(--primary-light);
}

/* Tabs */
.tabs-container {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Mobile Tabs - Floating navigation */
@media (max-width: 768px) {
    .tabs-container {
        position: relative;
        margin-top: 0.5rem;
    }
    
    .tabs-header {
        position: sticky;
        top: 3rem;
        z-index: 8;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        padding: 0.5rem;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        max-width: 100%;
        min-height: 90px;
    }
    
    .tabs-header::-webkit-scrollbar {
        display: none;
    }
    
    .tab-button {
        flex: 1;
        min-width: 0;
        padding: 0.5rem;
        background: var(--white);
        border-radius: 12px;
        border: 2px solid var(--border);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray);
        transition: all 0.2s ease;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        text-align: center;
    }
    
    .tab-button span {
        display: block;
        white-space: normal;
        line-height: 1.1;
        max-width: 70px;
        word-break: break-word;
    }
    
    .tab-button.active {
        background: var(--primary);
        color: var(--white);
        border-color: var(--primary);
        box-shadow: 0 4px 15px rgba(1, 109, 71, 0.3);
        transform: scale(1.05);
    }
    
    .tab-icon {
        width: 30px;
        height: 30px;
        background: var(--accent);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .tab-icon img {
        width: 18px;
        height: 18px;
    }
    
    .tabs-content {
        padding: 1rem;
        min-height: 200px;
        position: relative;
        margin-top: 0.5rem;
    }
}

/* Desktop Tabs */
@media (min-width: 769px) {
    .tabs-header {
        display: flex;
        background: var(--light-gray);
        border-bottom: 3px solid var(--primary);
    }
    
    .tab-button {
        flex: 1;
        padding: 1.5rem 2rem;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .tab-button:hover {
        background: rgba(255, 255, 255, 0.5);
    }
    
    .tab-button.active {
        background: var(--primary);
        color: var(--white);
    }
    
    .tab-button.active .tab-icon {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .tab-button.active .tab-icon img {
        filter: brightness(0) invert(1);
    }
    
    .tabs-content {
        padding: 2rem;
        min-height: 300px;
        position: relative;
    }
}

.tab-icon {
    width: 35px;
    height: 35px;
    background: var(--accent);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.tab-icon img {
    width: 20px;
    height: 20px;
    transition: all 0.3s ease;
}

.tab-button.active .tab-icon {
    background: rgba(255, 255, 255, 0.2);
}

.tab-button.active .tab-icon img {
    filter: brightness(0) invert(1);
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
}

.tab-panel.active::before {
    content: attr(data-title);
    display: block;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--accent);
    font-family: 'Tajawal', sans-serif;
}

.tab-content-inner {
    color: var(--dark);
    font-size: 1rem;
    line-height: 1.8;
    direction: rtl;
    text-align: right;
}

/* Skills */
.skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    direction: rtl;
}

.skill-tag {
    background: var(--primary);
    color: var(--white);
    padding: 0.5rem 1.25rem;
    border-radius: 25px;
    font-size: 0.9rem;
    white-space: nowrap;
}

/* Title Badge */
.page-title {
    position: fixed;
    top: 0.5rem;
    right: 50%;
    transform: translateX(50%);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    color: var(--primary);
    font-size: clamp(0.85rem, 2vw, 1.1rem);
    font-weight: 700;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Tajawal', sans-serif;
    z-index: 10;
    text-align: center;
    max-width: 90%;
}

@media (min-width: 769px) {
    .page-title {
        top: 1rem;
    }
}

/* Small Screens */
@media (max-width: 480px) {
    .profile-container {
        padding: 0.5rem;
        padding-top: 2.5rem;
    }
    
    .page-title {
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
    }
    
    .network-badge {
        font-size: 0.75rem;
        padding: 0.3rem 0.8rem;
    }
    
    .header-info {
        padding: 1rem;
    }
    
    .member-name {
        font-size: 1.25rem;
    }
    
    .social-links {
        gap: 0.75rem;
    }
    
    .social-link {
        width: 40px;
        height: 40px;
    }
}
</style>

<?php
// Check if user is a volunteer
$role = get_field('role') ?: get_field('field_job_title');
$isVolunteer = stripos($role, 'متطوع') !== false;
?>

<div class="profile-container <?php echo $isVolunteer ? 'volunteer' : ''; ?>">
    <div class="profile-bg-pattern"></div>
    
    <h1 class="page-title">مشترك/ة بالفنجان</h1>
    
    <div class="content-wrapper">
        <!-- Profile Image -->
        <div class="profile-left">
            <div class="profile-image-container">
                <?php $network = get_field('network');
                if ($network) { ?>
                    <div class="network-badge">
                        <?php echo is_array($network) ? $network[0] : $network; ?>
                    </div>
                <?php } ?>
                
                <?php if ($isVolunteer) { ?>
                    <div class="volunteer-badge">
                        ⭐ متطوع
                    </div>
                <?php } ?>
                
                <img 
                    class="profile-image" 
                    src="<?php echo get_the_post_thumbnail_url($post->ID) ?: get_template_directory_uri() . '/images/default-profile.jpg'; ?>" 
                    alt="<?php the_title(); ?>"
                    loading="eager"
                >
            </div>
        </div>

        <!-- Info Section -->
        <div class="profile-right">
            <div class="header-info">
                <h2 class="member-name"><?php the_title(); ?></h2>
                
                <div class="member-title">
                    <span><?php echo get_field('role') ?: get_field('field_job_title'); ?></span>
                    <span class="title-separator"></span>
                    <span><?php echo get_field('company') ?: get_field('field_university'); ?></span>
                </div>

                <?php
                $quote = get_field('harmony_experience');
                if (!$quote) $quote = get_field('field_message');
                if ($quote) { ?>
                    <div class="quote-wrapper">
                        <div class="quote-container">
                            <div class="quote-marks">"</div>
                            <div class="quote-content">
                                <?php echo format_bio_content($quote); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php
                $instagram = get_field('field_instagram');
                $linkedin = get_field('field_linkedin');
                
                if (!$instagram && !$linkedin) {
                    $socials = get_field('socials');
                    $instagram = $socials['instagram'] ?? '';
                    $linkedin = $socials['linkedin'] ?? '';
                }
                
                // Format Instagram URL to handle usernames - Force formatting
                $instagram_url = '';
                if (!empty($instagram)) {
                    $instagram_url = format_instagram_url($instagram);
                    // Double check - if still no http, force it
                    if (!empty($instagram_url) && !preg_match('/^https?:\/\//', $instagram_url)) {
                        $instagram_url = 'https://www.instagram.com/' . trim($instagram_url, '@/') . '/';
                    }
                }
                
                // Format LinkedIn URL to handle names and usernames
                $linkedin_url = '';
                if (!empty($linkedin)) {
                    $linkedin_url = format_linkedin_url($linkedin);
                    // Double check - if still no http, force search
                    if (!empty($linkedin_url) && !preg_match('/^https?:\/\//', $linkedin_url)) {
                        $encoded_name = urlencode(trim($linkedin_url));
                        $linkedin_url = 'https://www.linkedin.com/search/results/all/?keywords=' . $encoded_name . '&origin=GLOBAL_SEARCH_HEADER';
                    }
                }
                ?>
                
                <div class="social-links">
                    <?php if ($instagram_url) { ?>
                        <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" class="social-link" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri() . '/images/instagram3.png'; ?>" alt="Instagram">
                        </a>
                    <?php } ?>
                    
                    <?php if ($linkedin_url) { ?>
                        <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" class="social-link" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri() . '/images/linkedin3.png'; ?>" alt="LinkedIn">
                        </a>
                    <?php } ?>
                    
                    <!-- New coming soon icons -->
                    <div class="social-link coming-soon" onclick="showComingSoonPopup()">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    
                    <div class="social-link coming-soon" onclick="showComingSoonPopup()">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10h5v-2h-5c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8v1.43c0 .79-.71 1.57-1.5 1.57s-1.5-.78-1.5-1.57V12c0-2.76-2.24-5-5-5s-5 2.24-5 5 2.24 5 5 5c1.38 0 2.64-.56 3.54-1.47.65.89 1.77 1.47 2.96 1.47 1.97 0 3.5-1.53 3.5-3.5V12c0-5.52-4.48-10-10-10zm0 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/>
                        </svg>
                    </div>
                    
                    <div class="social-link coming-soon" onclick="showComingSoonPopup()">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v5l4-2.9L16 22v-5h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <?php
            $info = [];
            $map = [
                'field_edu_resume'      => ['title' => 'الخلفية الاكاديمية', 'icon' => 'https://harmony-network.org/wp-content/uploads/2025/03/mortarboard-1.png'],
                'field_pro_resume'      => ['title' => 'السيرة المهنية', 'icon' => 'https://harmony-network.org/wp-content/uploads/2025/03/resume.png'],
                'field_personal_resume' => ['title' => 'السيرة الذاتية', 'icon' => 'https://harmony-network.org/wp-content/uploads/2025/03/user-1.png'],
                'field_selected_skills' => ['title' => 'المهارات', 'icon' => 'https://harmony-network.org/wp-content/uploads/2025/03/puzzle.png'],
            ];

            foreach ($map as $field_key => $meta) {
                $value = get_field($field_key);
                if ($value) {
                    if (is_array($value) && $field_key === 'field_selected_skills') {
                        $skill_titles = array_map(function ($post) {
                            return get_the_title($post);
                        }, $value);
                        $content = $skill_titles;
                    } else {
                        $content = $value;
                    }
                    
                    $info[] = [
                        'title'   => $meta['title'],
                        'content' => $content,
                        'icon'    => $meta['icon'],
                        'type'    => $field_key === 'field_selected_skills' ? 'skills' : 'text'
                    ];
                }
            }

            if (empty($info)) {
                $legacy_info = get_field('info_new');
                if ($legacy_info) {
                    foreach ($legacy_info as $row) {
                        $info[] = [
                            'title'   => $row['title'] ?? '',
                            'content' => $row['content'] ?? '',
                            'icon'    => isset($row['icon']['url']) ? $row['icon']['url'] : '',
                            'type'    => 'text'
                        ];
                    }
                }
            }

            if ($info) { ?>
                <div class="tabs-container">
                    <div class="tabs-header">
                        <?php 
                        $validIndex = 0;
                        foreach ($info as $item) { 
                            if ($item['title'] !== 'الإنجازات') { ?>
                                <button class="tab-button <?php echo $validIndex === 0 ? 'active' : ''; ?>" 
                                        onclick="switchTab(<?php echo $validIndex; ?>)"
                                        type="button">
                                    <?php if ($item['icon']) { ?>
                                        <div class="tab-icon">
                                            <img src="<?php echo $item['icon']; ?>" alt="">
                                        </div>
                                    <?php } ?>
                                    <span><?php echo $item['title']; ?></span>
                                </button>
                            <?php $validIndex++;
                            }
                        } ?>
                    </div>
                    
                    <div class="tabs-content">
                        <?php 
                        $validIndex = 0;
                        foreach ($info as $item) { 
                            if ($item['title'] !== 'الإنجازات') { ?>
                                <div class="tab-panel <?php echo $validIndex === 0 ? 'active' : ''; ?>" 
                                     data-title="<?php echo esc_attr($item['title']); ?>">
                                    <div class="tab-content-inner">
                                        <?php 
                                        if ($item['type'] === 'skills' && is_array($item['content'])) {
                                            echo '<div class="skills-grid">';
                                            foreach ($item['content'] as $skill) {
                                                echo '<span class="skill-tag">' . esc_html($skill) . '</span>';
                                            }
                                            echo '</div>';
                                        } else if (!empty($item['content'])) {
                                            echo format_bio_content($item['content']);
                                        } else {
                                            echo '<p class="bio-text">لا توجد معلومات متاحة</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php $validIndex++;
                            }
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Coming Soon Popup -->
<div class="popup-overlay" id="comingSoonPopup">
    <div class="popup-content">
        <h3>قريباً</h3>
        <p>هذه الخاصية سوف تتوفر قريبا</p>
        <button class="popup-close" onclick="hideComingSoonPopup()">حسناً</button>
    </div>
</div>

<!-- Share Card Generation Canvas (Hidden) -->
<canvas id="shareCanvas" style="display: none;" width="1080" height="1080"></canvas>

<!-- Hidden data for card generation -->
<div id="profileData" style="display: none;">
    <span id="memberName"><?php the_title(); ?></span>
    <span id="memberRole"><?php echo get_field('role') ?: get_field('field_job_title'); ?></span>
    <span id="memberCompany"><?php echo get_field('company') ?: get_field('field_university'); ?></span>
    <span id="memberNetwork"><?php echo is_array($network) ? $network[0] : $network; ?></span>
    <span id="profileImageUrl"><?php echo get_the_post_thumbnail_url($post->ID) ?: get_template_directory_uri() . '/images/default-profile.jpg'; ?></span>
    <span id="isVolunteer"><?php echo $isVolunteer ? 'true' : 'false'; ?></span>
</div>

<?php get_footer(); ?>

<script>
function switchTab(tabIndex) {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    if (tabIndex < 0 || tabIndex >= tabButtons.length || tabIndex >= tabPanels.length) return;
    
    // Remove active from all
    tabButtons.forEach(btn => btn.classList.remove('active'));
    tabPanels.forEach(panel => {
        panel.classList.remove('active');
        panel.style.display = 'none';
    });
    
    // Add active to selected
    tabButtons[tabIndex].classList.add('active');
    tabPanels[tabIndex].classList.add('active');
    tabPanels[tabIndex].style.display = 'block';
    
    // On mobile, ensure the active tab button is visible in the horizontal scroll
    if (window.innerWidth <= 768) {
        tabButtons[tabIndex].scrollIntoView({ 
            behavior: 'smooth', 
            inline: 'center',
            block: 'nearest'
        });
    }
}

function showComingSoonPopup() {
    const popup = document.getElementById('comingSoonPopup');
    popup.classList.add('show');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function hideComingSoonPopup() {
    const popup = document.getElementById('comingSoonPopup');
    popup.classList.remove('show');
    document.body.style.overflow = ''; // Restore scrolling
}

// Close popup when clicking outside
document.getElementById('comingSoonPopup').addEventListener('click', function(e) {
    if (e.target === this) {
        hideComingSoonPopup();
    }
});

async function generateShareCard() {
    try {
        const canvas = document.getElementById('shareCanvas');
        const ctx = canvas.getContext('2d');
        
        // Get profile data
        const memberName = document.getElementById('memberName').textContent;
        const memberRole = document.getElementById('memberRole').textContent;
        const memberCompany = document.getElementById('memberCompany').textContent;
        const memberNetwork = document.getElementById('memberNetwork').textContent;
        const profileImageUrl = document.getElementById('profileImageUrl').textContent;
        const isVolunteer = document.getElementById('isVolunteer').textContent === 'true';
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Create gradient background
        const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
        if (isVolunteer) {
            gradient.addColorStop(0, '#FFD700');
            gradient.addColorStop(0.3, '#FFB700');
            gradient.addColorStop(0.6, '#016D47');
            gradient.addColorStop(1, '#014532');
        } else {
            gradient.addColorStop(0, '#016D47');
            gradient.addColorStop(0.5, '#014532');
            gradient.addColorStop(1, '#016D47');
        }
        
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Add decorative pattern
        ctx.save();
        ctx.globalAlpha = 0.1;
        ctx.fillStyle = '#FFFFFF';
        for (let i = 0; i < 20; i++) {
            ctx.beginPath();
            ctx.arc(Math.random() * canvas.width, Math.random() * canvas.height, Math.random() * 50 + 10, 0, 2 * Math.PI);
            ctx.fill();
        }
        ctx.restore();
        
        // Add main container background
        const containerX = 80;
        const containerY = 200;
        const containerWidth = canvas.width - 160;
        const containerHeight = 680;
        
        ctx.fillStyle = 'rgba(255, 255, 255, 0.95)';
        ctx.roundRect(containerX, containerY, containerWidth, containerHeight, 40);
        ctx.fill();
        
        // Add shadow
        ctx.save();
        ctx.shadowColor = 'rgba(0, 0, 0, 0.3)';
        ctx.shadowBlur = 20;
        ctx.shadowOffsetY = 10;
        ctx.fillStyle = 'rgba(255, 255, 255, 0.95)';
        ctx.roundRect(containerX, containerY, containerWidth, containerHeight, 40);
        ctx.fill();
        ctx.restore();
        
        // Load and draw profile image
        const profileImg = new Image();
        profileImg.crossOrigin = 'anonymous';
        
        await new Promise((resolve, reject) => {
            profileImg.onload = resolve;
            profileImg.onerror = reject;
            profileImg.src = profileImageUrl;
        });
        
        // Draw circular profile image
        const imgSize = 200;
        const imgX = canvas.width / 2 - imgSize / 2;
        const imgY = containerY + 60;
        
        ctx.save();
        ctx.beginPath();
        ctx.arc(imgX + imgSize / 2, imgY + imgSize / 2, imgSize / 2, 0, 2 * Math.PI);
        ctx.clip();
        ctx.drawImage(profileImg, imgX, imgY, imgSize, imgSize);
        ctx.restore();
        
        // Add profile image border
        ctx.strokeStyle = isVolunteer ? '#FFD700' : '#016D47';
        ctx.lineWidth = 8;
        ctx.beginPath();
        ctx.arc(imgX + imgSize / 2, imgY + imgSize / 2, imgSize / 2 + 4, 0, 2 * Math.PI);
        ctx.stroke();
        
        // Add volunteer badge if applicable
        if (isVolunteer) {
            ctx.save();
            ctx.fillStyle = '#FFD700';
            ctx.strokeStyle = '#FFB700';
            ctx.lineWidth = 3;
            ctx.beginPath();
            ctx.arc(imgX + imgSize - 30, imgY + 30, 25, 0, 2 * Math.PI);
            ctx.fill();
            ctx.stroke();
            
            ctx.fillStyle = '#014532';
            ctx.font = 'bold 20px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('⭐', imgX + imgSize - 30, imgY + 38);
            ctx.restore();
        }
        
        // Set text styles
        ctx.textAlign = 'center';
        ctx.textBaseline = 'top';
        
        // Main announcement text
        ctx.fillStyle = isVolunteer ? '#FFB700' : '#016D47';
        ctx.font = 'bold 48px Arial';
        ctx.fillText('أنا مشارك بفنجان!', canvas.width / 2, containerY + 300);
        
        // Member name
        ctx.fillStyle = '#1a1a1a';
        ctx.font = 'bold 40px Arial';
        const nameY = containerY + 380;
        ctx.fillText(memberName, canvas.width / 2, nameY);
        
        // Role and company
        ctx.fillStyle = '#5a5a5a';
        ctx.font = '32px Arial';
        const roleY = nameY + 60;
        
        if (memberRole && memberCompany) {
            ctx.fillText(memberRole, canvas.width / 2, roleY);
            ctx.fillText(memberCompany, canvas.width / 2, roleY + 50);
        } else if (memberRole) {
            ctx.fillText(memberRole, canvas.width / 2, roleY + 25);
        } else if (memberCompany) {
            ctx.fillText(memberCompany, canvas.width / 2, roleY + 25);
        }
        
        // Network badge
        if (memberNetwork) {
            const badgeY = containerY + 580;
            const badgeWidth = 300;
            const badgeHeight = 50;
            const badgeX = canvas.width / 2 - badgeWidth / 2;
            
            ctx.fillStyle = isVolunteer ? '#FFD700' : '#016D47';
            ctx.roundRect(badgeX, badgeY, badgeWidth, badgeHeight, 25);
            ctx.fill();
            
            ctx.fillStyle = '#FFFFFF';
            ctx.font = 'bold 24px Arial';
            ctx.fillText(memberNetwork, canvas.width / 2, badgeY + 15);
        }
        
        // Harmony Network branding at bottom
        ctx.fillStyle = 'rgba(1, 109, 71, 0.7)';
        ctx.font = 'bold 28px Arial';
        ctx.fillText('Harmony Network', canvas.width / 2, containerY + 650);
        
        // Add coffee cup emoji and decorative elements
        ctx.font = '60px Arial';
        ctx.fillText('☕', 150, 100);
        ctx.fillText('☕', canvas.width - 150, 100);
        
        // Download the image
        const dataURL = canvas.toDataURL('image/png', 1.0);
        const link = document.createElement('a');
        link.download = `${memberName}_مشارك_بفنجان.png`;
        link.href = dataURL;
        link.click();
        
    } catch (error) {
        console.error('Error generating share card:', error);
        alert('حدث خطأ في إنشاء الصورة. يرجى المحاولة مرة أخرى.');
    }
}

// Add roundRect support for older browsers
if (!CanvasRenderingContext2D.prototype.roundRect) {
    CanvasRenderingContext2D.prototype.roundRect = function(x, y, width, height, radius) {
        this.beginPath();
        this.moveTo(x + radius, y);
        this.lineTo(x + width - radius, y);
        this.quadraticCurveTo(x + width, y, x + width, y + radius);
        this.lineTo(x + width, y + height - radius);
        this.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
        this.lineTo(x + radius, y + height);
        this.quadraticCurveTo(x, y + height, x, y + height - radius);
        this.lineTo(x, y + radius);
        this.quadraticCurveTo(x, y, x + radius, y);
        this.closePath();
    };
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.tab-button');
    const panels = document.querySelectorAll('.tab-panel');
    
    // Hide all panels except first
    panels.forEach((panel, i) => {
        if (i === 0) {
            panel.style.display = 'block';
            panel.classList.add('active');
        } else {
            panel.style.display = 'none';
            panel.classList.remove('active');
        }
    });
    
    // Add click handlers
    buttons.forEach((btn, index) => {
        btn.addEventListener('click', () => switchTab(index));
    });
    
    // Fix Instagram links if they're still not proper URLs
    const instagramLinks = document.querySelectorAll('a[href*="instagram"], a[href^="@"], a[href]:not([href^="http"]):not([href^="mailto"]):not([href^="tel"])');
    instagramLinks.forEach(link => {
        let href = link.getAttribute('href');
        if (href && !href.startsWith('http') && !href.startsWith('mailto') && !href.startsWith('tel')) {
            // Check if this is meant to be Instagram (has Instagram image or similar)
            const img = link.querySelector('img');
            const isInstagram = img && (img.src.includes('instagram') || img.alt.toLowerCase().includes('instagram'));
            
            if (isInstagram) {
                // Assume it's an Instagram username
                const username = href.replace(/^@/, '').replace(/^\//, '').replace(/\/$/, '');
                if (username && /^[a-zA-Z0-9._]+$/.test(username)) {
                    link.setAttribute('href', `https://www.instagram.com/${username}/`);
                    console.log('Fixed Instagram link:', href, '→', `https://www.instagram.com/${username}/`);
                }
            }
        }
    });
    
    // Fix LinkedIn links - convert names to search URLs
    const linkedinLinks = document.querySelectorAll('a[href*="linkedin"]');
    linkedinLinks.forEach(link => {
        let href = link.getAttribute('href');
        if (href && !href.startsWith('http') && !href.startsWith('mailto') && !href.startsWith('tel')) {
            // Check if this is meant to be LinkedIn
            const img = link.querySelector('img');
            const isLinkedIn = img && (img.src.includes('linkedin') || img.alt.toLowerCase().includes('linkedin'));
            
            if (isLinkedIn) {
                // If it looks like a name (has spaces or is long), create search URL
                if (href.includes(' ') || href.length > 15 || !/^[a-zA-Z0-9._-]+$/.test(href)) {
                    const encodedName = encodeURIComponent(href);
                    const searchUrl = `https://www.linkedin.com/search/results/all/?keywords=${encodedName}&origin=GLOBAL_SEARCH_HEADER`;
                    link.setAttribute('href', searchUrl);
                    console.log('Fixed LinkedIn search link:', href, '→', searchUrl);
                } else {
                    // Assume it's a username, create profile URL
                    link.setAttribute('href', `https://www.linkedin.com/in/${href}/`);
                    console.log('Fixed LinkedIn profile link:', href, '→', `https://www.linkedin.com/in/${href}/`);
                }
            }
        }
    });
    
    // Additional check for any remaining problematic social links
    const allSocialLinks = document.querySelectorAll('.social-link');
    allSocialLinks.forEach(link => {
        let href = link.getAttribute('href');
        if (href && !href.startsWith('http') && !href.startsWith('mailto') && !href.startsWith('tel') && !href.startsWith('javascript')) {
            const img = link.querySelector('img');
            if (img) {
                if (img.src.includes('instagram') || img.alt.toLowerCase().includes('instagram')) {
                    // Fix Instagram
                    const username = href.replace(/^@/, '').replace(/^\//, '').replace(/\/$/, '');
                    if (username) {
                        link.setAttribute('href', `https://www.instagram.com/${username}/`);
                        console.log('Emergency Instagram fix:', href, '→', `https://www.instagram.com/${username}/`);
                    }
                } else if (img.src.includes('linkedin') || img.alt.toLowerCase().includes('linkedin')) {
                    // Fix LinkedIn
                    if (href.includes(' ') || href.length > 15) {
                        const encodedName = encodeURIComponent(href);
                        link.setAttribute('href', `https://www.linkedin.com/search/results/all/?keywords=${encodedName}&origin=GLOBAL_SEARCH_HEADER`);
                        console.log('Emergency LinkedIn search fix:', href);
                    } else {
                        link.setAttribute('href', `https://www.linkedin.com/in/${href}/`);
                        console.log('Emergency LinkedIn profile fix:', href);
                    }
                }
            }
        }
    });
});
</script>