<?php
/**
 * Template Name: Team - Clean & Enhanced
 **/
?>
<?php get_header(); ?>

<!-- Leadership Section - القيادة التنفيذية -->
<?php 
$ceos = get_field('ceos');
if ($ceos) { ?>
    <div class="leadership-section">
        <div class="container">
            <div class="section-header">
                <h1 class="page-title"><?php echo the_title(); ?></h1>
                <div class="section-divider"></div>
                <p class="section-description">القيادة التنفيذية التي تقود رؤيتنا نحو التميز والإبداع</p>
            </div>
            
            <div class="leadership-grid123">
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

<!-- Teams Section with Enhanced Tabs -->
<?php 
$crew = get_field('crew');
if ($crew) { ?>
    <div class="teams-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo get_field('volunteer_t') ?: 'فرق العمل'; ?></h2>
                <div class="section-divider"></div>
                <p class="section-description">تعرف على فرقنا المتميزة والمواهب المبدعة في كل تخصص</p>
            </div>
            
            <!-- Teams Navigation Tabs -->
            <div class="teams-nav-wrapper">
                <div class="teams-nav">
                    <button class="team-nav-btn show-all-btn active" data-team="all">
                        <div class="nav-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M20.5 21V19C20.4993 18.1137 20.2044 17.2528 19.6614 16.5523C19.1184 15.8519 18.3604 15.3516 17.5 15.1318M14.5 3.13185C15.3604 3.35165 16.1184 3.85194 16.6614 4.55232C17.2044 5.25271 17.4993 6.11365 17.5 7.00001C17.4993 7.88637 17.2044 8.74731 16.6614 9.44769C16.1184 10.1481 15.3604 10.6484 14.5 10.8682M12.5 7C12.5 9.20914 10.7091 11 8.5 11C6.29086 11 4.5 9.20914 4.5 7C4.5 4.79086 6.29086 3 8.5 3C10.7091 3 12.5 4.79086 12.5 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="nav-text">
                            <span class="team-nav-title">جميع الأعضاء</span>
                            <span class="team-nav-count">
                                <?php 
                                $total_members = 0;
                                foreach ($crew as $team) {
                                    $t = $team['team'];
                                    if ($t) $total_members += count($t);
                                }
                                echo "($total_members عضو)";
                                ?>
                            </span>
                        </div>
                    </button>
                    
                    <?php foreach ($crew as $index => $team) { ?>
                        <button class="team-nav-btn" data-team="<?php echo $index; ?>">
                            <div class="nav-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M21 10.5V6L19 4L17 6V10.5C17 11.0523 17.4477 11.5 18 11.5H20C20.5523 11.5 21 11.0523 21 10.5ZM13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="nav-text">
                                <span class="team-nav-title"><?php echo $team['title'] ?></span>
                                <span class="team-nav-count">
                                    <?php $t = $team['team']; ?>
                                    (<?php echo $t ? count($t) : 0; ?> عضو)
                                </span>
                            </div>
                        </button>
                    <?php } ?>
                </div>
            </div>
            
            <!-- Teams Content -->
            <div class="teams-content">
                <!-- All Members View -->
                <div class="team-content active" data-team="all">
                    <div class="all-members-grid">
                        <?php 
                        $all_member_index = 0;
                        foreach ($crew as $team_index => $team) { 
                            $t = $team['team'];
                            if ($t) {
                                foreach ($t as $emp) {
                                    $member_name = is_object($emp) ? $emp->post_title : (isset($emp['name']) ? $emp['name'] : '');
                                    $member_role = is_object($emp) ? get_field('role', $emp->ID) : (isset($emp['role']) ? $emp['role'] : '');
                                    $member_company = is_object($emp) ? get_field('company', $emp->ID) : (isset($emp['company']) ? $emp['company'] : '');
                                    ?>
                                    <div class="member-card-enhanced" 
                                         data-aos="zoom-in" 
                                         data-aos-delay="<?php echo ($all_member_index % 12) * 100; ?>">
                                        
                                        <div class="member-image-container">
                                            <?php 
                                            if (is_object($emp) && has_post_thumbnail($emp->ID)) {
                                                echo get_the_post_thumbnail($emp->ID, 'medium', array('class' => 'member-image-square'));
                                            } elseif (isset($emp['photo']) && $emp['photo']) {
                                                echo '<img src="' . esc_url($emp['photo']) . '" class="member-image-square" alt="' . esc_attr($member_name) . '">';
                                            } else {
                                                echo '<div class="member-placeholder">
                                                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="currentColor"/>
                                                            <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="currentColor"/>
                                                        </svg>
                                                      </div>';
                                            }
                                            ?>
                                            <div class="team-badge"><?php echo $team['title']; ?></div>
                                            <div class="member-overlay">
                                                <div class="overlay-content">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="member-info">
                                            <h4 class="member-name"><?php echo $member_name; ?></h4>
                                            <?php if ($member_role) { ?>
                                                <p class="member-role"><?php echo $member_role; ?></p>
                                            <?php } ?>
                                            <?php if ($member_company) { ?>
                                                <p class="member-company"><?php echo $member_company; ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    $all_member_index++;
                                }
                            }
                        } ?>
                    </div>
                </div>
                
                <!-- Individual Team Views -->
                <?php foreach ($crew as $index => $team) { ?>
                    <div class="team-content" data-team="<?php echo $index; ?>">
                        <!-- Team Description Area -->
                        <div class="team-description">
                            <div class="team-info-card">
                                <div class="team-header">
                                    <div class="team-icon">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M21 10.5V6L19 4L17 6V10.5C17 11.0523 17.4477 11.5 18 11.5H20C20.5523 11.5 21 11.0523 21 10.5ZM13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="team-title-section">
                                        <h3 class="team-title"><?php echo $team['title'] ?></h3>
                                        <div class="team-stats">
                                            <span class="member-count"><?php echo $t ? count($t) : 0; ?> عضو</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if(isset($team['description']) && $team['description']) { ?>
                                    <div class="team-desc-text">
                                        <?php echo $team['description']; ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="team-desc-placeholder">
                                        <div class="placeholder-icon">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.5 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7.5L14.5 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 2V8H20M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <p>سيتم إضافة وصف الفريق هنا باستخدام ACF</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!-- Team Members Grid -->
                        <?php $t = $team['team']; if ($t) { ?>
                            <div class="team-members-section">
                                <div class="members-header">
                                    <h4 class="members-title">أعضاء الفريق</h4>
                                    <div class="members-divider"></div>
                                </div>
                                <div class="team-members-grid">
                                    <?php foreach ($t as $memberIndex => $emp) { ?>
                                        <div class="member-wrapper" data-aos="flip-left" data-aos-delay="<?php echo $memberIndex * 150; ?>">
                                            <div class="member-card-inner">
                                                <div class="member-image-container">
                                                    <?php 
                                                    if (is_object($emp) && has_post_thumbnail($emp->ID)) {
                                                        echo get_the_post_thumbnail($emp->ID, 'medium', array('class' => 'member-image-square'));
                                                    } else {
                                                        echo '<div class="member-placeholder">
                                                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="currentColor"/>
                                                                    <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="currentColor"/>
                                                                </svg>
                                                              </div>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="member-info">
                                                    <h5 class="member-name">
                                                        <?php echo is_object($emp) ? $emp->post_title : (isset($emp['name']) ? $emp['name'] : ''); ?>
                                                    </h5>
                                                    <?php 
                                                    $role = is_object($emp) ? get_field('role', $emp->ID) : (isset($emp['role']) ? $emp['role'] : '');
                                                    if ($role) { ?>
                                                        <p class="member-role"><?php echo $role; ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Inspirational Quotes Section -->
<div class="quotes-section">
    <div class="container">
        <div class="quotes-header">
            <h3 class="quotes-title">كلمات ملهمة</h3>
            <div class="quotes-divider"></div>
        </div>
        <div class="quotes-grid">
            <div class="quote-card" data-aos="fade-up" data-aos-delay="0">
                <div class="quote-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 8C7.5 8 9 4 12.5 4S17.5 8 17.5 8 16 12 12.5 12 7.5 8 7.5 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 21C7 21 8.5 17 12 17S17 21 17 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="quote-text">"الفريق الواحد يحقق ما لا يستطيع الفرد تحقيقه بمفرده"</p>
                <div class="quote-author">فلسفة العمل الجماعي</div>
            </div>
            
            <div class="quote-card" data-aos="fade-up" data-aos-delay="200">
                <div class="quote-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L15.09 8.26L22 9L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="quote-text">"التنوع في الخبرات يخلق القوة في النتائج"</p>
                <div class="quote-author">رؤية هارموني</div>
            </div>
            
            <div class="quote-card" data-aos="fade-up" data-aos-delay="400">
                <div class="quote-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="quote-text">"الإبداع ينبع من تفاعل العقول المختلفة"</p>
                <div class="quote-author">قوة التعاون</div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #016D47;
    --primary-light: #02a663;
    --primary-dark: #014a32;
    --secondary-color: #f8f9fa;
    --beige-color: #EFDDCE;
    --beige-light: #F7EADC;
    --accent-color: #28a745;
    --text-dark: #2c3e50;
    --text-light: #6c757d;
    --white: #ffffff;
    --shadow-light: 0 4px 15px rgba(1, 109, 71, 0.1);
    --shadow-medium: 0 8px 25px rgba(1, 109, 71, 0.15);
    --shadow-heavy: 0 15px 35px rgba(1, 109, 71, 0.2);
    --border-radius: 16px;
    --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Leadership Section */
.leadership-section {
    padding: 60px 0 80px 0;
    background: linear-gradient(135deg, var(--beige-color) 0%, var(--beige-light) 100%);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.page-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.section-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.section-divider {
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
    margin: 0 auto 1.5rem;
    border-radius: 2px;
    position: relative;
}

.section-divider::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 16px;
    height: 16px;
    background: var(--beige-light);
    border: 3px solid var(--accent-color);
    border-radius: 50%;
}

.section-description {
    font-size: 1.2rem;
    color: var(--text-light);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

.leadership-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    justify-items: center;
    max-width: 1400px;
    margin: 0 auto;
}

.leadership-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    overflow: hidden;
    transition: var(--transition);
    position: relative;
    width: 100%;
    max-width: 350px;
    border: 1px solid rgba(1, 109, 71, 0.1);
}

.leadership-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
}

.leadership-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(145deg, rgba(1, 109, 71, 0.02), rgba(40, 167, 69, 0.05));
    opacity: 0;
    transition: var(--transition);
    z-index: 1;
}

.leadership-card:hover::after {
    opacity: 1;
}

.leadership-card:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: 0 25px 50px rgba(1, 109, 71, 0.2);
    border-color: var(--accent-color);
}

.card-content {
    padding: 2.5rem 2rem;
    position: relative;
    z-index: 2;
}

.member-image-container {
    position: relative;
    width: 140px;
    height: 200px;
    margin: 0 auto 1.5rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-medium);
}

.member-image-square {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: var(--transition);
}

.leadership-card:hover .member-image-square {
    transform: scale(1.1);
}

.member-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--beige-color), var(--beige-light));
    color: var(--accent-color);
}

.leadership-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
}

