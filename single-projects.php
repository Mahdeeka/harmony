<?php 
// Function to convert line breaks to bullet points (from person detail page)
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
    
    return '<ul class="bio-list" style="margin: 0; padding-right: 20px; list-style-type: disc;">' . implode('', $formatted_lines) . '</ul>';
}

get_header(); ?>

<!-- Modern Hero Section -->
<div class="modern-hero-section">
    <div class="hero-background">
        <div class="container">
            <div class="row align-items-center min-vh-70">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <!-- Project Icon -->
                        <?php $icon = get_field('project_icon');
                        if ($icon) { ?>
                            <div class="project-icon-hero">
                                <img src="<?php echo $icon; ?>" alt="Project Icon">
                                <div class="icon-glow"></div>
                            </div>
                        <?php } ?>
                        
                        <!-- Project Title -->
                        <h1 class="hero-title">
                            <span class="title-gradient"><?php the_title(); ?></span>
                        </h1>
                        
                        <!-- Project Description -->
                        <div class="hero-description">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- Animated Project Quotes -->
                        <div class="animated-quotes">
                            <div class="quote-container">
                                <div class="quote active" data-quote="0">
                                    "تخيّل نفسك واقف بمكان ضخم، مليان ناس من كل المجالات... بس التواصل الحقيقي مش موجود"
                                </div>
                                <div class="quote" data-quote="1">
                                    "من هون اجت هارموني... عشان تخلق روابط حقيقية، روابط بتفتح أبواب لفرص جديدة"
                                </div>
                                <div class="quote" data-quote="2">
                                    "نطمح إلى ربط المهنيين العرب وبناء مجتمع مهني متكامل يدفع عجلة الابتكار والتقدم"
                                </div>
                                <div class="quote" data-quote="3">
                                    "من خلال بناء شبكة قوية من العلاقات المهنية، نسعى إلى إحداث تأثير مستدام"
                                </div>
                            </div>
                            <div class="quote-dots">
                                <span class="quote-dot active" onclick="showQuote(0)"></span>
                                <span class="quote-dot" onclick="showQuote(1)"></span>
                                <span class="quote-dot" onclick="showQuote(2)"></span>
                                <span class="quote-dot" onclick="showQuote(3)"></span>
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <?php $link = get_field('join_link');
                        if ($link) { ?>
                            <div class="hero-cta">
                                <a href="<?php echo $link['url']; ?>" class="modern-btn">
                                    <span class="btn-text"><?php echo $link['title']; ?></span>
                                    <div class="btn-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="hero-image-container">
                        <?php 
                        // Get random images from all events for slideshow
                        $slideshow_images = [];
                        $events = get_field('events');
                        
                        if ($events) {
                            // Collect all images from all events
                            $all_images = [];
                            foreach ($events as $event) {
                                $gallery = get_field('gallery', $event->ID);
                                if ($gallery && is_array($gallery)) {
                                    foreach ($gallery as $img) {
                                        if (!empty($img['url'])) {
                                            $all_images[] = $img;
                                        }
                                    }
                                }
                            }
                            
                            // Shuffle and take up to 10 images
                            if (!empty($all_images)) {
                                shuffle($all_images);
                                $slideshow_images = array_slice($all_images, 0, 10);
                            }
                        }
                        
                        // Fallback to featured image if no gallery images found
                        if (empty($slideshow_images) && has_post_thumbnail()) {
                            $slideshow_images[] = [
                                'url' => get_the_post_thumbnail_url(null, 'full'),
                                'title' => get_field('volunteers_image_title') ?: get_the_title()
                            ];
                        }
                        
                        if (!empty($slideshow_images)) { ?>
                            <div class="hero-slideshow">
                                <div class="slideshow-container" id="slideshowContainer">
                                    <?php foreach ($slideshow_images as $index => $img) { ?>
                                        <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                                            <img src="<?php echo esc_url($img['url']); ?>" 
                                                 alt="<?php echo esc_attr($img['title'] ?? 'Project Image'); ?>"
                                                 loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                                            <div class="image-overlay"></div>
                                        </div>
                                    <?php } ?>
                                    
                                    <!-- Navigation Arrows -->
                                    <?php if (count($slideshow_images) > 1) { ?>
                                        <button class="slide-nav prev" onclick="changeSlide(-1)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="slide-nav next" onclick="changeSlide(1)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    <?php } ?>
                                </div>
                                
                                <div class="image-border"></div>
                            </div>
                            
                            <?php if (get_field('volunteers_image_title')) { ?>
                                <div class="image-caption">
                                    <div class="caption-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M9 11H15M9 15H15M17 21L12 16L7 21V5C7 3.89 7.89 3 9 3H15C16.11 3 17 3.89 17 5V21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <?php echo get_field('volunteers_image_title'); ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $events = get_field('events');
if ($events) { ?>
    <!-- Events Section -->
    <div class="modern-events-section">
        <!-- 10 Fixed Floating Quotes from Sides -->
        <div class="floating-quote" style="position: absolute; top: 8%; right: 3%; animation: floatUp 6s ease-in-out infinite; animation-delay: -0.5s;">
            "نطمح إلى ربط المهنيين العرب من مختلف أنحاء العالم وبناء مجتمع مهني متكامل"
        </div>
        
        <div class="floating-quote" style="position: absolute; bottom: 12%; left: 2%; animation: floatDown 8s ease-in-out infinite; animation-delay: -1s;">
            "من خلال بناء شبكة قوية من العلاقات المهنية، نسعى إلى تقليص فجوة المعرفة والفرص"
        </div>
        
        <div class="floating-quote" style="position: absolute; top: 25%; left: 4%; animation: floatSide 7s ease-in-out infinite; animation-delay: -1.5s;">
            "التواصل الحقيقي يبدأ بجسر الثقة بين القلوب قبل العقول"
        </div>
        
        <div class="floating-quote" style="position: absolute; top: 45%; right: 1%; animation: floatUp 9s ease-in-out infinite; animation-delay: -2s;">
            "كل مشروع ناجح يحتاج إلى شبكة علاقات قوية تدعمه وترفعه للقمة"
        </div>
        
        <div class="floating-quote" style="position: absolute; bottom: 35%; right: 8%; animation: floatDown 6s ease-in-out infinite; animation-delay: -2.5s;">
            "الابتكار لا ينمو في العزلة، بل في بيئة التفاعل والتعاون"
        </div>
        
        <div class="floating-quote" style="position: absolute; top: 60%; left: 1%; animation: floatSide 8s ease-in-out infinite; animation-delay: -3s;">
            "النجاح المستدام يُبنى على أساس من الشراكات الاستراتيجية المتينة"
        </div>
        
        <div class="floating-quote" style="position: absolute; bottom: 50%; left: 6%; animation: floatUp 7s ease-in-out infinite; animation-delay: -3.5s;">
            "المستقبل للمجتمعات التي تؤمن بقوة التشبيك والتكامل المهني"
        </div>
        
        <div class="floating-quote" style="position: absolute; top: 35%; right: 5%; animation: floatDown 8s ease-in-out infinite; animation-delay: -4s;">
            "الشبكات المهنية القوية هي البوابة الذهبية للنجاح المستدام"
        </div>
        
        <div class="floating-quote" style="position: absolute; bottom: 20%; right: 12%; animation: floatSide 6s ease-in-out infinite; animation-delay: -4.5s;">
            "العلاقات المهنية الحقيقية تُبنى على التبادل المعرفي والدعم المتبادل"
        </div>
        
        <div class="floating-quote" style="position: absolute; top: 15%; left: 8%; animation: floatUp 9s ease-in-out infinite; animation-delay: -5s;">
            "في عالم اليوم، التشبيك المهني ليس رفاهية بل ضرورة للنجاح والتميز"
        </div>
        
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="title-accent"><?php echo get_field('events_t') ?: 'الفعاليات'; ?></span>
                </h2>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <div class="divider-dot"></div>
                </div>
                <div class="section-subtitle">اكتشف برامجنا وفعالياتنا المميزة التي تبني جسور التواصل</div>
            </div>
            
            <!-- Event Navigation -->
            <div class="event-navigation">
                <?php foreach ($events as $index => $event) { ?>
                    <div class="event-nav-item <?php echo ($index == count($events) - 1) ? 'active' : ''; ?>" 
                         data-event="<?php echo $index; ?>">
                        <div class="nav-content">
                            <div class="nav-badge"><?php echo $index + 1; ?></div>
                            <h4 class="nav-title"><?php echo $event->post_title; ?></h4>
                            <div class="nav-meta">
                                <?php 
                                $date = get_field('date', $event->ID);
                                $location = get_field('location', $event->ID);
                                ?>
                                <?php if ($date) { ?>
                                    <span class="nav-date">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                            <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                                            <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                                            <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <?php echo $date; ?>
                                    </span>
                                <?php } ?>
                                <?php if ($location) { ?>
                                    <span class="nav-location">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61 4.79 5.39 7.05 4.47C8.18 4 9.82 4 12 4C14.18 4 15.82 4 16.95 4.47C19.21 5.39 21 7.61 21 10Z" stroke="currentColor" stroke-width="2"/>
                                            <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <?php echo $location; ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="nav-glow"></div>
                    </div>
                <?php } ?>
            </div>
            
            <!-- Event Content -->
            <div class="event-content-container">
                <?php foreach ($events as $eventIndex => $event) { ?>
                    <div class="event-content <?php if ($eventIndex == count($events) - 1) echo 'active'; ?>" 
                         data-event="<?php echo $eventIndex; ?>">
                        
                        <!-- Event Includes (Enhanced) -->
                        <?php $includes = get_field('includes', $event->ID);
                        if ($includes) { ?>
                            <div class="event-includes">
                                <h3 class="content-title">
                                    <span class="title-icon">
                                        <?php 
                                        // Method 1: Direct URL (paste your uploaded image URL here)
                                        $finjan_icon_url = 'https://yoursite.com/wp-content/uploads/finjan-icon.png'; // REPLACE WITH YOUR IMAGE URL
                                        
                                        // Method 2: Auto-detect from uploads folder  
                                        $auto_finjan_url = wp_upload_dir()['baseurl'] . '/finjan-icon.png';
                                        
                                        // Use Method 1 if you have direct URL, otherwise Method 2
                                        $finjan_display_url = $finjan_icon_url;
                                        ?>
                                        <img src="<?php echo $finjan_display_url; ?>" alt="فنجان" class="finjan-icon" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                                        <!-- Fallback SVG if image not found -->
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" class="finjan-icon" style="display: none;">
                                            <path d="M2 21V19C2 17.9 2.9 17 4 17H16C17.1 17 18 17.9 18 19V21" stroke="currentColor" stroke-width="2"/>
                                            <path d="M4 17V13C4 8.6 7.6 5 12 5H16C18.2 5 20 6.8 20 9C20 11.2 18.2 13 16 13H15" stroke="currentColor" stroke-width="2"/>
                                            <path d="M6 2C6 2 8 4 12 4C16 4 18 2 18 2" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                    ما يشمله البرنامج
                                </h3>
                                <div class="includes-grid">
                                    <?php foreach ($includes as $index => $include) { ?>
                                        <div class="include-card enhanced" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                            <div class="card-icon">
                                                <?php 
                                                // Use same URL as above for consistency
                                                $finjan_icon_url = 'https://yoursite.com/wp-content/uploads/finjan-icon.png'; // REPLACE WITH YOUR IMAGE URL
                                                $auto_finjan_url = wp_upload_dir()['baseurl'] . '/finjan-icon.png';
                                                $finjan_display_url = $finjan_icon_url;
                                                ?>
                                                <img src="<?php echo $finjan_display_url; ?>" alt="فنجان" class="finjan-icon-small" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                                                <!-- Fallback SVG if image not found -->
                                                <svg width="35" height="35" viewBox="0 0 24 24" fill="none" class="finjan-icon-small" style="display: none;">
                                                    <path d="M2 21V19C2 17.9 2.9 17 4 17H16C17.1 17 18 17.9 18 19V21" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M4 17V13C4 8.6 7.6 5 12 5H16C18.2 5 20 6.8 20 9C20 11.2 18.2 13 16 13H15" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M6 2C6 2 8 4 12 4C16 4 18 2 18 2" stroke="currentColor" stroke-width="2"/>
                                                </svg>
                                            </div>
                                            <h4 class="card-title"><?php echo $include['title']; ?></h4>
                                            <div class="card-description-preview">
                                                <?php echo wp_trim_words($include['desc'], 25, '...'); ?>
                                            </div>
                                            <button class="show-more-btn" 
                                                    data-title="<?php echo esc_attr($include['title']); ?>"
                                                    data-content="<?php echo esc_attr($include['desc']); ?>">
                                                <span>اظهر المزيد</span>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                    <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                            <div class="card-shimmer"></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- Compact Schedule Section -->
                        <?php $schedule = get_field('schedule', $event->ID);
                        if ($schedule) { ?>
                            <div class="compact-schedule-section">
                                <h3 class="content-title">
                                    <span class="title-icon">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                            <polyline points="12,6 12,12 16,14" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                    <?php echo get_field('schedule_t', $event->ID) ?: 'البرنامج الزمني'; ?>
                                </h3>
                                
                                <div class="compact-timeline">
                                    <?php foreach ($schedule as $index => $item) { ?>
                                        <div class="compact-timeline-item" data-aos="fade-left" data-aos-delay="<?php echo $index * 100; ?>">
                                            <div class="timeline-header" onclick="toggleScheduleItem(<?php echo $eventIndex; ?>, <?php echo $index; ?>)">
                                                <div class="timeline-time-compact">
                                                    <span class="time-text"><?php echo $item['time']; ?></span>
                                                </div>
                                                <div class="timeline-title-compact">
                                                    <h5 class="schedule-title" id="schedule-title-<?php echo $eventIndex; ?>-<?php echo $index; ?>"><?php echo $item['title']; ?></h5>
                                                    <div class="schedule-description" id="schedule-description-<?php echo $eventIndex; ?>-<?php echo $index; ?>" style="display: none;">
                                                        <?php echo $item['desc']; ?>
                                                    </div>
                                                </div>
                                                <div class="timeline-toggle" id="toggle-<?php echo $eventIndex; ?>-<?php echo $index; ?>">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- Speakers Section with Facilitator -->
                        <?php 
                        $guest1 = get_field('guest_name', $event->ID);
                        $facilitator = get_field('facilitator', $event->ID); // New facilitator field
                        if ($guest1) { ?>
                            <div class="speakers-section">
                                <h3 class="content-title">
                                    <span class="title-icon">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <path d="M20 21V19C20 16.79 18.21 15 16 15H8C5.79 15 4 16.79 4 19V21M16 7C16 9.21 14.21 11 12 11C9.79 11 8 9.21 8 7C8 4.79 9.79 3 12 3C14.21 3 16 4.79 16 7Z" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                    <?php echo get_field('guests_title', $event->ID) ?: 'المتحدثون'; ?>
                                </h3>
                                
                                <div class="speakers-grid">
                                    <div class="speaker-card modern" data-aos="zoom-in">
                                        <?php $img = get_field('guest_image', $event->ID);
                                        if ($img) { ?>
                                            <div class="speaker-image-square">
                                                <img src="<?php echo $img['url']; ?>" alt="<?php echo get_field('guest_name', $event->ID); ?>">
                                                <div class="image-overlay-speaker"></div>
                                            </div>
                                        <?php } ?>
                                        <div class="speaker-info">
                                            <h4 class="speaker-name"><?php echo get_field('guest_name', $event->ID); ?></h4>
                                            <p class="speaker-role"><?php echo get_field('guest_role', $event->ID); ?></p>
                                            <div class="speaker-badge guest-badge">حوار الفنجان</div>
                                        </div>
                                    </div>
                                    
                                    <?php if ($facilitator) { ?>
                                        <div class="speaker-card modern" data-aos="zoom-in" data-aos-delay="200">
                                            <?php 
                                            $facilitator_image = get_field('image', $facilitator->ID);
                                            if ($facilitator_image) { ?>
                                                <div class="speaker-image-square">
                                                    <img src="<?php echo $facilitator_image['url']; ?>" alt="<?php echo $facilitator->post_title; ?>">
                                                    <div class="image-overlay-speaker"></div>
                                                </div>
                                            <?php } ?>
                                            <div class="speaker-info">
                                                <h4 class="speaker-name"><?php echo $facilitator->post_title; ?></h4>
                                                <p class="speaker-role"><?php echo get_field('role', $facilitator->ID) ?: get_field('field_job_title', $facilitator->ID); ?></p>
                                                <div class="speaker-badge facilitator-badge">محاور</div>
                                            </div>
                                        </div>
                                    <?php } elseif (get_field('guest_image2', $event->ID)) { ?>
                                        <!-- Fallback to old system if facilitator not set -->
                                        <div class="speaker-card modern" data-aos="zoom-in" data-aos-delay="200">
                                            <?php $img2 = get_field('guest_image2', $event->ID); ?>
                                            <div class="speaker-image-square">
                                                <img src="<?php echo $img2['url']; ?>" alt="<?php echo get_field('guest_name2', $event->ID); ?>">
                                                <div class="image-overlay-speaker"></div>
                                            </div>
                                            <div class="speaker-info">
                                                <h4 class="speaker-name"><?php echo get_field('guest_name2', $event->ID); ?></h4>
                                                <p class="speaker-role"><?php echo get_field('guest_role2', $event->ID); ?></p>
                                                <div class="speaker-badge facilitator-badge">محاور</div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- Second Speaker Set -->
                        <?php $guest2_1 = get_field('guest2_name', $event->ID);
                        if ($guest2_1) { ?>
                            <div class="speakers-section secondary-speakers">
                                <div class="speakers-grid">
                                    <div class="speaker-card modern" data-aos="zoom-in">
                                        <?php $img = get_field('guest2_image', $event->ID);
                                        if ($img) { ?>
                                            <div class="speaker-image-square">
                                                <img src="<?php echo $img['url']; ?>" alt="<?php echo get_field('guest2_name', $event->ID); ?>">
                                                <div class="image-overlay-speaker"></div>
                                            </div>
                                        <?php } ?>
                                        <div class="speaker-info">
                                            <h4 class="speaker-name"><?php echo get_field('guest2_name', $event->ID); ?></h4>
                                            <p class="speaker-role"><?php echo get_field('guest2_role', $event->ID); ?></p>
                                        </div>
                                    </div>
                                    
                                    <?php $img2_2 = get_field('guest2_image2', $event->ID);
                                    if ($img2_2) { ?>
                                        <div class="speaker-card modern" data-aos="zoom-in" data-aos-delay="200">
                                            <div class="speaker-image-square">
                                                <img src="<?php echo $img2_2['url']; ?>" alt="<?php echo get_field('guest2_name2', $event->ID); ?>">
                                                <div class="image-overlay-speaker"></div>
                                            </div>
                                            <div class="speaker-info">
                                                <h4 class="speaker-name"><?php echo get_field('guest2_name2', $event->ID); ?></h4>
                                                <p class="speaker-role"><?php echo get_field('guest2_role2', $event->ID); ?></p>
                                                <div class="speaker-badge">محاور</div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- Panel Section -->
                        <?php $people = get_field('people', $event->ID);
                        if ($people) { ?>
                            <div class="panel-section">
                                <h3 class="content-title">
                                    <span class="title-icon">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <path d="M17 21V19C17 15.134 13.866 12 10 12H4C4 8.134 7.134 5 11 5S18 8.134 18 12V21H17ZM12 3C7.029 3 3 7.029 3 12H1C1 5.925 5.925 1 12 1S23 5.925 23 12H21C21 7.029 16.971 3 12 3Z" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                    <?php echo get_field('panel_t', $event->ID) ?: 'اللجنة'; ?>
                                </h3>
                                <?php if (get_field('panel_description', $event->ID)) { ?>
                                    <div class="panel-description">
                                        <?php echo get_field('panel_description', $event->ID); ?>
                                    </div>
                                <?php } ?>
                                
                                <div class="panel-grid">
                                    <?php foreach ($people as $index => $person) { ?>
                                        <div class="panel-member" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                            <div class="member-image-square">
                                                <img src="<?php echo $person['image']['url']; ?>" alt="<?php echo $person['full_name']; ?>">
                                                <div class="image-overlay-member"></div>
                                            </div>
                                            <div class="member-info">
                                                <h4 class="member-name"><?php echo $person['full_name']; ?></h4>
                                                <p class="member-desc"><?php echo $person['desc']; ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- Gallery Section -->
                        <?php $gallery = get_field('gallery', $event->ID);
                        if ($gallery) { ?>
                            <div class="gallery-section">
                                <h3 class="content-title">
                                    <span class="title-icon">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                                            <polyline points="21,15 16,10 5,21" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                    معرض الصور
                                </h3>
                                <div class="modern-gallery">
                                    <?php foreach ($gallery as $index => $img) { ?>
                                        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="<?php echo $index * 50; ?>">
                                            <div class="gallery-link" onclick="openImageModal('<?php echo esc_url($img['url']); ?>', '<?php echo esc_attr($img['title'] ?? 'صورة من المعرض'); ?>')">
                                                <img src="<?php echo $img['sizes']['medium'] ?: $img['url']; ?>" alt="Gallery Image">
                                                <div class="gallery-overlay">
                                                    <div class="overlay-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M15 3H6A3 3 0 0 0 3 6V15M9 21H18A3 3 0 0 0 21 18V9M15 3L21 9M15 3V9H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- Attendees Section -->
                        <?php 
                        $attendees = get_field('attendees', $event->ID);
                        $professional_attendees = get_field('attendees_2', $event->ID);
                        if ($attendees || $professional_attendees) { ?>
                            <div class="attendees-section">
                                <h3 class="content-title">
                                    <span class="title-icon">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <path d="M17 21V19C17 15.134 13.866 12 10 12H4C4 8.134 7.134 5 11 5S18 8.134 18 12V21H17Z" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                    الحضور
                                </h3>
                                
                                <!-- Modern Search Interface -->
                                <div class="modern-search-container">
                                    <div class="search-wrapper">
                                        <div class="search-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <input type="text" id="attendeeSearch" class="modern-search-input" placeholder="ابحث عن الحضور...">
                                    </div>
                                    
                                    <!-- Filter Buttons -->
                                    <div class="filter-tabs">
                                        <button class="filter-tab active" data-filter="all">الكل</button>
                                        <?php if ($attendees) { ?>
                                            <button class="filter-tab" data-filter="general">
                                                <?php echo get_field('attendees_t', $event->ID) ?: 'الحضور العام'; ?>
                                            </button>
                                        <?php } ?>
                                        <?php if ($professional_attendees) { ?>
                                            <button class="filter-tab" data-filter="professional">
                                                <?php echo get_field('attendees_2_t', $event->ID) ?: 'الحضور المهني'; ?>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <!-- Attendees Grid -->
                                <div class="attendees-grid" id="attendeesGrid">
                                    <?php if ($attendees) {
                                        foreach ($attendees as $index => $attendee) {
                                            $role = get_field('role', $attendee->ID) ?: get_field('field_job_title', $attendee->ID);
                                            $company = get_field('company', $attendee->ID) ?: get_field('field_university', $attendee->ID);
                                            ?>
                                            <div class="attendee-card general-attendee employee-box" 
                                                 data-aos="fade-up" 
                                                 data-aos-delay="<?php echo ($index % 20) * 50; ?>"
                                                 data-name="<?php echo esc_attr(strtolower($attendee->post_title)); ?>"
                                                 data-role="<?php echo esc_attr(strtolower($role)); ?>"
                                                 data-company="<?php echo esc_attr(strtolower($company)); ?>">
                                                <?php echo get_template_part('parts/emp', null, array('emp' => $attendee)); ?>
                                            </div>
                                        <?php }
                                    } ?>
                                    
                                    <?php if ($professional_attendees) {
                                        foreach ($professional_attendees as $index => $attendee) {
                                            $role = get_field('role', $attendee->ID) ?: get_field('field_job_title', $attendee->ID);
                                            $company = get_field('company', $attendee->ID) ?: get_field('field_university', $attendee->ID);
                                            ?>
                                            <div class="attendee-card professional-attendee employee-box" 
                                                 data-aos="fade-up" 
                                                 data-aos-delay="<?php echo ($index % 20) * 50; ?>"
                                                 data-name="<?php echo esc_attr(strtolower($attendee->post_title)); ?>"
                                                 data-role="<?php echo esc_attr(strtolower($role)); ?>"
                                                 data-company="<?php echo esc_attr(strtolower($company)); ?>">
                                                <?php echo get_template_part('parts/emp', null, array('emp' => $attendee)); ?>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                                
                                <!-- No Results -->
                                <div class="no-results" id="noResults" style="display: none;">
                                    <div class="no-results-icon">
                                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <h4>لم يتم العثور على نتائج</h4>
                                    <p>جرب البحث بكلمات أخرى</p>
                                </div>
                            </div>
                            
                            <!-- Attendees Note (if enabled) -->
                            <?php $show_note = get_field('show_attendees_note', $event->ID);
                            if ($show_note) { ?>
                                <div class="attendees-note">
                                    <div class="note-icon">📋</div>
                                    <div class="note-content">
                                        <h5>ملاحظة مهمة</h5>
                                        <p>هذه ليست القائمة النهائية للمشتركين. نقوم بإضافة المزيد من المشتركين قريباً.</p>
                                        <strong>تابع الصفحة للاطلاع على التحديثات الجديدة!</strong>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        
                        <!-- Google Drive Gallery -->
                        <?php 
                        $google_drive_link = get_field('google_drive_gallery', $event->ID);
                        if ($google_drive_link) { 
                            $folder_id = '';
                            if (preg_match('/folders\/([a-zA-Z0-9_-]+)/', $google_drive_link, $matches)) {
                                $folder_id = $matches[1];
                            }
                            
                            if ($folder_id) { ?>
                                <div class="drive-gallery-section">
                                    <h3 class="content-title">
                                        <span class="title-icon">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                                <path d="M14 2H6C4.89 2 4 2.89 4 4V20C4 21.11 4.89 22 6 22H18C19.11 22 20 21.11 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                                                <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                        </span>
                                        <?php echo get_field('drive_gallery_title', $event->ID) ?: 'صور الفعالية'; ?>
                                    </h3>
                                    <div class="thank-you-message">
                                        <h4>شكراً كثيراً لكل الذين شاركونا بالبرنامج - معاً نبني مستقبلاً أفضل</h4>
                                    </div>
                                    <div class="drive-gallery-container">
                                        <iframe src="https://drive.google.com/embeddedfolderview?id=<?php echo esc_attr($folder_id); ?>#grid" 
                                                width="100%" height="500" frameborder="0" scrolling="yes"></iframe>
                                    </div>
                                </div>
                            <?php } 
                        } ?>
                        
                        <!-- NEW: Event Slideshow Button - ADDED AT END OF EACH EVENT -->
                        <div class="event-slideshow-section">
                            <div class="slideshow-cta-container">
                                <h3 class="slideshow-section-title">
                                    <span class="title-icon">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <rect x="3" y="4" width="18" height="12" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                            <line x1="2" y1="20" x2="22" y2="20" stroke="currentColor" stroke-width="2"/>
                                            <line x1="12" y1="16" x2="12" y2="20" stroke="currentColor" stroke-width="2"/>
                                            <polygon points="5,8 8,12 12,8 16,12 19,8" stroke="currentColor" stroke-width="2" fill="none"/>
                                        </svg>
                                    </span>
                                    عرض تفاصيل المشاركين
                                </h3>
                                <div class="slideshow-description">
                                    اعرض تفاصيل جميع المشاركين في هذه الفعالية مع السيرة الذاتية الكاملة
                                </div>
                                <button onclick="startEventSlideshow(<?php echo $eventIndex; ?>)" 
                                        class="event-slideshow-btn" 
                                        data-event="<?php echo $eventIndex; ?>">
                                    <span class="btn-text">عرض مشاركي الفعالية</span>
                                    <div class="btn-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                            <rect x="3" y="4" width="18" height="12" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                            <line x1="2" y1="20" x2="22" y2="20" stroke="currentColor" stroke-width="2"/>
                                            <line x1="12" y1="16" x2="12" y2="20" stroke="currentColor" stroke-width="2"/>
                                            <polygon points="5,8 8,12 12,8 16,12 19,8" stroke="currentColor" stroke-width="2" fill="none"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Enhanced Dual Participant Conference Slideshow Modal -->
<div class="conference-slideshow-modal" id="conferenceSlideshowModal">
    <div class="slideshow-backdrop" onclick="closeConferenceSlideshow()"></div>
    <div class="conference-slideshow-container">
        <!-- Enhanced Header Controls -->
        <div class="slideshow-header">
            <div class="slideshow-title">
                <h2 id="slideshowEventTitle">مشاركو الفعالية</h2>
                <div class="participants-counter">
                    <span id="currentParticipant">1</span> / <span id="totalParticipants">0</span>
                </div>
            </div>
            <div class="slideshow-controls">
                <button class="control-btn" id="playPauseBtn" onclick="toggleSlideshow()">
                    <svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="5,3 19,12 5,21" stroke="currentColor" stroke-width="2" fill="currentColor"/>
                    </svg>
                    <svg class="pause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display: none;">
                        <rect x="6" y="4" width="4" height="16" stroke="currentColor" stroke-width="2" fill="currentColor"/>
                        <rect x="14" y="4" width="4" height="16" stroke="currentColor" stroke-width="2" fill="currentColor"/>
                    </svg>
                </button>
                <button class="control-btn" onclick="previousParticipant()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="control-btn" onclick="nextParticipant()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- NEW: Fullscreen Button -->
                <button class="control-btn" id="fullscreenBtn" onclick="toggleFullscreen()">
                    <svg class="fullscreen-open" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8 3H5C3.89 3 3 3.89 3 5V8M21 8V5C21 3.89 20.11 3 19 3H16M8 21H5C3.89 21 3 20.11 3 19V16M21 16V19C21 20.11 20.11 21 19 21H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg class="fullscreen-exit" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display: none;">
                        <path d="M8 3V5C8 6.11 8.89 7 10 7H13M16 3V5C16 6.11 15.11 7 14 7H11M8 21V19C8 17.89 8.89 17 10 17H13M16 21V19C16 17.89 15.11 17 14 17H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="control-btn close-btn" onclick="closeConferenceSlideshow()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="slideshow-progress">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        
        <!-- NEW: Networking Quotes Banner -->
        <div class="networking-quotes-banner">
            <div class="quote-animation-container">
                <div class="networking-quote active" data-quote="0">
                    "التشبيك المهني هو الجسر الذي يربط بين الأحلام والواقع"
                </div>
                <div class="networking-quote" data-quote="1">
                    "في كل لقاء جديد، فرصة لبناء شراكة تغير مسار المستقبل"
                </div>
                <div class="networking-quote" data-quote="2">
                    "الشبكات المهنية القوية تحول الأفكار إلى مشاريع ناجحة"
                </div>
                <div class="networking-quote" data-quote="3">
                    "التعارف اليوم يعني التعاون غداً والنجاح المشترك في المستقبل"
                </div>
                <div class="networking-quote" data-quote="4">
                    "كل محادثة هي بذرة لعلاقة مهنية قد تثمر نجاحاً عظيماً"
                </div>
                <div class="networking-quote" data-quote="5">
                    "الناس الناجحون لا يبنون مشاريع فقط، بل يبنون علاقات تدوم"
                </div>
                <div class="networking-quote" data-quote="6">
                    "التشبيك ليس عن عدد الأشخاص الذين تعرفهم، بل عن عمق العلاقات التي تبنيها"
                </div>
                <div class="networking-quote" data-quote="7">
                    "في عالم الأعمال، علاقاتك هي أقوى عملة تملكها"
                </div>
                <div class="networking-quote" data-quote="8">
                    "التشبيك المهني يفتح أبواباً لم تكن تعلم بوجودها"
                </div>
                <div class="networking-quote" data-quote="9">
                    "أعظم الفرص تأتي من خلال الأشخاص الذين نلتقي بهم"
                </div>
            </div>
        </div>
        
        <!-- NEW: Enhanced Dual Participant Slideshow Content -->
        <div class="dual-slideshow-content">
            <div class="dual-participant-slide" id="participantSlide">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>
        
        <!-- NEW: Networking Tips Banner -->
        <div class="networking-tips-banner">
            <div class="tips-container">
                <div class="tip-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="networking-tip active" data-tip="0">
                    💡 نصيحة: ابدأ المحادثة بسؤال عن خبرة الشخص في مجاله
                </div>
                <div class="networking-tip" data-tip="1">
                    🤝 نصيحة: شارك خبراتك واطلب النصائح من الآخرين
                </div>
                <div class="networking-tip" data-tip="2">
                    📱 نصيحة: تبادل معلومات التواصل وتابع بعد الفعالية
                </div>
                <div class="networking-tip" data-tip="3">
                    💼 نصيحة: ابحث عن فرص التعاون والشراكات المستقبلية
                </div>
                <div class="networking-tip" data-tip="4">
                    🎯 نصيحة: كن مستمعاً جيداً قبل أن تتحدث عن نفسك
                </div>
            </div>
        </div>
        
        <!-- Category Indicator -->
        <div class="category-indicator" id="categoryIndicator">
            <!-- Will show current category -->
        </div>
    </div>
</div>

<!-- Content Details Modal -->
<div class="content-modal" id="contentModal">
    <div class="modal-backdrop" onclick="closeContentModal()"></div>
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="modalTitle"></h3>
            <button class="modal-close" onclick="closeContentModal()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div id="modalContent"></div>
        </div>
    </div>
</div>

<!-- Image Modal for Gallery -->
<div class="image-modal" id="imageModal">
    <div class="image-modal-backdrop" onclick="closeImageModal()"></div>
    <div class="image-modal-container">
        <button class="image-modal-close" onclick="closeImageModal()">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div class="image-modal-content">
            <img id="modalImage" src="" alt="">
            <div class="image-modal-title" id="imageModalTitle"></div>
        </div>
    </div>
</div>

<!-- Hidden data for participants -->
<div style="display: none;" id="participantsData">
    <?php
    // Create event-specific participant data
    $events_participants = [];
    
    if ($events) {
        foreach ($events as $eventIndex => $event) {
            $event_participants = [];
            
            // Main speakers
            $guest1 = get_field('guest_name', $event->ID);
            if ($guest1) {
                $guest_img = get_field('guest_image', $event->ID);
                $event_participants[] = [
                    'name' => $guest1,
                    'role' => get_field('guest_role', $event->ID),
                    'image' => $guest_img ? $guest_img['url'] : '',
                    'category' => 'متحدث رئيسي',
                    'event' => $event->post_title,
                    'bio' => [], // Speakers don't have detailed bio in ACF
                    'quote' => ''
                ];
            }
            
            // Facilitator
            $facilitator = get_field('facilitator', $event->ID);
            if ($facilitator) {
                $facilitator_image = get_field('image', $facilitator->ID);
                $harmony_experience = get_field('harmony_experience', $facilitator->ID) ?: get_field('field_message', $facilitator->ID);
                
                // Get bio data from facilitator
                $bio_data = [];
                $bio_fields = [
                    'field_edu_resume' => 'الخلفية الاكاديمية',
                    'field_pro_resume' => 'السيرة المهنية', 
                    'field_personal_resume' => 'السيرة الذاتية الشخصية',
                    'field_selected_skills' => 'المهارات'
                ];
                
                foreach ($bio_fields as $field_key => $title) {
                    $value = get_field($field_key, $facilitator->ID);
                    if ($value) {
                        if (is_array($value) && $field_key === 'field_selected_skills') {
                            $skill_titles = array_map(function ($post) {
                                return get_the_title($post);
                            }, $value);
                            $content = implode(', ', $skill_titles);
                        } else {
                            $content = $value;
                        }
                        $bio_data[] = ['title' => $title, 'content' => $content];
                    }
                }
                
                $event_participants[] = [
                    'name' => $facilitator->post_title,
                    'role' => get_field('role', $facilitator->ID) ?: get_field('field_job_title', $facilitator->ID),
                    'company' => get_field('company', $facilitator->ID) ?: get_field('field_university', $facilitator->ID),
                    'image' => $facilitator_image ? $facilitator_image['url'] : '',
                    'category' => 'محاور',
                    'event' => $event->post_title,
                    'bio' => $bio_data,
                    'quote' => $harmony_experience,
                    'instagram' => get_field('field_instagram', $facilitator->ID),
                    'linkedin' => get_field('field_linkedin', $facilitator->ID)
                ];
            }
            
            // Panel members
            $people = get_field('people', $event->ID);
            if ($people) {
                foreach ($people as $person) {
                    $event_participants[] = [
                        'name' => $person['full_name'],
                        'role' => $person['desc'],
                        'image' => $person['image']['url'],
                        'category' => 'عضو لجنة',
                        'event' => $event->post_title,
                        'bio' => [],
                        'quote' => ''
                    ];
                }
            }
            
            // General attendees (first 100)
            $attendees = get_field('attendees', $event->ID);
            if ($attendees) {
                $count = 0;
                foreach ($attendees as $attendee) {
                    if ($count >= 200) break;
                    
                    $attendee_image = get_the_post_thumbnail_url($attendee->ID, 'full');
                    $role = get_field('role', $attendee->ID) ?: get_field('field_job_title', $attendee->ID);
                    $company = get_field('company', $attendee->ID) ?: get_field('field_university', $attendee->ID);
                    $harmony_experience = get_field('harmony_experience', $attendee->ID) ?: get_field('field_message', $attendee->ID);
                    
                    // Get bio data
                    $bio_data = [];
                    $bio_fields = [
                        'field_edu_resume' => 'الخلفية الاكاديمية',
                        'field_pro_resume' => 'السيرة المهنية', 
                        'field_personal_resume' => 'السيرة الذاتية الشخصية',
                        'field_selected_skills' => 'المهارات'
                    ];
                    
                    foreach ($bio_fields as $field_key => $title) {
                        $value = get_field($field_key, $attendee->ID);
                        if ($value) {
                            if (is_array($value) && $field_key === 'field_selected_skills') {
                                $skill_titles = array_map(function ($post) {
                                    return get_the_title($post);
                                }, $value);
                                $content = implode(', ', $skill_titles);
                            } else {
                                $content = $value;
                            }
                            $bio_data[] = ['title' => $title, 'content' => $content];
                        }
                    }
                    
                    $event_participants[] = [
                        'name' => $attendee->post_title,
                        'role' => $role,
                        'company' => $company,
                        'image' => $attendee_image,
                        'category' => 'متطوعي هارموني',
                        'event' => $event->post_title,
                        'bio' => $bio_data,
                        'quote' => $harmony_experience,
                        'instagram' => get_field('field_instagram', $attendee->ID),
                        'linkedin' => get_field('field_linkedin', $attendee->ID)
                    ];
                    $count++;
                }
            }
            
            // Professional attendees (first 15)
            $professional_attendees = get_field('attendees_2', $event->ID);
            if ($professional_attendees) {
                $count = 0;
                foreach ($professional_attendees as $attendee) {
                    if ($count >= 200) break;
                    
                    $attendee_image = get_the_post_thumbnail_url($attendee->ID, 'full');
                    $role = get_field('role', $attendee->ID) ?: get_field('field_job_title', $attendee->ID);
                    $company = get_field('company', $attendee->ID) ?: get_field('field_university', $attendee->ID);
                    $harmony_experience = get_field('harmony_experience', $attendee->ID) ?: get_field('field_message', $attendee->ID);
                    
                    // Get bio data
                    $bio_data = [];
                    $bio_fields = [
                        'field_edu_resume' => 'الخلفية الاكاديمية',
                        'field_pro_resume' => 'السيرة المهنية', 
                        'field_personal_resume' => 'السيرة الذاتية الشخصية',
                        'field_selected_skills' => 'المهارات'
                    ];
                    
                    foreach ($bio_fields as $field_key => $title) {
                        $value = get_field($field_key, $attendee->ID);
                        if ($value) {
                            if (is_array($value) && $field_key === 'field_selected_skills') {
                                $skill_titles = array_map(function ($post) {
                                    return get_the_title($post);
                                }, $value);
                                $content = implode(', ', $skill_titles);
                            } else {
                                $content = $value;
                            }
                            $bio_data[] = ['title' => $title, 'content' => $content];
                        }
                    }
                    
                    $event_participants[] = [
                        'name' => $attendee->post_title,
                        'role' => $role,
                        'company' => $company,
                        'image' => $attendee_image,
                        'category' => 'مشتركون مهنيون',
                        'event' => $event->post_title,
                        'bio' => $bio_data,
                        'quote' => $harmony_experience,
                        'instagram' => get_field('field_instagram', $attendee->ID),
                        'linkedin' => get_field('field_linkedin', $attendee->ID)
                    ];
                    $count++;
                }
            }
            
            $events_participants[$eventIndex] = $event_participants;
        }
    }
    
    // Output as JSON for JavaScript
    echo '<script>const eventsParticipantsData = ' . json_encode($events_participants) . ';</script>';
    ?>
</div>

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
    --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
}

/* Enhanced Hero Section */
.modern-hero-section {
    background: var(--gradient-primary);
    position: relative;
    overflow: hidden;
    min-height: 75vh;
    color: var(--white);
}

.hero-background {
    position: relative;
    width: 100%;
    height: 100%;
}

/* Enhanced Hero Content */
.hero-content {
    position: relative;
    z-index: 2;
    padding: 80px 0 60px 0;
}

.project-icon-hero {
    position: relative;
    margin-bottom: 2rem;
    animation: bounceIn 1.2s ease-out;
    display: inline-block;
}

.project-icon-hero img {
    max-height: 140px;
    filter: brightness(0) invert(1) drop-shadow(0 4px 8px rgba(0,0,0,0.3));
    transition: var(--transition);
}

.icon-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 160px;
    height: 160px;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); }
    50% { opacity: 0.8; transform: translate(-50%, -50%) scale(1.1); }
}

.hero-title {
    font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 900;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    animation: fadeInUp 1s ease-out 0.2s both;
}

.title-gradient {
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 50%, #ffffff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    position: relative;
}

.hero-description {
    font-size: 1.3rem;
    line-height: 1.7;
    margin-bottom: 2rem;
    opacity: 0.95;
    animation: fadeInUp 1s ease-out 0.4s both;
    font-weight: 300;
}

/* Animated Project Quotes */
.animated-quotes {
    margin-bottom: 2rem;
    animation: fadeInUp 1s ease-out 0.5s both;
}

.quote-container {
    position: relative;
    min-height: 80px;
    margin-bottom: 20px;
}

.quote {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    font-size: 1.1rem;
    font-style: italic;
    color: rgba(255, 255, 255, 0.9);
    text-align: center;
    line-height: 1.6;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease;
    padding: 0 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 15px 20px;
    backdrop-filter: blur(10px);
}

.quote.active {
    opacity: 1;
    transform: translateY(0);
}

.quote-dots {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 15px;
}

.quote-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    transition: var(--transition);
}

.quote-dot.active,
.quote-dot:hover {
    background: var(--white);
    transform: scale(1.2);
    box-shadow: 0 2px 10px rgba(255, 255, 255, 0.5);
}

.hero-cta {
    animation: fadeInUp 1s ease-out 0.6s both;
}

.modern-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 15px;
    background: var(--beige-light);
    color: var(--primary-color);
    padding: 18px 36px;
    border-radius: 60px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.2rem;
    transition: var(--transition);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    border: 2px solid transparent;
}

.modern-btn:hover {
    background: var(--beige-color);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
    color: var(--primary-dark);
    text-decoration: none;
    border-color: rgba(255,255,255,0.3);
}

.btn-text {
    position: relative;
    z-index: 2;
}

.btn-icon {
    transition: var(--transition);
    position: relative;
    z-index: 2;
}

.modern-btn:hover .btn-icon {
    transform: translate(4px, -4px) rotate(45deg);
}

/* Enhanced Hero Image with Slideshow */
.hero-image-container {
    position: relative;
    animation: fadeInRight 1s ease-out 0.3s both;
}

.hero-slideshow {
    position: relative;
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
    transform: perspective(1000px) rotateY(-5deg);
    transition: var(--transition);
}

.hero-slideshow:hover {
    transform: perspective(1000px) rotateY(0deg) scale(1.02);
    box-shadow: 0 30px 100px rgba(0, 0, 0, 0.5);
}

.slideshow-container {
    position: relative;
    width: 100%;
    height: 450px;
    overflow: hidden;
    background: var(--beige-light);
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: all 0.6s ease-in-out;
}

.slide.active {
    opacity: 1;
    visibility: visible;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
    display: block;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(1, 109, 71, 0.3), rgba(2, 166, 99, 0.1));
}

/* Slideshow Navigation */
.slide-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    color: var(--primary-color);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 10;
    opacity: 0;
    backdrop-filter: blur(10px);
}

.hero-slideshow:hover .slide-nav {
    opacity: 1;
}

.slide-nav:hover {
    background: var(--white);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 20px rgba(1, 109, 71, 0.3);
}

.slide-nav.prev {
    left: 20px;
}

.slide-nav.next {
    right: 20px;
}

.image-border {
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    background: linear-gradient(135deg, rgba(255,255,255,0.3), rgba(255,255,255,0.1));
    border-radius: 36px;
    z-index: -1;
}

.image-caption {
    position: absolute;
    bottom: -25px;
    left: 25px;
    right: 25px;
    background: rgba(255, 255, 255, 0.98);
    color: var(--primary-color);
    padding: 18px 24px;
    border-radius: 16px;
    font-weight: 600;
    text-align: center;
    box-shadow: var(--shadow-heavy);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    backdrop-filter: blur(10px);
}

.caption-icon {
    color: var(--primary-light);
}

/* Enhanced Events Section */
.modern-events-section {
    padding: 120px 0;
    background: var(--beige-color);
    position: relative;
    overflow: hidden;
}

.modern-events-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="none"><circle cx="20" cy="20" r="2" fill="%23016D47" opacity="0.1"/><circle cx="80" cy="40" r="1.5" fill="%23016D47" opacity="0.1"/><circle cx="60" cy="80" r="2.5" fill="%23016D47" opacity="0.1"/><circle cx="10" cy="60" r="1" fill="%23016D47" opacity="0.1"/><circle cx="90" cy="10" r="2" fill="%23016D47" opacity="0.1"/></svg>') repeat;
    opacity: 0.3;
    animation: float 20s linear infinite;
}

/* Dynamic Floating Quotes from ACF */
.floating-quote {
    background: rgba(255, 255, 255, 0.95);
    color: var(--primary-color);
    padding: 18px 25px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    max-width: 280px;
    box-shadow: var(--shadow-medium);
    backdrop-filter: blur(15px);
    border-left: 5px solid var(--primary-color);
    z-index: 10;
    font-style: italic;
    line-height: 1.5;
    text-align: center;
    will-change: transform;
    backface-visibility: hidden;
}

.floating-quote:nth-child(even) {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: var(--white);
    border-left: 5px solid var(--white);
}

.floating-quote:nth-child(3n) {
    background: rgba(2, 166, 99, 0.9);
    color: var(--white);
    border-left: 5px solid var(--beige-light);
}

.floating-quote:nth-child(4n) {
    background: rgba(255, 255, 255, 0.92);
    color: var(--primary-dark);
    border-right: 5px solid var(--primary-light);
    border-left: none;
}

.floating-quote:nth-child(5n) {
    background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
    color: var(--white);
    border-left: 5px solid var(--beige-color);
}

@keyframes floatUp {
    0%, 100% { transform: translateY(0px); opacity: 0.8; }
    50% { transform: translateY(-15px); opacity: 1; }
}

@keyframes floatDown {
    0%, 100% { transform: translateY(0px); opacity: 0.9; }
    50% { transform: translateY(10px); opacity: 1; }
}

@keyframes floatSide {
    0%, 100% { transform: translateX(0px) translateY(0px); opacity: 0.85; }
    25% { transform: translateX(-8px) translateY(-3px); opacity: 1; }
    50% { transform: translateX(6px) translateY(-8px); opacity: 0.9; }
    75% { transform: translateX(-4px) translateY(-2px); opacity: 1; }
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
}

.section-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.title-accent {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 2rem 0;
}

.divider-line {
    width: 100px;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.divider-dot {
    width: 16px;
    height: 16px;
    background: var(--beige-light);
    border: 4px solid var(--primary-color);
    border-radius: 50%;
    position: absolute;
}

.section-subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    font-weight: 400;
}

/* Enhanced Event Navigation */
.event-navigation {
    display: flex;
    justify-content: center;
    margin-bottom: 5rem;
    gap: 2rem;
    flex-wrap: wrap;
}

.event-nav-item {
    position: relative;
    background: var(--white);
    border-radius: 24px;
    padding: 25px;
    cursor: pointer;
    transition: var(--transition);
    min-width: 320px;
    box-shadow: var(--shadow-light);
    border: 2px solid transparent;
    overflow: hidden;
}

.event-nav-item:hover,
.event-nav-item.active {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-heavy);
    border-color: var(--primary-light);
}

.nav-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.nav-badge {
    position: absolute;
    top: -15px;
    right: -15px;
    background: var(--gradient-primary);
    color: var(--white);
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    box-shadow: var(--shadow-medium);
}

.nav-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.nav-meta {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.nav-date,
.nav-location {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
    opacity: 0.8;
    font-weight: 500;
}

.nav-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0;
    transition: var(--transition);
}

.event-nav-item.active .nav-glow {
    width: 300px;
    height: 300px;
    opacity: 1;
}

/* Enhanced Event Content */
.event-content {
    display: none;
    animation: fadeInScale 0.6s ease-out;
}

.event-content.active {
    display: block;
}

.content-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.title-icon {
    color: var(--primary-color);
    display: flex;
    align-items: center;
}

/* Enhanced Event Includes */
.event-includes {
    margin-bottom: 6rem;
}

.includes-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2.5rem;
    margin-top: 4rem;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

.include-card.enhanced {
    background: var(--white);
    padding: 40px 30px;
    border-radius: 24px;
    text-align: center;
    box-shadow: var(--shadow-light);
    transition: var(--transition);
    border-top: 5px solid var(--primary-color);
    position: relative;
    overflow: hidden;
    min-height: 380px;
    display: flex;
    flex-direction: column;
}

.include-card.enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-primary);
}

.include-card.enhanced:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-heavy);
}

.card-icon {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
}

.card-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    line-height: 1.3;
}

.card-description-preview {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-align: right;
    direction: rtl;
}

.show-more-btn {
    background: var(--gradient-primary);
    color: var(--white);
    border: none;
    padding: 12px 24px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: var(--transition);
    margin-top: auto;
}

.show-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(1, 109, 71, 0.3);
}

.card-shimmer {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.include-card.enhanced:hover .card-shimmer {
    left: 100%;
}

/* Enhanced Compact Schedule */
.compact-schedule-section {
    margin-bottom: 6rem;
}

.compact-timeline {
    max-width: 900px;
    margin: 4rem auto 0;
}

.compact-timeline-item {
    background: var(--white);
    border-radius: 16px;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-light);
    transition: var(--transition);
    overflow: hidden;
    border-left: 4px solid var(--primary-color);
}

.compact-timeline-item:hover {
    box-shadow: var(--shadow-medium);
    transform: translateX(5px);
}

.timeline-header {
    display: flex;
    align-items: center;
    padding: 20px 25px;
    cursor: pointer;
    transition: var(--transition);
}

.timeline-header:hover {
    background: rgba(1, 109, 71, 0.05);
}

.timeline-time-compact {
    flex-shrink: 0;
    width: 100px;
}

.time-text {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    box-shadow: var(--shadow-light);
}

.timeline-title-compact {
    flex: 1;
    margin: 0 20px;
    position: relative;
}

.timeline-title-compact h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.schedule-title {
    transition: var(--transition);
}

.schedule-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-top: 15px;
    padding: 20px;
    background: rgba(1, 109, 71, 0.05);
    border-radius: 12px;
    border-left: 3px solid var(--primary-light);
    text-align: right;
    direction: rtl;
    font-size: 1.05rem;
    animation: slideDown 0.4s ease-out;
}

.timeline-toggle {
    color: var(--primary-color);
    transition: var(--transition);
}

.timeline-toggle.active {
    transform: rotate(180deg);
}

/* Enhanced Speakers (Rectangle Images) */
.speakers-section {
    margin-bottom: 6rem;
}

.speakers-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4rem;
    margin-top: 4rem;
    flex-wrap: wrap;
}

.speaker-card.modern {
    background: var(--white);
    padding: 35px;
    border-radius: 24px;
    text-align: center;
    box-shadow: var(--shadow-medium);
    transition: var(--transition);
    width: 300px;
    min-height: 400px;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.speaker-card.modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
}

.speaker-card.modern:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: var(--shadow-heavy);
}

.speaker-image-square {
    width: 200px;
    height: 140px;
    border-radius: 16px;
    overflow: hidden;
    margin: 0 auto 25px;
    box-shadow: var(--shadow-medium);
    position: relative;
}

.speaker-image-square img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.image-overlay-speaker,
.image-overlay-member {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(1, 109, 71, 0.3), rgba(2, 166, 99, 0.1));
    opacity: 0;
    transition: var(--transition);
}

.speaker-card.modern:hover .image-overlay-speaker,
.panel-member:hover .image-overlay-member {
    opacity: 1;
}

.speaker-card.modern:hover .speaker-image-square img,
.panel-member:hover .member-image-square img {
    transform: scale(1.1);
}

.speaker-info {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.speaker-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.speaker-role {
    color: var(--text-light);
    font-size: 1.1rem;
    font-weight: 500;
    margin-bottom: 15px;
    flex-grow: 1;
}

.speaker-badge {
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 700;
    display: inline-block;
    box-shadow: var(--shadow-light);
    margin-top: auto;
}

.guest-badge {
    background: linear-gradient(135deg, #ff6b6b, #ff8e53);
    color: var(--white);
}

.facilitator-badge {
    background: var(--gradient-primary);
    color: var(--white);
}

/* Panel Section */
.panel-section {
    margin-bottom: 6rem;
}

.panel-description {
    text-align: center;
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.panel-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.panel-member {
    background: var(--white);
    padding: 25px;
    border-radius: var(--border-radius);
    text-align: center;
    box-shadow: var(--shadow-light);
    transition: var(--transition);
}

.panel-member:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

.member-image-square {
    width: 180px;
    height: 120px;
    border-radius: 12px;
    overflow: hidden;
    margin: 0 auto 15px;
    position: relative;
}

.member-image-square img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.member-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.member-desc {
    color: var(--text-light);
    font-size: 0.95rem;
}

/* Gallery Section */
.gallery-section {
    margin-bottom: 6rem;
}

.modern-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-top: 3rem;
}

.gallery-item {
    position: relative;
    border-radius: var(--border-radius);
    overflow: hidden;
    aspect-ratio: 4/3;
}

.gallery-link {
    display: block;
    width: 100%;
    height: 100%;
    position: relative;
    cursor: pointer;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(1, 109, 71, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.overlay-icon {
    color: var(--white);
}

/* Attendees Section */
.attendees-section {
    margin-bottom: 6rem;
    position: relative;
}

.modern-search-container {
    margin: 3rem 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.search-wrapper {
    position: relative;
    background: var(--white);
    border-radius: 50px;
    box-shadow: var(--shadow-medium);
    display: flex;
    align-items: center;
    padding: 0 24px;
    transition: var(--transition);
    border: 2px solid transparent;
    margin-bottom: 2rem;
}

.search-wrapper:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 8px 40px rgba(1, 109, 71, 0.15);
}

.search-icon {
    color: var(--primary-color);
    margin-left: 12px;
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

.filter-tabs {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-tab {
    background: var(--white);
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 600;
}

.filter-tab:hover,
.filter-tab.active {
    background: var(--primary-color);
    color: var(--white);
}

.attendees-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 3rem;
}

.attendee-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    transition: var(--transition);
    overflow: hidden;
    position: relative;
}

.attendee-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

/* Fix for attendee images - make them rectangular */
.attendee-card .emp-photo,
.attendee-card .member-photo,
.attendee-card img[src*="wp-content"] {
    width: 100% !important;
    height: 120px !important;
    object-fit: cover !important;
    border-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
}

.attendee-card .emp-card,
.attendee-card .member-card {
    border-radius: var(--border-radius) !important;
}

.attendee-card .emp-info,
.attendee-card .member-info {
    padding: 15px !important;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
}

.no-results-icon {
    margin-bottom: 1rem;
    opacity: 0.5;
}

.no-results h4 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
}

/* Attendees Note */
.attendees-note {
    background: linear-gradient(135deg, var(--beige-light), var(--beige-color));
    border: 3px solid var(--primary-color);
    border-radius: 20px;
    padding: 30px;
    margin-top: 3rem;
    text-align: center;
    display: flex;
    align-items: center;
    gap: 20px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.note-icon {
    font-size: 3rem;
    flex-shrink: 0;
}

.note-content h5 {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.note-content p {
    color: var(--primary-color);
    margin-bottom: 5px;
}

.note-content strong {
    color: var(--primary-dark);
    font-weight: 700;
}

/* Drive Gallery */
.drive-gallery-section {
    margin-bottom: 6rem;
}

.thank-you-message {
    text-align: center;
    margin: 2rem 0;
    padding: 25px;
    background: linear-gradient(135deg, rgba(1, 109, 71, 0.05), rgba(2, 166, 99, 0.03));
    border-radius: 20px;
    border: 3px solid var(--primary-color);
    position: relative;
    overflow: hidden;
}

.thank-you-message::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
}

.thank-you-message h4 {
    color: var(--primary-color);
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(1, 109, 71, 0.1);
}

.drive-gallery-container {
    border: 3px solid var(--primary-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    margin-top: 3rem;
    box-shadow: var(--shadow-medium);
}

/* NEW: Event Slideshow Section */
.event-slideshow-section {
    margin-top: 6rem;
    margin-bottom: 3rem;
}

.slideshow-cta-container {
    background: linear-gradient(135deg, rgba(1, 109, 71, 0.05), rgba(2, 166, 99, 0.03));
    border: 3px solid var(--primary-color);
    border-radius: 24px;
    padding: 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.slideshow-cta-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
}

.slideshow-section-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.slideshow-description {
    font-size: 1.3rem;
    color: var(--text-light);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.event-slideshow-btn {
    background: linear-gradient(135deg, #ff6b6b, #ff8e53);
    color: var(--white);
    padding: 20px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.4rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 8px 30px rgba(255, 107, 107, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 15px;
}

.event-slideshow-btn:hover {
    background: linear-gradient(135deg, #ff5252, #ff7043);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 50px rgba(255, 107, 107, 0.4);
}

/* ===== NEW: ENHANCED DUAL PARTICIPANT SLIDESHOW STYLES ===== */

.conference-slideshow-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    background: rgba(0, 0, 0, 0.95);
    animation: modalFadeIn 0.4s ease-out;
}

.slideshow-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.conference-slideshow-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    z-index: 10;
}

/* Enhanced Slideshow Header */
.slideshow-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: var(--white);
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 20;
}

.slideshow-title h2 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
}

.participants-counter {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-top: 5px;
}

.slideshow-controls {
    display: flex;
    gap: 15px;
    align-items: center;
}

.control-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: var(--white);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    backdrop-filter: blur(10px);
}

.control-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.close-btn {
    background: rgba(255, 107, 107, 0.8);
}

.close-btn:hover {
    background: rgba(255, 107, 107, 1);
}

/* Progress Bar */
.slideshow-progress {
    height: 6px;
    background: rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 15;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #ff6b6b, #ff8e53);
    width: 0%;
    transition: width 0.1s linear;
    border-radius: 3px;
}

/* NEW: Networking Quotes Banner */
.networking-quotes-banner {
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.9), rgba(255, 142, 83, 0.9));
    color: var(--white);
    padding: 15px 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
    z-index: 15;
}

.quote-animation-container {
    position: relative;
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.networking-quote {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.3rem;
    font-weight: 600;
    font-style: italic;
    opacity: 0;
    transition: all 0.8s ease;
    white-space: nowrap;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.networking-quote.active {
    opacity: 1;
}

/* NEW: Enhanced Dual Participant Slideshow Content - Full Screen Style */
.dual-slideshow-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    position: relative;
    overflow-y: auto;
}

.dual-participant-slide {
    display: none;
    width: 100%;
    height: 100%;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-out;
}

.dual-participant-slide.active {
    display: flex;
    opacity: 1;
    transform: translateY(0);
    gap: 0;
    align-items: flex-start;
    justify-content: center;
    max-width: 1600px;
    width: 100%;
    margin: 0 auto;
}

/* Right Side - Professional Participant */
.participant-section-right {
    width: 50%;
    display: flex;
    gap: 40px;
    align-items: flex-start;
    justify-content: flex-end;
    padding-right: 30px;
    animation: slideInRight 0.8s ease-out;
}

/* Left Side - General Participant */
.participant-section-left {
    width: 50%;
    display: flex;
    gap: 40px;
    align-items: flex-start;
    justify-content: flex-start;
    padding-left: 30px;
    animation: slideInLeft 0.8s ease-out 0.2s both;
}

/* Large Participant Images - Full Size and Separate */
.participant-image-large {
    flex-shrink: 0;
    width: 350px;
}

.participant-image-large img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
    border: 6px solid var(--white);
    transition: var(--transition);
}

.participant-image-large:hover img {
    transform: scale(1.02);
    box-shadow: 0 30px 100px rgba(0, 0, 0, 0.5);
}

/* Enhanced Participant Info - Fixed Height */
.participant-info-enhanced {
    color: var(--white);
    text-align: right;
    direction: rtl;
    flex: 1;
    height: 500px;
    overflow-y: auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    display: flex;
    flex-direction: column;
}

/* Left side participant info - LTR */
.participant-section-left .participant-info-enhanced {
    text-align: left;
    direction: ltr;
}

.participant-info-enhanced::-webkit-scrollbar {
    width: 8px;
}

.participant-info-enhanced::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.participant-info-enhanced::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

.participant-name-large {
    font-size: 2.8rem;
    font-weight: 900;
    margin-bottom: 15px;
    background: linear-gradient(135deg, var(--white), #f0f8ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.participant-role-large {
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--beige-light);
    margin-bottom: 10px;
}

.participant-company-large {
    font-size: 1.3rem;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 15px;
}

.participant-category-large {
    display: inline-block;
    padding: 10px 25px;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 20px;
    box-shadow: var(--shadow-light);
}

.participant-section-right .participant-category-large {
    background: var(--gradient-primary);
    color: var(--white);
}

.participant-section-left .participant-category-large {
    background: linear-gradient(135deg, #ff6b6b, #ff8e53);
    color: var(--white);
}

/* Bio sections */
.participant-bio {
    margin-top: 20px;
    flex-grow: 1;
}

.bio-section {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 18px;
    margin-bottom: 12px;
    backdrop-filter: blur(10px);
    border-left: 4px solid var(--beige-light);
}

.participant-section-left .bio-section {
    border-left: none;
    border-right: 4px solid #ff8e53;
}

.bio-section-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--beige-light);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.bio-section-content {
    font-size: 1rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
}

/* Quote section */
.participant-quote {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 15px;
    padding: 18px;
    margin: 15px 0;
    border-right: 4px solid var(--beige-light);
    font-style: italic;
    font-size: 1.1rem;
    line-height: 1.6;
}

.participant-section-left .participant-quote {
    border-right: none;
    border-left: 4px solid #ff8e53;
}

/* Social links */
.participant-social {
    display: flex;
    gap: 15px;
    margin-top: 15px;
    justify-content: flex-end;
}

.participant-section-left .participant-social {
    justify-content: flex-start;
}

.social-link {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    backdrop-filter: blur(10px);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.social-link img {
    width: 20px;
    height: 20px;
    filter: brightness(0) invert(1);
}

/* NEW: Visual Connection Element */
.connection-element {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
    pointer-events: none;
}

.connection-line {
    width: 150px;
    height: 6px;
    background: linear-gradient(90deg, 
        var(--primary-color), 
        #ff6b6b, 
        var(--primary-color));
    border-radius: 3px;
    position: relative;
    animation: connectionPulse 3s ease-in-out infinite;
}

.connection-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: var(--white);
    color: var(--primary-color);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    animation: connectionSpin 4s linear infinite;
}

@keyframes connectionPulse {
    0%, 100% { opacity: 0.7; transform: translate(-50%, -50%) scaleX(1); }
    50% { opacity: 1; transform: translate(-50%, -50%) scaleX(1.1); }
}

@keyframes connectionSpin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* NEW: Networking Tips Banner */
.networking-tips-banner {
    background: linear-gradient(135deg, rgba(1, 109, 71, 0.9), rgba(2, 166, 99, 0.9));
    color: var(--white);
    padding: 15px 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    position: relative;
    z-index: 15;
}

.tips-container {
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
    min-height: 40px;
}

.tip-icon {
    color: var(--beige-light);
    flex-shrink: 0;
}

.networking-tip {
    font-size: 1.2rem;
    font-weight: 600;
    opacity: 0;
    position: absolute;
    left: 50px;
    white-space: nowrap;
    transition: all 0.8s ease;
}

.networking-tip.active {
    opacity: 1;
    position: relative;
    left: 0;
}

/* Category Indicator */
.category-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: var(--white);
    padding: 15px 30px;
    border-radius: 25px;
    font-size: 1.3rem;
    font-weight: 700;
    box-shadow: 0 8px 30px rgba(1, 109, 71, 0.3);
    backdrop-filter: blur(15px);
    z-index: 15;
}

/* Content Modal */
.content-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    animation: modalFadeIn 0.3s ease-out;
}

.modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.modal-container {
    position: relative;
    background: var(--white);
    margin: 5% auto;
    max-width: 700px;
    border-radius: 24px;
    box-shadow: var(--shadow-heavy);
    animation: modalSlideIn 0.3s ease-out;
    max-height: 80vh;
    overflow: hidden;
    z-index: 10;
}

.modal-header {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
}

.modal-close {
    background: none;
    border: none;
    color: var(--white);
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    transition: var(--transition);
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

.modal-body {
    padding: 30px;
    max-height: 60vh;
    overflow-y: auto;
    line-height: 1.7;
    color: var(--text-dark);
    font-size: 1.1rem;
    text-align: right;
    direction: rtl;
}

/* Image Modal */
.image-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    animation: modalFadeIn 0.3s ease-out;
}

.image-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 1;
}

.image-modal-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}

.image-modal-close {
    position: absolute;
    top: 30px;
    right: 30px;
    background: rgba(255, 255, 255, 0.9);
    color: var(--text-dark);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 20;
}

.image-modal-close:hover {
    background: var(--white);
    transform: scale(1.1);
}

.image-modal-content {
    max-width: 90%;
    max-height: 90%;
    position: relative;
    text-align: center;
}

.image-modal-content img {
    max-width: 100%;
    max-height: 80vh;
    border-radius: 8px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
}

.image-modal-title {
    color: var(--white);
    font-size: 1.2rem;
    font-weight: 600;
    margin-top: 20px;
    padding: 10px 20px;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 20px;
    display: inline-block;
}

/* Bio list styling */
.bio-list {
    margin: 0;
    padding-right: 20px;
    list-style-type: disc;
    direction: rtl;
    text-align: right;
}

.bio-list li {
    margin-bottom: 8px;
    line-height: 1.5;
    color: var(--text-dark);
}

/* Animations */
@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes modalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes slideDown {
    from {
        max-height: 0;
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        max-height: 300px;
        opacity: 1;
        transform: translateY(0);
    }
}

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

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }  
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(1deg); }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .includes-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }
    
    .dual-participant-slide.active {
        gap: 40px;
    }
    
    .participant-card {
        max-width: 500px;
    }
    
    .participant-image {
        height: 250px;
    }
}

