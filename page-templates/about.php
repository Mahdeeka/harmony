<?php
/**
 * Template Name: About - Enhanced
 **/
?>

<?php get_header(); ?>

<style>
/* Enhanced CSS for Amazing UX/UI */
:root {
    --primary-green: #016D47;
    --secondary-beige: #EFDDCE;
    --accent-orange: #FF6B35;
    --text-dark: #2C2C2C;
    --text-light: #FFFFFF;
    --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
    --shadow-medium: 0 20px 60px rgba(0, 0, 0, 0.15);
    --gradient-green: linear-gradient(135deg, #016D47 0%, #02A86B 100%);
    --gradient-overlay: linear-gradient(45deg, rgba(1, 109, 71, 0.9), rgba(2, 168, 107, 0.8));
}

.hero-section {
    background: var(--gradient-green);
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,122.7C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') bottom center/cover no-repeat;
}

.floating-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.floating-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
}

.hero-title {
    font-size: clamp(3rem, 6vw, 5rem);
    font-weight: 800;
    background: linear-gradient(135deg, #FFFFFF, #F0F8FF);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 2rem;
    line-height: 1.1;
}

.hero-text {
    font-size: 1.25rem;
    line-height: 1.7;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    text-align: justify;
}

.image-frame {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-medium);
    transform: rotate(2deg);
    transition: all 0.6s ease;
}

.image-frame:hover {
    transform: rotate(0deg) scale(1.05);
}

.image-frame img {
    width: 100%;
    height: 450px;
    object-fit: cover;
    transition: all 0.6s ease;
}

.image-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: var(--gradient-overlay);
    color: white;
    padding: 1rem;
    font-weight: 600;
    transform: translateY(100%);
    transition: all 0.4s ease;
}

.image-frame:hover .image-caption {
    transform: translateY(0);
}

.parallax-section {
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.parallax-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(1, 109, 71, 0.3);
}

.goals-section {
    background: var(--secondary-beige);
    position: relative;
    padding: 6rem 0 3rem 0;
}

.goal-card {
    background: white;
    border-radius: 24px;
    padding: 3rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(1, 109, 71, 0.1);
    position: relative;
    overflow: hidden;
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.goal-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 4px;
    background: var(--gradient-green);
    transition: all 0.6s ease;
}

.goal-card:hover::before {
    left: 0;
}

.goal-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-medium);
}

.goal-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-green);
    margin-bottom: 1.5rem;
    position: relative;
}

.goal-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-dark);
    text-align: justify;
}

.goal-image {
    border-radius: 16px;
    height: 400px;
    background-size: cover;
    background-position: center;
    box-shadow: var(--shadow-soft);
    transition: all 0.6s ease;
    position: relative;
    overflow: hidden;
}

.goal-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 0%, rgba(1, 109, 71, 0.1) 100%);
    opacity: 0;
    transition: all 0.4s ease;
}

.goal-image:hover::before {
    opacity: 1;
}

.goal-image:hover {
    transform: scale(1.05);
}

.mini-goals-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    padding: 0;
}

.mini-goal-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    text-align: center;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(1, 109, 71, 0.1);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
}

.mini-goal-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(from 0deg, transparent, var(--primary-green), transparent);
    opacity: 0;
    transition: all 0.6s ease;
    animation: rotate 4s linear infinite;
}

.mini-goal-card:hover::before {
    opacity: 0.1;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.mini-goal-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: var(--shadow-medium);
}

.mini-goal-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1.5rem;
    filter: drop-shadow(0 4px 8px rgba(1, 109, 71, 0.3));
    transition: all 0.4s ease;
}

.mini-goal-card:hover .mini-goal-icon {
    transform: scale(1.2) rotate(10deg);
}

.section-spacer {
    height: 6rem;
    background: linear-gradient(to bottom, var(--secondary-beige), white);
}

.cta-button {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2rem;
    background: var(--primary-green);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    border: 2px solid var(--primary-green);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.cta-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.6s ease;
}

.cta-button:hover::before {
    left: 100%;
}

.cta-button:hover {
    background: #02A86B;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(1, 109, 71, 0.3);
    color: white;
    text-decoration: none;
}