.member-details {
    text-align: center;
}

.member-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.member-role {
    font-size: 1rem;
    color: var(--accent-color);
    font-weight: 600;
    margin-bottom: 0.3rem;
}

.member-position {
    font-size: 0.9rem;
    color: var(--text-light);
    margin: 0;
}

/* Teams Section */
.teams-section {
    padding: 80px 0;
    background: var(--beige-color);
}

/* Enhanced Navigation */
.teams-nav-wrapper {
    background: white;
    border-radius: 20px;
    padding: 15px;
    margin-bottom: 3rem;
    box-shadow: var(--shadow-medium);
    overflow-x: auto;
}

.teams-nav {
    display: flex;
    gap: 10px;
    min-width: max-content;
}

.team-nav-btn {
    background: transparent;
    border: none;
    padding: 20px 25px;
    border-radius: 15px;
    transition: var(--transition);
    cursor: pointer;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 15px;
}

.team-nav-btn:hover {
    background: #f8f9fa;
    transform: translateY(-3px);
}

.team-nav-btn.active {
    background: linear-gradient(135deg, var(--accent-color), var(--primary-light));
    color: white;
    box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
}

.nav-icon {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.team-nav-btn:not(.active) .nav-icon {
    background: var(--beige-color);
    color: var(--accent-color);
}

.nav-text {
    text-align: right;
}

.team-nav-title {
    display: block;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 3px;
}

.team-nav-count {
    display: block;
    font-size: 12px;
    opacity: 0.8;
}

.team-nav-btn:not(.active) .team-nav-title {
    color: var(--text-dark);
}

.team-nav-btn:not(.active) .team-nav-count {
    color: var(--text-light);
}

/* Teams Content */
.teams-content {
    position: relative;
    min-height: 500px;
}

.team-content {
    display: none;
    animation: fadeInUp 0.6s ease forwards;
}

.team-content.active {
    display: block;
}

/* All Members Grid - 4 per row */
.all-members-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    margin-top: 2rem;
}