@media (max-width: 1024px) {
    .includes-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .speakers-grid {
        flex-direction: column;
        align-items: center;
        gap: 2rem;
    }
    
    .dual-participant-slide.active {
        flex-direction: column;
        gap: 30px;
    }
    
    .participant-card {
        max-width: 600px;
    }
    
    .connection-element {
        display: none;
    }
}

@media (max-width: 992px) {
    .modern-hero-section {
        min-height: 70vh;
    }
    
    .hero-content {
        padding: 60px 0 40px 0;
        text-align: center;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .content-title {
        font-size: 2rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .event-navigation {
        flex-direction: column;
        align-items: center;
    }
    
    .event-nav-item {
        width: 100%;
        max-width: 400px;
    }
    
    .floating-quote {
        display: none;
    }
    
    .slideshow-container {
        height: 300px;
    }
    
    .slideshow-header {
        padding: 15px 20px;
    }
    
    .slideshow-title h2 {
        font-size: 1.5rem;
    }
    
    .networking-quotes-banner,
    .networking-tips-banner {
        padding: 12px 20px;
    }
    
    .networking-quote {
        font-size: 1.1rem;
        white-space: normal;
        text-align: center;
        max-width: 90%;
    }
    
    .networking-tip {
        font-size: 1rem;
        white-space: normal;
    }
}

@media (max-width: 768px) {
    .dual-slideshow-content {
        padding: 20px;
    }
    
    .participant-card {
        padding: 25px;
        max-width: 100%;
    }
    
    .participant-image {
        height: 200px;
    }
    
    .participant-name {
        font-size: 1.6rem;
    }
    
    .participant-role {
        font-size: 1.1rem;
    }
    
    .slideshow-section-title {
        font-size: 1.8rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .event-slideshow-btn {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .control-btn {
        width: 45px;
        height: 45px;
    }
    
    .slideshow-controls {
        gap: 10px;
    }
    
    .category-indicator {
        font-size: 1.1rem;
        padding: 12px 25px;
        bottom: 20px;
    }
}

@media (max-width: 480px) {
    .speaker-image-square,
    .member-image-square {
        width: 150px;
        height: 100px;
    }
    
    .participant-card {
        padding: 20px;
    }
    
    .participant-image {
        height: 150px;
    }
    
    .participant-name {
        font-size: 1.4rem;
    }
    
    .networking-quote {
        font-size: 1rem;
    }
    
    .networking-tip {
        font-size: 0.9rem;
    }
    
    .bio-section-compact {
        padding: 12px;
    }
    
    .bio-section-title-compact {
        font-size: 1rem;
    }
    
    .bio-section-content-compact {
        font-size: 0.9rem;
    }
}

/* Fullscreen Styles */
.conference-slideshow-modal.fullscreen {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    z-index: 2147483647 !important;
}

.conference-slideshow-modal.fullscreen .dual-slideshow-content {
    padding: 60px;
}

.conference-slideshow-modal.fullscreen .participant-card {
    max-width: 700px;
}

.conference-slideshow-modal.fullscreen .participant-image {
    height: 350px;
}

/* Custom scrollbar for bio sections */
.participant-bio-compact::-webkit-scrollbar {
    width: 6px;
}

.participant-bio-compact::-webkit-scrollbar-track {
    background: rgba(1, 109, 71, 0.1);
    border-radius: 3px;
}

.participant-bio-compact::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 3px;
}

/* Add CSS class for modal open state */
body.modal-open {
    overflow: hidden;
}

.content-modal,
.image-modal,
.conference-slideshow-modal {
    z-index: 999999 !important;
}

.modal-container,
.image-modal-container,
.conference-slideshow-container {
    z-index: 1000000 !important;
}
</style>

<script>
jQuery(document).ready(function($) {
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100
        });
    }
    
    // Event Navigation
    $('.event-nav-item').on('click', function() {
        const eventIndex = $(this).data('event');
        
        // Update navigation
        $('.event-nav-item').removeClass('active');
        $(this).addClass('active');
        
        // Update content with fade effect
        $('.event-content.active').fadeOut(200, function() {
            $(this).removeClass('active');
            $(`.event-content[data-event="${eventIndex}"]`).addClass('active').fadeIn(300);
        });
        
        // Reinitialize AOS for new content
        setTimeout(() => {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 300);
    });
    
    // Show More Button Modal
    $('.show-more-btn').on('click', function() {
        const title = $(this).data('title');
        const content = $(this).data('content');
        
        $('#modalTitle').text(title);
        $('#modalContent').html(content);
        $('#contentModal').fadeIn(300);
        $('body').addClass('modal-open');
    });
    
    // Close Modal
    window.closeContentModal = function() {
        $('#contentModal').fadeOut(300);
        $('body').removeClass('modal-open');
    };
    
    // Image Modal Functions
    window.openImageModal = function(imageSrc, imageTitle) {
        $('#modalImage').attr('src', imageSrc);
        $('#imageModalTitle').text(imageTitle);
        $('#imageModal').fadeIn(300);
        $('body').addClass('modal-open');
    };
    
    window.closeImageModal = function() {
        $('#imageModal').fadeOut(300);
        $('body').removeClass('modal-open');
    };
    
    // Close modal on Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            if ($('#contentModal').is(':visible')) {
                closeContentModal();
            }
            if ($('#imageModal').is(':visible')) {
                closeImageModal();
            }
            if ($('#conferenceSlideshowModal').is(':visible')) {
                closeConferenceSlideshow();
            }
        }
    });
    
    // Search Functionality
    $('#attendeeSearch').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        let visibleCount = 0;
        
        $('.employee-box').each(function() {
            const $card = $(this);
            const name = $card.data('name') || '';
            const role = $card.data('role') || '';
            const company = $card.data('company') || '';
            
            const searchableText = `${name} ${role} ${company}`.toLowerCase();
            
            if (searchableText.includes(searchTerm)) {
                $card.show();
                visibleCount++;
            } else {
                $card.hide();
            }
        });
        
        // Show/hide no results
        if (visibleCount === 0 && searchTerm.length > 0) {
            $('#noResults').show();
        } else {
            $('#noResults').hide();
        }
    });
    
    // Filter Functionality
    $('.filter-tab').on('click', function() {
        const filter = $(this).data('filter');
        
        // Update active tab
        $('.filter-tab').removeClass('active');
        $(this).addClass('active');
        
        // Filter attendees
        $('.employee-box').each(function() {
            const $card = $(this);
            
            if (filter === 'all') {
                $card.show();
            } else if (filter === 'general' && $card.hasClass('general-attendee')) {
                $card.show();
            } else if (filter === 'professional' && $card.hasClass('professional-attendee')) {
                $card.show();
            } else {
                $card.hide();
            }
        });
        
        // Clear search when filtering
        $('#attendeeSearch').val('');
        $('#noResults').hide();
    });
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
    
    // Initialize networking quotes and tips rotation
    initializeNetworkingAnimations();
});