/* Team Slider Styles */
.team-section {
    background: var(--primary-green);
    padding: 6rem 0;
    position: relative;
    overflow: hidden;
}

.teamContainer {
    position: relative;
    z-index: 2;
}

.team-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,122.7C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') bottom center/cover no-repeat;
}

.team-title {
    font-size: 4rem;
    font-weight: 800;
    color: white;
    text-align: center;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 2;
}

.team-description {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.teamslider {
    position: relative;
    z-index: 2;
    overflow: hidden;
    margin: 3rem 0;
}

.team-link {
    display: block;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: underline;
    font-size: 1.25rem;
    text-align: center;
    margin: 0 auto;
    width: max-content;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.team-link:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.team-member-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 1rem;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    margin: 1rem;
    height: 380px;
    width: 100%;
    max-width: 280px;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.team-member-card:hover {
    transform: translateY(-8px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.team-member-card.clickable-hover {
    cursor: pointer;
}

.team-member-card.clickable-hover::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.team-member-card.clickable-hover:hover::after {
    opacity: 1;
}

.member-image {
    width: 70%;
    height: 200px;
    margin: 0 auto 1rem;
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.4s ease;
    flex-shrink: 0;
    position: relative;
}

.member-image:hover {
    transform: scale(1.02);
    border-color: rgba(255, 255, 255, 0.6);
}

.member-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: all 0.4s ease;
}

.member-image:hover img {
    transform: scale(1.05);
}

.member-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.member-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.3rem;
    line-height: 1.2;
}

.member-network {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.3rem;
    font-weight: 600;
    line-height: 1.2;
    background: rgba(255, 255, 255, 0.1);
    padding: 3px 8px;
    border-radius: 12px;
    display: inline-block;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.member-position {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 0.3rem;
    font-weight: 500;
    line-height: 1.2;
}

.member-company {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 0.5rem;
    font-weight: 400;
    font-style: italic;
    line-height: 1.2;
}

.member-bio {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.4;
    margin-bottom: 0.8rem;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.member-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.6);
    border-radius: 12px;
}

.member-placeholder svg {
    width: 60px;
    height: 60px;
}

.member-social {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin-top: auto;
    flex-shrink: 0;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 5;
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.social-link:click {
    z-index: 10;
}

.social-link svg {
    width: 14px;
    height: 14px;
}

.social-link.instagram:hover {
    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
}

.social-link.linkedin:hover {
    background: #0077b5;
}

/* Team Slider Container */
.teamslider {
    position: relative;
    margin: 2rem 0;
    padding: 0 60px; /* Space for navigation arrows */
}

/* Team Slider Navigation */
.teamslider .slick-dots {
    display: flex !important;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 2rem 0 0 0;
    gap: 8px;
}

.teamslider .slick-dots li {
    width: 12px;
    height: 12px;
}

.teamslider .slick-dots li button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, 0.3);
    font-size: 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.teamslider .slick-dots li.slick-active button {
    background: rgba(255, 255, 255, 0.8);
    transform: scale(1.3);
}

.teamslider .slick-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 3;
    transition: all 0.3s ease;
    display: flex !important;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    opacity: 0.9;
}

.teamslider .slick-arrow:hover {
    background: white;
    transform: translateY(-50%) scale(1.1);
    opacity: 1;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.teamslider .slick-arrow:before {
    font-family: Arial, sans-serif;
    font-weight: bold;
    font-size: 16px;
    color: var(--primary-color);
    line-height: 1;
}

.teamslider .slick-prev {
    left: 10px;
}

.teamslider .slick-prev:before {
    content: '←'; /* Left arrow */
}

.teamslider .slick-next {
    right: 10px;
}

.teamslider .slick-next:before {
    content: '→'; /* Right arrow */
}

/* Swiper Navigation Styles */
.swiper-button-next,
.swiper-button-prev {
    color: var(--primary-color) !important;
    background: rgba(255, 255, 255, 0.9);
    width: 44px !important;
    height: 44px !important;
    border-radius: 50%;
    margin-top: -22px !important;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    opacity: 0.9;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: white;
    transform: scale(1.1);
    opacity: 1;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 16px !important;
    font-weight: bold;
}

.swiper-pagination {
    bottom: -10px !important;
}

.swiper-pagination-bullet {
    background: rgba(255, 255, 255, 0.3) !important;
    opacity: 1 !important;
    width: 12px !important;
    height: 12px !important;
    margin: 0 4px !important;
    transition: all 0.3s ease;
}

.swiper-pagination-bullet-active {
    background: rgba(255, 255, 255, 0.8) !important;
    transform: scale(1.3);
}

/* Mobile Navigation Adjustments */
@media (max-width: 768px) {
    .teamslider {
        padding: 0 50px;
    }
    
    .teamslider .slick-arrow {
        width: 40px;
        height: 40px;
    }
    
    .teamslider .slick-prev {
        left: 5px;
    }
    
    .teamslider .slick-next {
        right: 5px;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        width: 40px !important;
        height: 40px !important;
        margin-top: -20px !important;
    }
}

@media (max-width: 576px) {
    .teamslider {
        padding: 0 45px;
    }
    
    .teamslider .slick-arrow {
        width: 36px;
        height: 36px;
    }
    
    .teamslider .slick-arrow:before {
        font-size: 14px;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        width: 36px !important;
        height: 36px !important;
        margin-top: -18px !important;
    }
    
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 14px !important;
    }
}

/* Animations */
.fade-in-up {
    opacity: 0;
    transform: translateY(60px);
    animation: fadeInUp 1s ease-out forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stagger-animation > * {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease-out forwards;
}

.stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
.stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
.stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
.stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        min-height: 80vh;
        padding: 2rem 0;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .goal-card {
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .goal-title {
        font-size: 2rem;
    }
    
.mini-goals-grid {
    grid-template-columns: 1fr; /* This shows 1 column */
    gap: 1rem;
}

    .team-title {
        font-size: 2.5rem;
    }
    
    .team-member-card {
        padding: 1.5rem;
        margin: 0.5rem;
        height: 360px;
        max-width: 260px;
    }
    
    .member-image {
        height: 180px;
        width: 75%;
    }
    
    .member-name {
        font-size: 1rem;
    }
    
    .member-network {
        font-size: 0.75rem;
        padding: 2px 6px;
    }
    
    .member-position {
        font-size: 0.8rem;
    }
    
    .member-company {
        font-size: 0.75rem;
    }
    
    .member-bio {
        font-size: 0.7rem;
        -webkit-line-clamp: 2;
    }
    
    .social-link {
        width: 26px;
        height: 26px;
    }
    
    .social-link svg {
        width: 12px;
        height: 12px;
    }
    
    .member-placeholder svg {
        width: 50px;
        height: 50px;
    }
}

@media (max-width: 480px) {
    .team-member-card {
        height: 360px;
        max-width: 240px;
        padding: 1rem;
    }
    
    .member-image {
        height: 160px;
        width: 80%;
        margin-bottom: 0.8rem;
    }
    
    .member-name {
        font-size: 0.95rem;
    }
    
    .member-network {
        font-size: 0.7rem;
        padding: 2px 5px;
    }
    
    .member-position {
        font-size: 0.75rem;
    }
    
    .member-company {
        font-size: 0.7rem;
    }
    
    .member-bio {
        font-size: 0.65rem;
        -webkit-line-clamp: 2;
        margin-bottom: 0.8rem;
    }
    
    .social-link {
        width: 24px;
        height: 24px;
    }
    
    .social-link svg {
        width: 11px;
        height: 11px;
    }
    
    .member-placeholder svg {
        width: 45px;
        height: 45px;
    }
}
</style>

<?php $story_title = get_field('story_title'); ?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="stagger-animation">
                    <h1 class="hero-title Niloofar"><?php echo $story_title; ?></h1>
                    <div class="hero-text">
                        <?php echo get_field('story_text'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="floating-card">
                    <div class="image-frame">
                        <img src="<?php echo get_field('volunteers_image'); ?>" alt="<?php echo get_field('volunteers_image_title'); ?>">
                        <div class="image-caption">
                            <?php echo get_field('volunteers_image_title'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Parallax Audience Section -->
<?php $audience_image = get_field('audience_image');
if ($audience_image) { ?>
    <section class="parallax-section" style="background-image: url('<?php echo $audience_image; ?>')">
        <div class="floating-card text-center">
            <h3 class="goal-title" style="color: var(--primary-green); margin-bottom: 0;">Our Community</h3>
        </div>
    </section>
<?php } ?>

<!-- Goals Section -->
<?php $goals = get_field('goals');
if ($goals) { ?>
    <section class="goals-section">
        <div class="container">
            <?php $i = 1;
            foreach ($goals as $goal) { ?>
                <div class="goal-card fade-in-up" style="animation-delay: <?php echo $i * 0.2; ?>s;">
                    <div class="row align-items-center <?php if ($i % 2 == 0) echo 'flex-row-reverse'; ?>">
                        <div class="col-lg-6">
                            <h2 class="goal-title Niloofar"><?php echo $goal['title']; ?></h2>
                            <div class="goal-text"><?php echo $goal['paragraph']; ?></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="goal-image" style="background-image: url('<?php echo $goal['goal_img']; ?>')"></div>
                        </div>
                    </div>
                </div>
            <?php $i++; } ?>
        </div>
    </section>
<?php } ?>

<!-- Mini Goals Grid -->
<?php $goals2 = get_field('goals2');
if ($goals2) { ?>
    <section class="goals-section" style="padding: 0 0 6rem 0;">
        <div class="container">
            <div class="mini-goals-grid stagger-animation">
                <?php foreach ($goals2 as $goal) { ?>
                    <div class="mini-goal-card">
                        <img src="<?php echo get_template_directory_uri().'/images/favicon2.png'; ?>" alt="Harmony" class="mini-goal-icon">
                        <h4 class="goal-title Niloofar" style="font-size: 1.8rem;"><?php echo $goal['title']; ?></h4>
                        <div class="goal-text" style="margin-bottom: 1.5rem; text-align: justify;"><?php echo $goal['paragraph']; ?></div>
                        <?php if ($goal['link']) { ?>
                            <a href="<?php echo $goal['link']['url']; ?>" class="cta-button">
                                <?php echo $goal['link']['title']; ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 0.5rem;">
                                    <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- Team Members Slider -->
<?php 
// Get random team members using the same structure as Network template
$team_members_args = array(
    'post_type' => 'team',
    'posts_per_page' => 12, // Number of team members to show in slider
    'orderby' => 'rand',
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS'
        )
    )
);

$team_query = new WP_Query($team_members_args);
$random_team_members = [];

if ($team_query->have_posts()) {
    while ($team_query->have_posts()) {
        $team_query->the_post();
        
        // Calculate content length for sorting (same as Network template)
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
        $random_team_members[] = [
            'post' => $post,
            'content_length' => $content_length
        ];
    }
    
    // Sort by content length (descending - most content first)
    usort($random_team_members, function($a, $b) {
        return $b['content_length'] - $a['content_length'];
    });
}

wp_reset_postdata();

if (!empty($random_team_members)) { ?>
    <section class="team-section">
        <div class="teamContainer container c18 px-md-auto px-0" style="margin-right:0;">
            <h2 class="team-title Niloofar"><?php echo get_field('team_t') ?: ''; ?></h2>
            <div class="team-description"><?php echo get_field('team_p') ?: 'تعرف على أعضاء مجتمع هارموني المميزون'; ?></div>
            <div class="teamslider pb-md-0 pb-5 my-5">
                <?php foreach ($random_team_members as $member_data) {
                    $post = $member_data['post'];
                    setup_postdata($post);
                    
                    // Get member data using the same field structure as Network template
                    $role = get_field('role') ?: get_field('field_job_title');
                    $company = get_field('company') ?: get_field('field_university');
                    $instagram = get_field('field_instagram');
                    $linkedin = get_field('field_linkedin');
                    
                    // Fallback for social media
                    if (!$instagram && !$linkedin) {
                        $socials = get_field('socials');
                        $instagram = $socials['instagram'] ?? '';
                        $linkedin = $socials['linkedin'] ?? '';
                    }
                    
                    // Get network info for display
                    $member_networks = get_field('network');
                    $network_display = '';
                    if ($member_networks) {
                        if (is_array($member_networks)) {
                            $network_names = [];
                            foreach ($member_networks as $network) {
                                if (is_object($network)) {
                                    $network_names[] = $network->name;
                                } elseif (is_string($network)) {
                                    $network_names[] = $network;
                                } else {
                                    $network_names[] = get_the_title($network);
                                }
                            }
                            $network_display = implode(', ', array_filter($network_names));
                        } else {
                            if (is_object($member_networks)) {
                                $network_display = $member_networks->name;
                            } elseif (is_string($member_networks)) {
                                $network_display = $member_networks;
                            } else {
                                $network_display = get_the_title($member_networks);
                            }
                        }
                    }
                ?>
                    <div>
                        <div class="team-member-card" data-member-id="<?php echo get_the_ID(); ?>" data-member-name="<?php echo esc_attr(get_the_title()); ?>">
                            <div class="member-image">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php echo get_the_title(); ?>" loading="lazy">
                                <?php } else { ?>
                                    <div class="member-placeholder">
                                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="member-info">
                                <h4 class="member-name Niloofar"><?php echo get_the_title(); ?></h4>
                                <?php if ($network_display) { ?>
                                    <p class="member-network"><?php echo $network_display; ?></p>
                                <?php } ?>
                                <?php if ($role) { ?>
                                    <p class="member-position"><?php echo $role; ?></p>
                                <?php } ?>
                                <?php if ($company) { ?>
                                    <p class="member-company"><?php echo $company; ?></p>
                                <?php } ?>
                                
                                <?php 
                                // Get bio content from various fields
                                $bio_content = '';
                                if (get_field('field_personal_resume')) {
                                    $bio_content = get_field('field_personal_resume');
                                } elseif (get_field('field_pro_resume')) {
                                    $bio_content = get_field('field_pro_resume');
                                } elseif (get_field('harmony_experience')) {
                                    $bio_content = get_field('harmony_experience');
                                } elseif (get_field('field_message')) {
                                    $bio_content = get_field('field_message');
                                }
                                
                                if ($bio_content) { ?>
                                    <p class="member-bio"><?php echo wp_trim_words(strip_tags($bio_content), 12); ?></p>
                                <?php } ?>
                                
                                <?php if ($instagram || $linkedin) { ?>
                                    <div class="member-social">
                                        <?php if ($instagram) { ?>
                                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" class="social-link instagram" onclick="event.stopPropagation();">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M16 11.37C16.1234 12.2022 15.9813 13.0522 15.5938 13.799C15.2063 14.5458 14.5931 15.1514 13.8416 15.5297C13.0901 15.9079 12.2384 16.0396 11.4078 15.9059C10.5771 15.7723 9.80976 15.3801 9.21484 14.7852C8.61992 14.1902 8.22773 13.4229 8.09407 12.5922C7.9604 11.7615 8.09207 10.9099 8.47033 10.1584C8.84859 9.40685 9.45419 8.79374 10.201 8.40624C10.9478 8.01874 11.7978 7.87658 12.63 8C13.4789 8.12588 14.2649 8.52146 14.8717 9.1283C15.4785 9.73515 15.8741 10.5211 16 11.37Z" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M17.5 6.5H17.51" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        <?php } ?>
                                        <?php if ($linkedin) { ?>
                                            <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" class="social-link linkedin" onclick="event.stopPropagation();">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8V8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <rect x="2" y="9" width="4" height="12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <circle cx="4" cy="4" r="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php $link = get_field('team_link');
            if ($link) { ?>
                <a class="team-link" href="<?php echo $link['url']; ?>">
                    <?php echo $link['title']; ?>
                </a>
            <?php } else { ?>
                <!-- Default link to network page - update href to match your actual network page URL -->
                <a class="team-link" href="/الشبكة">
                    شاهد جميع الأعضاء ←
                </a>
            <?php } ?>
        </div>
    </section>
<?php } 
wp_reset_postdata(); 
?>

<!-- Call to Action Section -->
<?php $joinus_link = get_field('join_harmony_link');
if ($joinus_link) { ?>
    <div class="sectionPadding2 d-md-block d-none" style="background-color:#EFDDCE">
        <div class="container c16 bgimg d-flex align-items-center " style="border-radius:16px;height:525px;background-image:url('<?php echo get_field('join_harmony_image'); ?>')">
            <div class="px-5">
                <H4 class="fs60 sc1 Niloofar"><?php echo get_field('join_harmony_title'); ?></h4>
                <div class="fs22 my-4 sc1" style="text-align: justify;"><?php echo get_field('join_harmony_text'); ?></div>
                <a class="d-block  fbold alink" style="border-bottom:2px solid #016D47;width:max-content;max-width:100%" href="<?php echo $joinus_link['url']; ?>">
                    <?php echo $joinus_link['title']; ?>
                </a>
            </div>
        </div>
    </div>
    <div class="sectionPadding2 d-md-none d-block" style="background: linear-gradient(to bottom, #016D47 50%, #EFDDCE 50%);">
            <div class="container c16 bgimg d-flex px-0  align-items-center hauto" style="background-position:left;border-radius:16px;background-image:url('<?php echo get_field('join_harmony_image'); ?>')">
                <div class="p-4"style="height:100%;width:100%;background-color:rgba(0,0,0,0.48)">
                    <div class="">
                        <H4 class="fs60 sc1 Niloofar"><?php echo get_field('join_harmony_title'); ?></h4>
                        <div class="fs22 my-4 sc1" style="text-align: justify;"><?php echo get_field('join_harmony_text'); ?></div>
                        <a class="d-block alink fbold" href="<?php echo $joinus_link['url']; ?>">
                            <?php echo $joinus_link['title']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>

<script>
// Enhanced JavaScript for interactions
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.fade-in-up, .stagger-animation > *').forEach(el => {
        observer.observe(el);
    });

    // Smooth parallax effect
    let ticking = false;
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax-section');
        
        parallaxElements.forEach(element => {
            const speed = 0.5;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
        
        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick);
    
    // Initialize team slider (assuming you're using Slick slider)
    if (typeof $ !== 'undefined' && $.fn.slick) {
        $('.teamslider').slick({
            slidesToShow: 5,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000, // Faster movement - 2 seconds
            speed: 800, // Smooth transition speed
            arrows: true,
            dots: true,
            infinite: true,
            rtl: true, // For Arabic/RTL content
            pauseOnHover: false, // Don't pause on hover
            pauseOnFocus: false, // Don't pause on focus
            centerMode: false,
            variableWidth: false,
            adaptiveHeight: false,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplaySpeed: 2500
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        autoplaySpeed: 3000
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplaySpeed: 3000,
                        centerMode: true,
                        centerPadding: '20px'
                    }
                }
            ]
        });
    }
    
    // Alternative: If using Swiper slider
    if (typeof Swiper !== 'undefined') {
        new Swiper('.teamslider', {
            slidesPerView: 5,
            spaceBetween: 20,
            loop: true,
            speed: 800, // Transition speed
            autoplay: {
                delay: 2000, // Faster movement - 2 seconds
                disableOnInteraction: false,
                pauseOnMouseEnter: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 15,
                    centeredSlides: true
                },
                576: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20
                },
                1400: {
                    slidesPerView: 5,
                    spaceBetween: 20
                }
            }
        });
    }
    
    // Add click functionality to team member cards
    $(document).on('click', '.team-member-card', function(e) {
        // Don't redirect if clicking on social links
        if ($(e.target).closest('.social-link').length > 0) {
            return;
        }
        
        // Get member data
        const memberId = $(this).data('member-id');
        const memberName = $(this).data('member-name');
        
        // Redirect to network page
        // Update this URL to match your actual network page URL
        const networkUrl = '/الشبكة'; // Arabic network page URL (change to '/network' if using English URL)
        
        // You can also add a search parameter to highlight this member
        const searchParam = memberName ? '?search=' + encodeURIComponent(memberName) : '';
        
        window.location.href = networkUrl + searchParam;
    });
    
    // Add visual feedback when hovering over clickable cards
    $(document).on('mouseenter', '.team-member-card', function() {
        $(this).addClass('clickable-hover');
    }).on('mouseleave', '.team-member-card', function() {
        $(this).removeClass('clickable-hover');
    });
});
</script>

<?php get_footer(); ?>