.member-card-enhanced {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    overflow: hidden;
    transition: var(--transition);
    position: relative;
    border: 1px solid rgba(1, 109, 71, 0.1);
    aspect-ratio: 3/5;
    min-height: 580px;
}

.member-card-enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(145deg, rgba(1, 109, 71, 0.02), rgba(40, 167, 69, 0.05));
    opacity: 0;
    transition: var(--transition);
    z-index: 1;
}

.member-card-enhanced:hover::before {
    opacity: 1;
}

.member-card-enhanced:hover {
    transform: translateY(-15px) scale(1.02) translateZ(30px);
    box-shadow: 0 25px 50px rgba(1, 109, 71, 0.2);
    border-color: var(--accent-color);
    z-index: 10;
}

.member-card-enhanced .member-image-container {
    position: relative;
    width: 100%;
    height: 450px;
    overflow: hidden;
    border-radius: 12px 12px 0 0;
}

.member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(1, 109, 71, 0.8), rgba(40, 167, 69, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.member-card-enhanced:hover .member-overlay {
    opacity: 1;
}

.overlay-content {
    color: white;
    text-align: center;
}

.team-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, var(--accent-color), var(--primary-light));
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 11px;
    font-weight: 700;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 3;
}

.member-info {
    padding: 2rem 1.5rem;
    text-align: center;
    position: relative;
    z-index: 2;
    background: linear-gradient(to bottom, rgba(255,255,255,0.95), white);
}