// Enhanced Schedule Toggle Function
function toggleScheduleItem(eventIndex, itemIndex) {
    const titleId = `#schedule-title-${eventIndex}-${itemIndex}`;
    const descriptionId = `#schedule-description-${eventIndex}-${itemIndex}`;
    const toggleId = `#toggle-${eventIndex}-${itemIndex}`;
    
    const $title = $(titleId);
    const $description = $(descriptionId);
    const $toggle = $(toggleId);
    
    if ($description.is(':visible')) {
        // Hide description, show title
        $description.fadeOut(200, function() {
            $title.fadeIn(200);
        });
        $toggle.removeClass('active');
    } else {
        // Hide title, show description
        $title.fadeOut(200, function() {
            $description.fadeIn(200);
        });
        $toggle.addClass('active');
    }
}

// ===== NEW: ENHANCED DUAL PARTICIPANT SLIDESHOW FUNCTIONALITY =====

// Enhanced Conference Slideshow Variables
let currentParticipantIndex = 0;
let isPlaying = false;
let slideshowInterval;
let progressInterval;
let currentEventParticipants = [];
let currentEventIndex = 0;
let professionalParticipants = [];
let generalParticipants = [];
let isFullscreen = false;
const SLIDE_DURATION = 8000; // 8 seconds

