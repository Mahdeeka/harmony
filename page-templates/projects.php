<?php
/**
 * Template Name: Projects
 **/
?>
<?php get_header(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            background: linear-gradient(135deg, #016D47 0%, #013020 100%);
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #016D47 0%, #024A33 50%, #013020 100%);
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.02)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            animation: grain 20s linear infinite;
        }
        
        @keyframes grain {
            0%, 100% { transform: translate(0, 0); }
            10% { transform: translate(-5%, -10%); }
            20% { transform: translate(-15%, 5%); }
            30% { transform: translate(7%, -25%); }
            40% { transform: translate(-5%, 25%); }
            50% { transform: translate(-15%, 10%); }
            60% { transform: translate(15%, 0%); }
            70% { transform: translate(0%, 15%); }
            80% { transform: translate(3%, 35%); }
            90% { transform: translate(-10%, 10%); }
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 50%;
            right: 15%;
            animation-delay: 7s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: 3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(30px) rotate(240deg); }
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }
        
        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: white;
            margin-bottom: 30px;
            line-height: 1.2;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: slideInRight 1s ease-out;
        }
        
        .hero-description {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
            animation: slideInRight 1s ease-out 0.3s both;
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Projects Grid */
        .projects-section {
            padding: 100px 0;
            background: linear-gradient(180deg, #016D47 0%, rgba(1, 109, 71, 0.1) 50%, transparent 100%);
            position: relative;
        }
        
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-top: 80px;
        }
        
        .project-card {
            background: #EFDDCE;
            border-radius: 24px;
            padding: 24px;
            text-decoration: none;
            color: inherit;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.8s ease-out;
            animation-fill-mode: both;
        }
        
        .project-card:nth-child(1) { animation-delay: 0.1s; }
        .project-card:nth-child(2) { animation-delay: 0.2s; }
        .project-card:nth-child(3) { animation-delay: 0.3s; }
        .project-card:nth-child(4) { animation-delay: 0.4s; }
        .project-card:nth-child(5) { animation-delay: 0.5s; }
        .project-card:nth-child(6) { animation-delay: 0.6s; }
        .project-card:nth-child(7) { animation-delay: 0.7s; }
        .project-card:nth-child(8) { animation-delay: 0.8s; }
        .project-card:nth-child(9) { animation-delay: 0.9s; }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(1, 109, 71, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .project-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 60px rgba(1, 109, 71, 0.2);
        }
        
        .project-card:hover::before {
            opacity: 1;
        }
        
        .project-image {
            position: relative;
            height: 280px;
            border-radius: 20px;
            overflow: hidden;
            background: linear-gradient(45deg, #016D47, #024A33);
            margin-bottom: 30px;
        }
        
        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .project-card:hover .project-image img {
            transform: scale(1.1);
        }
        
        .project-icon {
            position: absolute;
            bottom: 15px;
            right: 15px;
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .project-card:hover .project-icon {
            transform: scale(1.1);
        }
        
        .project-icon img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }
        
        .project-content {
            padding: 0 8px;
        }
        
        .project-description {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 25px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .project-link {
            display: inline-flex;
            align-items: center;
            color: #016D47;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            border-bottom: 2px solid #016D47;
            padding-bottom: 4px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .project-link::before {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 0;
            height: 2px;
            background: #024A33;
            transition: width 0.4s ease;
        }
        
        .project-card:hover .project-link::before {
            width: 100%;
        }
        
        .project-link i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }
        
        .project-card:hover .project-link i {
            transform: translateX(-4px);
        }
        
        /* Join Harmony Special Card */
        .join-card {
            background: linear-gradient(135deg, #013020 0%, #024A33 50%, #016D47 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .join-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: rotate 10s linear infinite;
        }
        
        @keyframes rotate {
            to { transform: rotate(360deg); }
        }
        
        .join-card-content {
            position: relative;
            z-index: 2;
            padding: 40px 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .join-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        
        .join-title {
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1.3;
            margin-bottom: 30px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .join-link {
            display: inline-flex;
            align-items: center;
            color: #EFDDCE;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            padding: 16px 32px;
            background: rgba(239, 221, 206, 0.1);
            border: 2px solid rgba(239, 221, 206, 0.3);
            border-radius: 50px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }
        
        .join-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }
        
        .join-link:hover::before {
            left: 100%;
        }
        
        .join-link:hover {
            background: rgba(239, 221, 206, 0.2);
            border-color: #EFDDCE;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .join-link i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }
        
        .join-link:hover i {
            transform: translateX(-3px);
        }
        
        /* Floating Quotes */
        .quotes-section {
            position: relative;
            padding: 80px 0;
            overflow: hidden;
        }
        
        .floating-quote {
            position: absolute;
            background: rgba(239, 221, 206, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(239, 221, 206, 0.3);
            border-radius: 20px;
            padding: 20px 25px;
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.1rem;
            font-weight: 500;
            line-height: 1.6;
            max-width: 320px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 10;
            opacity: 0;
            animation: slideInOut 15s infinite;
        }
        
        .floating-quote::before {
            content: '"';
            position: absolute;
            top: -15px;
            right: 15px;
            font-size: 3rem;
            color: rgba(239, 221, 206, 0.5);
            font-family: serif;
        }
        
        .floating-quote.quote-1 {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .floating-quote.quote-2 {
            top: 15%;
            right: 5%;
            animation-delay: 3s;
        }
        
        .floating-quote.quote-3 {
            top: 50%;
            left: 3%;
            animation-delay: 6s;
        }
        
        .floating-quote.quote-4 {
            top: 45%;
            right: 3%;
            animation-delay: 9s;
        }
        
        .floating-quote.quote-5 {
            top: 75%;
            left: 50%;
            transform: translateX(-50%);
            animation-delay: 12s;
        }
        
        @keyframes slideInOut {
            0%, 15% {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
            20%, 80% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            85%, 100% {
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }
        }
        
        /* Tablet Design */
        @media (max-width: 1024px) and (min-width: 769px) {
            .projects-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 35px;
            }
            
            .project-icon {
                width: 70px;
                height: 70px;
                bottom: 12px;
                right: 12px;
            }
            
            .project-icon img {
                width: 70px;
                height: 70px;
            }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .projects-grid {
                grid-template-columns: 1fr;
                gap: 30px;
                margin-top: 60px;
            }
            
            .project-card {
                padding: 20px;
            }
            
            .project-image {
                height: 220px;
            }
            
            .project-icon {
                width: 60px;
                height: 60px;
                bottom: 10px;
                right: 10px;
            }
            
            .project-icon img {
                width: 60px;
                height: 60px;
            }
            
            .join-title {
                font-size: 1.8rem;
            }
            
            .floating-quote {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                right: auto !important;
                transform: none !important;
                margin: 20px auto;
                max-width: 90%;
                animation: fadeIn 1s ease-out;
                opacity: 1;
            }
            
            .quotes-section {
                height: auto;
                padding: 40px 0;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        }
        
        /* Scroll animations */
        @media (prefers-reduced-motion: no-preference) {
            .project-card {
                opacity: 0;
                transform: translateY(60px);
                animation: none;
            }
            
            .project-card.visible {
                animation: slideUp 0.8s ease-out forwards;
            }
        }
        
        /* Loading shimmer effect */
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="container">
            <div class="hero-content">
                <div>
                    <h1 class="hero-title"><?php echo get_field('top_title') ?></h1>
                </div>
                <div>
                    <div class="hero-description">
                        <?php echo the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="projects-section">
        <div class="container">
            <?php 
            $args = array(
                'posts_per_page' => -1, 
                'post_type' => 'projects',
                'order' => 'ASC',
                'order_by' => 'date', 
                'post_status' => 'publish'
            );
            $projects = get_posts($args);
            if ($projects) { ?>
                <div class="projects-grid">
                    <?php foreach ($projects as $project) { ?>
                        <a href="<?php echo get_the_permalink($project->ID); ?>" class="project-card">
                            <div class="project-image">
                                <img src="<?php echo get_the_post_thumbnail_url($project->ID); ?>" alt="<?php echo get_the_title($project->ID); ?>">
                                <div class="project-icon">
                                    <img src="<?php echo get_field('project_icon', $project->ID); ?>" alt="أيقونة المشروع">
                                </div>
                            </div>
                            <div class="project-content">
                                <p class="project-description">
                                    <?php echo trunc($project->post_content, 22); ?>
                                </p>
                                <div class="project-link">
                                    <?php echo 'لمعلومات اكثر >'; ?> <i class="fas fa-arrow-left"></i>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                    
                    <?php 
                    $join_harmony = get_field('join_harmony');
                    if ($join_harmony) { ?>
                        <!-- Join Harmony Card -->
                        <div class="project-card join-card">
                            <div class="join-card-content">
                                <div>
                                    <div class="join-logo">
                                        <img src="<?php echo get_template_directory_uri() . '/images/favicon.png'; ?>" alt="لوجو هارموني" style="width: 40px; height: 40px;">
                                    </div>
                                    <h4 class="join-title"><?php echo 'إنضمـــــــــــــوا لمجــــــــــــتمع هــــــــــــارموني'; ?></h4>
                                </div>
                                <a href="<?php echo $join_harmony['url']; ?>" class="join-link">
                                    <?php echo $join_harmony['title']; ?> <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
    
    <script>
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        // Observe all project cards
        document.querySelectorAll('.project-card').forEach(card => {
            observer.observe(card);
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add loading states
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });
        
        // Parallax effect for floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.shape');
            
            shapes.forEach((shape, index) => {
                const speed = 0.5 + (index * 0.1);
                shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
            });
        });
        
        // Add hover sound effect (optional)
        document.querySelectorAll('.project-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                // Subtle feedback effect
                card.style.transform = 'translateY(-15px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });
    </script>
<?php get_footer(); ?>