.member-info .member-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.7rem;
    line-height: 1.3;
}

.member-info .member-role {
    font-size: 1.1rem;
    color: var(--accent-color);
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-transform: capitalize;
}

.member-info .member-company {
    font-size: 1rem;
    color: var(--text-light);
    margin: 0;
    font-style: italic;
}

/* Individual Team Content */
.team-description {
    margin-bottom: 3rem;
}

.team-info-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
    border-left: 6px solid var(--accent-color);
}

.team-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, var(--accent-color), var(--primary-light));
    opacity: 0.08;
    border-radius: 50%;
    transform: translate(40px, -40px);
}

.team-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.team-icon {
    background: linear-gradient(135deg, var(--accent-color), var(--primary-light));
    color: white;
    padding: 12px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.team-title-section {
    flex: 1;
}

.team-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.member-count {
    background: var(--beige-color);
    color: var(--accent-color);
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
}

.team-desc-text {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--text-dark);
}

.team-desc-placeholder {
    background: var(--beige-color);
    border: 2px dashed #ccc;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    color: var(--text-light);
}

.placeholder-icon {
    margin-bottom: 1rem;
    opacity: 0.6;
}

/* Team Members Section */
.team-members-section {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: var(--shadow-medium);
}

.members-header {
    text-align: center;
    margin-bottom: 2rem;
}

.members-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.members-divider {
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
    margin: 0 auto;
    border-radius: 2px;
}

.team-members-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin: 0 -1rem;
}

.member-wrapper {
    transition: var(--transition);
}

.member-card-inner {
    background: var(--beige-light);
    border-radius: 15px;
    padding: 2rem 1.5rem;
    text-align: center;
    transition: var(--transition);
    border: 2px solid transparent;
    height: 100%;
    min-height: 350px;
    aspect-ratio: 3/4;
    position: relative;
    transform-style: preserve-3d;
}

.member-wrapper:hover .member-card-inner {
    transform: translateY(-8px) translateZ(20px) scale(1.05);
    box-shadow: 0 20px 40px rgba(1, 109, 71, 0.2);
    background: white;
    border-color: var(--accent-color);
    z-index: 10;
}

.member-card-inner .member-image-container {
    width: 140px;
    height: 200px;
    margin: 0 auto 1.5rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-light);
}

.member-card-inner .member-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.3rem;
}

.member-card-inner .member-role {
    font-size: 0.85rem;
    color: var(--accent-color);
    margin: 0;
}

/* Quotes Section */
.quotes-section {
    padding: 80px 0;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
    position: relative;
    overflow: hidden;
}

.quotes-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
    pointer-events: none;
}

.quotes-header {
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.quotes-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.quotes-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--beige-light), #FFD700);
    margin: 0 auto;
    border-radius: 2px;
}

.quotes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    position: relative;
    z-index: 2;
}

.quote-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius);
    padding: 2.5rem;
    text-align: center;
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.quote-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.8s ease;
}

.quote-card:hover::before {
    left: 100%;
}