// Networking quotes and tips
let networkingQuoteIndex = 0;
let networkingTipIndex = 0;
let quoteRotationInterval;
let tipRotationInterval;

// Initialize Networking Animations
function initializeNetworkingAnimations() {
    // Start networking quotes rotation
    quoteRotationInterval = setInterval(() => {
        rotateNetworkingQuotes();
    }, 5000);
    
    // Start networking tips rotation
    tipRotationInterval = setInterval(() => {
        rotateNetworkingTips();
    }, 7000);
}

// Rotate Networking Quotes
function rotateNetworkingQuotes() {
    const quotes = document.querySelectorAll('.networking-quote');
    if (quotes.length === 0) return;
    
    // Hide current quote
    quotes[networkingQuoteIndex].classList.remove('active');
    
    // Move to next quote
    networkingQuoteIndex = (networkingQuoteIndex + 1) % quotes.length;
    
    // Show next quote
    quotes[networkingQuoteIndex].classList.add('active');
}

// Rotate Networking Tips
function rotateNetworkingTips() {
    const tips = document.querySelectorAll('.networking-tip');
    if (tips.length === 0) return;
    
    // Hide current tip
    tips[networkingTipIndex].classList.remove('active');
    
    // Move to next tip
    networkingTipIndex = (networkingTipIndex + 1) % tips.length;
    
    // Show next tip
    tips[networkingTipIndex].classList.add('active');
}

// Start Event-Specific Dual Slideshow
function startEventSlideshow(eventIndex) {
    if (typeof eventsParticipantsData === 'undefined' || !eventsParticipantsData[eventIndex]) {
        alert('لا يوجد مشاركين لعرضهم في هذه الفعالية');
        return;
    }
    
    currentEventIndex = eventIndex;
    currentEventParticipants = eventsParticipantsData[eventIndex].filter(p => p.name && p.name.trim() !== '');
    
    if (currentEventParticipants.length === 0) {
        alert('لا يوجد مشاركين لعرضهم في هذه الفعالية');
        return;
    }
    
    // Separate participants by category
    professionalParticipants = currentEventParticipants.filter(p => 
        p.category === 'مشتركون مهنيون' || p.category === 'محاور' || p.category === 'متحدث رئيسي'
    );
    generalParticipants = currentEventParticipants.filter(p => 
        p.category === 'متطوعي هارموني' || p.category === 'عضو لجنة'
    );
    
    const modal = document.getElementById('conferenceSlideshowModal');
    const totalSpan = document.getElementById('totalParticipants');
    const eventTitle = document.getElementById('slideshowEventTitle');
    
    // Set event title
    if (currentEventParticipants[0] && currentEventParticipants[0].event) {
        eventTitle.textContent = `مشاركو فعالية: ${currentEventParticipants[0].event}`;
    }
    
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
    document.body.classList.add('modal-open');
    
    // Calculate total pairs
    const totalPairs = Math.max(professionalParticipants.length, generalParticipants.length);
    totalSpan.textContent = totalPairs;
    currentParticipantIndex = 0;
    
    showDualParticipants(0);
    startAutoPlay();
}