.quote-card:hover {
    transform: translateY(-8px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.quote-icon {
    color: var(--beige-light);
    margin-bottom: 1.5rem;
    opacity: 0.9;
}

.quote-text {
    font-size: 1.3rem;
    color: white;
    font-style: italic;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-weight: 300;
}

.quote-author {
    font-size: 1rem;
    color: var(--beige-light);
    font-weight: 600;
    opacity: 0.9;
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

/* Responsive Design */
@media (max-width: 1200px) {
    .all-members-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    
    .team-members-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .leadership-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .teams-nav {
        flex-direction: column;
    }
    
    .team-nav-btn {
        justify-content: center;
        text-align: center;
    }
    
    .nav-text {
        text-align: center;
    }
    
    .all-members-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .team-members-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .leadership-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .leadership-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .all-members-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .member-card-enhanced .member-image-container {
        height: 400px;
    }
    
    .team-members-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin: 0;
    }
    
    .team-info-card,
    .team-members-section {
        padding: 1.5rem;
    }
    
    .quotes-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .leadership-section,
    .teams-section,
    .quotes-section {
        padding: 60px 0;
    }
}

@media (max-width: 480px) {
    .all-members-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
        gap: 2rem;
    }
    
    .team-members-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .member-card-enhanced .member-image-container {
        height: 320px;
    }
    
    .quote-card {
        padding: 1.5rem;
    }
    
    .quotes-title {
        font-size: 2rem;
    }
    
    .member-info {
        padding: 1.5rem 1rem;
    }
    
    .card-content {
        padding: 2rem 1.5rem;
    }
}
</style>

<!-- Add AOS library for animations -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
jQuery(document).ready(function($) {
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 50
    });
    
    // Tab navigation
    const $navButtons = $('.team-nav-btn');
    const $teamContents = $('.team-content');
    
    $navButtons.on('click', function() {
        const targetTeam = $(this).data('team');
        
        $navButtons.removeClass('active');
        $teamContents.removeClass('active');
        
        $(this).addClass('active');
        $(`.team-content[data-team="${targetTeam}"]`).addClass('active');
        
        // Add stagger animation to visible members
        setTimeout(function() {
            const $visibleCards = $(`.team-content[data-team="${targetTeam}"]`).find('.member-card-enhanced, .member-wrapper');
            $visibleCards.each(function(index) {
                $(this).css('animation-delay', (index * 100) + 'ms');
                $(this).addClass('fade-in');
            });
        }, 100);
    });
    
    // Enhanced hover effects with z-index management
    $('.member-card-enhanced').on('mouseenter', function() {
        $(this).css('z-index', '20');
        $(this).find('.member-image-square').css('transform', 'scale(1.05) rotate(1deg)');
        $(this).find('.team-badge').css('transform', 'scale(1.1) rotate(-2deg)');
    }).on('mouseleave', function() {
        $(this).css('z-index', '1');
        $(this).find('.member-image-square').css('transform', 'scale(1) rotate(0deg)');
        $(this).find('.team-badge').css('transform', 'scale(1) rotate(0deg)');
    });
    
    // Leadership cards enhanced effects
    $('.leadership-card').on('mouseenter', function() {
        $(this).css('z-index', '20');
        $(this).find('.member-image-square').css('transform', 'scale(1.08) rotate(-1deg)');
    }).on('mouseleave', function() {
        $(this).css('z-index', '1');
        $(this).find('.member-image-square').css('transform', 'scale(1) rotate(0deg)');
    });
    
    // Team member cards with overlap effect
    $('.member-wrapper').on('mouseenter', function() {
        $(this).css('z-index', '30');
    }).on('mouseleave', function() {
        $(this).css('z-index', '1');
    });
    
    // Parallax effect for quotes section
    $(window).on('scroll', function() {
        const scrolled = $(this).scrollTop();
        const $quotesSection = $('.quotes-section');
        if ($quotesSection.length) {
            const offset = $quotesSection.offset().top;
            const windowHeight = $(window).height();
            
            if (scrolled + windowHeight > offset && scrolled < offset + $quotesSection.outerHeight()) {
                const parallax = (scrolled - offset + windowHeight) * 0.1;
                $quotesSection.css('background-position', `center ${parallax}px`);
            }
        }
    });
    
    // Add loading animation delay
    $('.member-card-enhanced, .leadership-card, .quote-card').each(function(index) {
        $(this).css('animation-delay', (index * 150) + 'ms');
    });
});
</script>

<?php get_footer(); ?>