// Show dual participants (professional + general) - Full Screen Style
function showDualParticipants(index) {
    const slide = document.getElementById('participantSlide');
    const currentSpan = document.getElementById('currentParticipant');
    const categoryIndicator = document.getElementById('categoryIndicator');
    
    // Update counter
    currentSpan.textContent = index + 1;
    categoryIndicator.textContent = '';
    
    // Reset slide animation
    slide.classList.remove('active');
    
    setTimeout(() => {
        let html = '';
        
        // Get participants for this slide
        const professionalParticipant = professionalParticipants[index % professionalParticipants.length];
        const generalParticipant = generalParticipants[index % generalParticipants.length];
        
        if (professionalParticipant && generalParticipant) {
            // Both participants available
            html = `
                <div class="participant-section-right">
                    ${buildParticipantHTML(professionalParticipant, 'right')}
                </div>
                <div class="participant-section-left">
                    ${buildParticipantHTML(generalParticipant, 'left')}
                </div>
            `;
        } else if (professionalParticipant) {
            // Only professional participant - show in center
            html = `
                <div class="participant-section-right" style="width: 100%; justify-content: center; padding: 0;">
                    ${buildParticipantHTML(professionalParticipant, 'right')}
                </div>
            `;
        } else if (generalParticipant) {
            // Only general participant - show in center
            html = `
                <div class="participant-section-left" style="width: 100%; justify-content: center; padding: 0;">
                    ${buildParticipantHTML(generalParticipant, 'left')}
                </div>
            `;
        }
        
        slide.innerHTML = html;
        slide.classList.add('active');
    }, 100);
    
    currentParticipantIndex = index;
    
    // Reset and start progress
    resetProgress();
    if (isPlaying) {
        startProgress();
    }
}

// Build individual participant HTML - Full Screen Style
function buildParticipantHTML(participant, side) {
    if (!participant) return '';
    
    let html = '';
    
    // Large Participant Image - Full Size and Separate
    html += '<div class="participant-image-large">';
    if (participant.image) {
        html += `<img src="${participant.image}" alt="${participant.name}" loading="lazy">`;
    } else {
        // Default avatar with first letter
        const bgColor = side === 'right' ? 'var(--gradient-primary)' : 'linear-gradient(135deg, #ff6b6b, #ff8e53)';
        html += `<div style="width: 100%; height: 500px; background: ${bgColor}; border-radius: 20px; display: flex; align-items: center; justify-content: center; color: white; font-size: 6rem; font-weight: bold; box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4); border: 6px solid var(--white);">
                    ${participant.name.charAt(0)}
                </div>`;
    }
    html += '</div>';
    
    // Enhanced Participant Info - Fixed Height
    html += '<div class="participant-info-enhanced">';
    html += `<h1 class="participant-name-large">${participant.name}</h1>`;
    
    if (participant.role) {
        html += `<div class="participant-role-large">${participant.role}</div>`;
    }
    
    if (participant.company) {
        html += `<div class="participant-company-large">${participant.company}</div>`;
    }
    
    html += `<div class="participant-category-large">${participant.category}</div>`;
    
    // Add quote if available
    if (participant.quote) {
        html += `<div class="participant-quote">"${participant.quote}"</div>`;
    }
    
    // Add bio sections if available
    if (participant.bio && participant.bio.length > 0) {
        html += '<div class="participant-bio">';
        participant.bio.forEach(bioSection => {
            if (bioSection.content) {
                html += `<div class="bio-section">
                    <div class="bio-section-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2L2 7V17C2 18.1 2.9 19 4 19H20C21.1 19 22 18.1 22 17V7L12 2Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        ${bioSection.title}
                    </div>
                    <div class="bio-section-content">`;
                
                // Format bio content with bullets if it's a CV/Bio section
                if (bioSection.title.includes('السيرة') || bioSection.title.includes('CV') || bioSection.title.includes('Bio')) {
                    html += formatBioContentJS(bioSection.content);
                } else {
                    html += bioSection.content;
                }
                
                html += `</div></div>`;
            }
        });
        html += '</div>';
    }
    
    // Add social links if available
    if (participant.instagram || participant.linkedin) {
        html += '<div class="participant-social">';
        if (participant.instagram) {
            html += `<a href="${participant.instagram}" target="_blank" class="social-link">
                <img src="${themeDirUrl}/images/instagram3.png" alt="Instagram">
            </a>`;
        }
        if (participant.linkedin) {
            html += `<a href="${participant.linkedin}" target="_blank" class="social-link">
                <img src="${themeDirUrl}/images/linkedin3.png" alt="LinkedIn">
            </a>`;
        }
        html += '</div>';
    }
    
    html += '</div>';
    
    return html;
}

// Format bio content with bullets (JavaScript version)
function formatBioContentJS(content) {
    if (!content) return content;
    
    // Remove existing bullet symbols
    content = content.replace(/[*•◦-]/g, '');
    
    // Split by line breaks
    const lines = content.split(/\r\n|\r|\n/).map(line => line.trim()).filter(line => line.length > 0);
    
    if (lines.length <= 1) {
        return content;
    }
    
    // Create bullet list
    let formattedContent = '<ul class="bio-list" style="margin: 0; padding-right: 15px; list-style-type: disc; text-align: right; direction: rtl;">';
    lines.forEach(line => {
        if (line) {
            formattedContent += `<li style="margin-bottom: 5px; line-height: 1.4; font-size: 0.9rem;">${line}</li>`;
        }
    });
    formattedContent += '</ul>';
    
    return formattedContent;
}

// Navigation functions for dual display
function nextParticipant() {
    const totalPairs = Math.max(professionalParticipants.length, generalParticipants.length);
    const nextIndex = (currentParticipantIndex + 1) % totalPairs;
    showDualParticipants(nextIndex);
}

function previousParticipant() {
    const totalPairs = Math.max(professionalParticipants.length, generalParticipants.length);
    const prevIndex = (currentParticipantIndex - 1 + totalPairs) % totalPairs;
    showDualParticipants(prevIndex);
}

// NEW: Fullscreen functionality
function toggleFullscreen() {
    const modal = document.getElementById('conferenceSlideshowModal');
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    const openIcon = fullscreenBtn.querySelector('.fullscreen-open');
    const exitIcon = fullscreenBtn.querySelector('.fullscreen-exit');
    
    if (!isFullscreen) {
        // Enter fullscreen
        if (modal.requestFullscreen) {
            modal.requestFullscreen();
        } else if (modal.webkitRequestFullscreen) {
            modal.webkitRequestFullscreen();
        } else if (modal.msRequestFullscreen) {
            modal.msRequestFullscreen();
        } else if (modal.mozRequestFullScreen) {
            modal.mozRequestFullScreen();
        }
        
        modal.classList.add('fullscreen');
        openIcon.style.display = 'none';
        exitIcon.style.display = 'block';
        isFullscreen = true;
    } else {
        // Exit fullscreen
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        }
        
        modal.classList.remove('fullscreen');
        openIcon.style.display = 'block';
        exitIcon.style.display = 'none';
        isFullscreen = false;
    }
}

// Close slideshow
function closeConferenceSlideshow() {
    const modal = document.getElementById('conferenceSlideshowModal');
    
    // Exit fullscreen if active
    if (isFullscreen) {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        }
    }
    
    modal.style.display = 'none';
    modal.classList.remove('fullscreen');
    document.body.style.overflow = '';
    document.body.classList.remove('modal-open');
    
    stopAutoPlay();
    resetProgress();
    isFullscreen = false;
    
    // Reset fullscreen button
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    const openIcon = fullscreenBtn.querySelector('.fullscreen-open');
    const exitIcon = fullscreenBtn.querySelector('.fullscreen-exit');
    openIcon.style.display = 'block';
    exitIcon.style.display = 'none';
}

// Toggle play/pause
function toggleSlideshow() {
    if (isPlaying) {
        stopAutoPlay();
    } else {
        startAutoPlay();
    }
}

// Auto play functions
function startAutoPlay() {
    isPlaying = true;
    updatePlayPauseButton();
    
    slideshowInterval = setInterval(() => {
        nextParticipant();
    }, SLIDE_DURATION);
    
    startProgress();
}

function stopAutoPlay() {
    isPlaying = false;
    updatePlayPauseButton();
    
    if (slideshowInterval) {
        clearInterval(slideshowInterval);
    }
    
    if (progressInterval) {
        clearInterval(progressInterval);
    }
}

// Progress bar functions
function startProgress() {
    const progressBar = document.getElementById('progressBar');
    let progress = 0;
    
    if (progressInterval) {
        clearInterval(progressInterval);
    }
    
    progressInterval = setInterval(() => {
        progress += (100 / (SLIDE_DURATION / 100));
        progressBar.style.width = Math.min(progress, 100) + '%';
        
        if (progress >= 100) {
            clearInterval(progressInterval);
        }
    }, 100);
}

function resetProgress() {
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = '0%';
    
    if (progressInterval) {
        clearInterval(progressInterval);
    }
}

// Update play/pause button
function updatePlayPauseButton() {
    const playIcon = document.querySelector('.play-icon');
    const pauseIcon = document.querySelector('.pause-icon');
    
    if (isPlaying) {
        playIcon.style.display = 'none';
        pauseIcon.style.display = 'block';
    } else {
        playIcon.style.display = 'block';
        pauseIcon.style.display = 'none';
    }
}

// Enhanced Keyboard controls
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('conferenceSlideshowModal');
    if (modal.style.display !== 'block') return;
    
    switch(e.key) {
        case 'Escape':
            closeConferenceSlideshow();
            break;
        case 'ArrowRight':
        case 'ArrowDown':
            nextParticipant();
            break;
        case 'ArrowLeft':
        case 'ArrowUp':
            previousParticipant();
            break;
        case ' ':
            e.preventDefault();
            toggleSlideshow();
            break;
        case 'f':
        case 'F':
            e.preventDefault();
            toggleFullscreen();
            break;
    }
});

// Touch gesture support for mobile
let touchStartX = 0;
let touchStartY = 0;

document.addEventListener('touchstart', function(e) {
    const modal = document.getElementById('conferenceSlideshowModal');
    if (modal.style.display !== 'block') return;
    
    touchStartX = e.touches[0].clientX;
    touchStartY = e.touches[0].clientY;
});

document.addEventListener('touchend', function(e) {
    const modal = document.getElementById('conferenceSlideshowModal');
    if (modal.style.display !== 'block') return;
    
    const touchEndX = e.changedTouches[0].clientX;
    const touchEndY = e.changedTouches[0].clientY;
    const deltaX = touchEndX - touchStartX;
    const deltaY = touchEndY - touchStartY;
    
    // Determine swipe direction
    if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
        if (deltaX > 0) {
            previousParticipant(); // Swipe right = previous
        } else {
            nextParticipant(); // Swipe left = next
        }
    }
});

// Simplified Hero Slideshow Functions
let currentSlideIndex = 0;
let slides = [];
let slideInterval;

function initializeSlideshow() {
    slides = document.querySelectorAll('.slide');
    
    if (slides.length === 0) return;
    
    // Show first slide immediately
    if (slides[0]) {
        slides[0].classList.add('active');
    }
    
    // Start auto-slide if more than 1 slide
    if (slides.length > 1) {
        startAutoSlide();
    }
}

function showSlide(index) {
    if (slides.length === 0) return;
    
    // Validate index
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;
    
    // Hide all slides
    slides.forEach(slide => slide.classList.remove('active'));
    
    // Show current slide
    if (slides[index]) {
        slides[index].classList.add('active');
    }
    
    currentSlideIndex = index;
}

function changeSlide(direction) {
    if (slides.length <= 1) return;
    
    clearInterval(slideInterval);
    
    if (direction === 1) {
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
    } else {
        currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
    }
    
    showSlide(currentSlideIndex);
    startAutoSlide();
}

function startAutoSlide() {
    if (slides.length <= 1) return;
    
    clearInterval(slideInterval);
    slideInterval = setInterval(() => {
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
        showSlide(currentSlideIndex);
    }, 4000);
}

function stopAutoSlide() {
    clearInterval(slideInterval);
}

// Animated Quotes Functions
let currentQuoteIndex = 0;
const quotes = document.querySelectorAll('.quote');
const quoteDots = document.querySelectorAll('.quote-dot');
let quoteInterval;

function showQuote(index) {
    if (quotes.length === 0) return;
    
    // Clear existing interval when manually selecting
    clearInterval(quoteInterval);
    
    // Hide all quotes
    quotes.forEach(quote => quote.classList.remove('active'));
    quoteDots.forEach(dot => dot.classList.remove('active'));
    
    // Show current quote
    if (quotes[index]) {
        quotes[index].classList.add('active');
        quoteDots[index].classList.add('active');
    }
    
    currentQuoteIndex = index;
    
    // Restart auto-animation
    startQuoteAnimation();
}

function startQuoteAnimation() {
    if (quotes.length <= 1) return;
    
    clearInterval(quoteInterval);
    quoteInterval = setInterval(() => {
        currentQuoteIndex = (currentQuoteIndex + 1) % quotes.length;
        
        // Hide all quotes
        quotes.forEach(quote => quote.classList.remove('active'));
        quoteDots.forEach(dot => dot.classList.remove('active'));
        
        // Show current quote
        if (quotes[currentQuoteIndex]) {
            quotes[currentQuoteIndex].classList.add('active');
            quoteDots[currentQuoteIndex].classList.add('active');
        }
    }, 4500);
}

// Set theme directory URL for social icons
const themeDirUrl = '<?php echo get_template_directory_uri(); ?>';

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize slideshow immediately
    initializeSlideshow();
    
    // Initialize quotes animation
    setTimeout(() => {
        if (quotes.length > 0) {
            quotes[0].classList.add('active');
            quoteDots[0].classList.add('active');
            startQuoteAnimation();
        }
    }, 1000);
    
    // Slideshow hover events
    const slideshow = document.querySelector('.hero-slideshow');
    if (slideshow) {
        slideshow.addEventListener('mouseenter', stopAutoSlide);
        slideshow.addEventListener('mouseleave', startAutoSlide);
    }
    
    // Enhanced event slideshow initialization
    console.log('Enhanced dual participant slideshow initialized');
    if (typeof eventsParticipantsData !== 'undefined') {
        console.log('Events participants data loaded:', eventsParticipantsData);
    }
    
    // Initialize networking animations after modal is ready
    setTimeout(initializeNetworkingAnimations, 1000);
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    clearInterval(slideInterval);
    clearInterval(quoteInterval);
    clearInterval(quoteRotationInterval);
    clearInterval(tipRotationInterval);
    stopAutoPlay();
});

// Listen for fullscreen change events
document.addEventListener('fullscreenchange', function() {
    if (!document.fullscreenElement) {
        isFullscreen = false;
        const modal = document.getElementById('conferenceSlideshowModal');
        modal.classList.remove('fullscreen');
        
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const openIcon = fullscreenBtn.querySelector('.fullscreen-open');
        const exitIcon = fullscreenBtn.querySelector('.fullscreen-exit');
        openIcon.style.display = 'block';
        exitIcon.style.display = 'none';
    }
});

// Add enhanced interaction feedback
document.addEventListener('DOMContentLoaded', function() {
    // Add click feedback to interactive elements
    const interactiveElements = document.querySelectorAll('.timeline-header, .show-more-btn, .filter-tab, .event-nav-item');
    
    interactiveElements.forEach(element => {
        element.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    
    // Enhanced schedule item interaction
    const timelineHeaders = document.querySelectorAll('.timeline-header');
    timelineHeaders.forEach(header => {
        header.addEventListener('click', function() {
            this.classList.toggle('expanded');
        });
    });
});
</script>

<?php get_footer(); ?>