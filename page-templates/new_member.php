<?php
/**
 * Template Name: Enhanced Multi-Step Registration Form - Fixed
 **/
?>

<?php get_header(); ?>

<div class="pb-5 sectionPadding3 bg2">
    <!-- Enhanced Loading Overlay -->
    <div id="lottieLoader" class="lottie-loader-overlay" style="display:none;">
        <div class="loader-content">
            <iframe src="https://cdn.lottielab.com/l/AUegnTHZGrJW9z.html" width="212" height="212" frameborder="0"></iframe>
            <div class="loader-text">جاري المعالجة...</div>
        </div>
    </div>

    <div class="container c12 py-md-5 py-4">

        <!-- Enhanced Intro Section -->
        <div id="start_section">
            <div class="intro-animation">
                <h4 class="h1 text-center fs60 Tajawal fbold sc1 fade-in"><?php echo get_field('main_title'); ?></h4>
                <div class="text-center my-4 sc1 Tajawal fs25 fade-in-delay-1">
                    <?php echo get_field('main_paragraph'); ?>
                </div>
                <div class="fade-in-delay-2">
                    <a href="#" id="start_form" class="mylink2 enhanced-btn mx-auto d-flex align-items-center fs25 Tajawal">
                        <span><?php echo 'ابدأ التسجيل'; ?></span>
                        <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                    </a>
                </div>
                <div class="text-center mt-5 fs18 Tajawal sc1 fade-in-delay-3">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <!-- Enhanced Multistep Form Section -->
        <div id="form_section" style="display: none;">
            <!-- Improved Progress Bar -->
            <div class="step-bar text-center mb-5">
                <div class="progress-container-new">
                    <div class="progress-line-new" id="progressLine"></div>
                    <div class="steps-wrapper">
                        <div class="step-item active" data-step="1">
                            <div class="step-circle-new">
                                <span class="step-number">1</span>
                                <div class="step-check">✓</div>
                            </div>
                            <span class="step-label-new">البيانات الشخصية</span>
                        </div>
                        <div class="step-item" data-step="2">
                            <div class="step-circle-new">
                                <span class="step-number">2</span>
                                <div class="step-check">✓</div>
                            </div>
                            <span class="step-label-new">المهنية والأكاديمية</span>
                        </div>
                        <div class="step-item" data-step="3">
                            <div class="step-circle-new">
                                <span class="step-number">3</span>
                                <div class="step-check">✓</div>
                            </div>
                            <span class="step-label-new">تجربة هارموني</span>
                        </div>
                        <div class="step-item" data-step="4">
                            <div class="step-circle-new">
                                <span class="step-number">4</span>
                                <div class="step-check">✓</div>
                            </div>
                            <span class="step-label-new">مراجعة وإرسال</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Validation Alert -->
            <div id="validationAlert" class="simple-validation-alert">
                <div class="simple-alert-content">
                    <div class="alert-header">
                        <span class="alert-icon">⚠️</span>
                        <strong>يرجى إكمال ما يلي:</strong>
                        <button type="button" class="simple-close" onclick="hideValidationAlert()">×</button>
                    </div>
                    <ul id="missingFields" class="missing-list"></ul>
                </div>
            </div>

            <form id="multiStepForm" novalidate class="Tajawal w-75 mx-auto mw100">
                <!-- Step 1: Personal Information -->
                <div class="form-step" data-step="1">
                    <h2 class="text-center my-4 sc1 step-title">أدخل تفاصيلك الشخصية</h2>
                    
                    <!-- Compact Form Fields -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="text" name="full_name" placeholder="الاسم الكامل *" required class="form-control enhanced-input" autocomplete="name">
                                <div class="field-feedback" id="full_name_feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="text" name="job_title" placeholder="تعريفك المهني *" required class="form-control enhanced-input" autocomplete="organization-title">
                                <div class="field-feedback" id="job_title_feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="text" name="university" placeholder="الشركة/الجامعة" class="form-control enhanced-input" autocomplete="organization">
                                <div class="field-feedback" id="university_feedback"></div>
                            </div>
                        </div>
                        
                        <!-- Fixed Birth Date Input -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced position-relative">
                                <input type="text" name="birth_date" id="birthDateInput" placeholder="تاريخ ميلادك * (DD/MM/YYYY)" required class="form-control enhanced-input birth-date-input" maxlength="10" autocomplete="bday">
                                <div class="date-format-helper">DD/MM/YYYY</div>
                                <div class="field-feedback" id="birth_date_feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="email" name="email" placeholder="البريد الإلكتروني *" required class="form-control enhanced-input" autocomplete="email">
                                <div class="field-feedback" id="email_feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="tel" name="phone" placeholder="رقم الهاتف *" required class="form-control enhanced-input" autocomplete="tel">
                                <div class="field-feedback" id="phone_feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="text" name="origin_country" placeholder="بلد السكن الأصلي *" required class="form-control enhanced-input" autocomplete="country">
                                <div class="field-feedback" id="origin_country_feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group-enhanced">
                                <input type="text" name="current_country" placeholder="بلد السكن الحالي" class="form-control enhanced-input" autocomplete="country">
                                <div class="field-feedback" id="current_country_feedback"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Icon-Only Social Media Section -->
                    <div class="social-media-icons mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="social-input-icon">
                                    <div class="social-icon-wrapper">
                                        <img class="social-icon-only" src="<?php echo get_template_directory_uri() . '/images/instagramframe.png'; ?>" alt="Instagram">
                                    </div>
                                    <input type="text" name="instagram" placeholder="@username" class="form-control enhanced-input">
                                    <div class="field-feedback" id="instagram_feedback"></div>
                                    <div class="social-option-icon">
                                        <label class="checkbox-container-icon">
                                            <input type="checkbox" id="noInstagram" onchange="toggleInstagramField(this.checked)">
                                            <span class="checkmark-icon"></span>
                                            <span class="checkbox-text-icon">لا يوجد</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="social-input-icon">
                                    <div class="social-icon-wrapper">
                                        <img class="social-icon-only" src="<?php echo get_template_directory_uri() . '/images/linkedinframe.png'; ?>" alt="LinkedIn">
                                    </div>
                                    <input type="url" name="linkedin" placeholder="linkedin.com/in/username" class="form-control enhanced-input">
                                    <div class="field-feedback" id="linkedin_feedback"></div>
                                    <div class="social-option-icon">
                                        <label class="checkbox-container-icon">
                                            <input type="checkbox" id="noLinkedIn" onchange="toggleLinkedInField(this.checked)">
                                            <span class="checkmark-icon"></span>
                                            <span class="checkbox-text-icon">لا يوجد</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Compact Image Upload Section -->
                    <div class="image-upload-compact text-center mb-4">
                        <label class="upload-label-compact sc1 fbold fs18">صورة شخصية للموقع *</label>
                        <div class="compact-upload-container">
                            <div class="upload-area-compact" id="uploadArea">
                                <div class="upload-placeholder" id="placeholder">
                                    <div class="upload-icon-compact">📷</div>
                                    <div class="upload-text-compact">اضغط أو اسحب صورة</div>
                                </div>
                                <div class="image-preview" id="imagePreview" style="display: none;">
                                    <img id="profileImage" alt="Profile Preview">
                                </div>
                            </div>
                            
                            <!-- Compact Controls -->
                            <div class="image-controls-compact" id="imageControls" style="display: none;">
                                <div class="position-controls-compact">
                                    <input type="range" id="positionX" min="0" max="100" value="50" class="position-slider-compact">
                                    <input type="range" id="positionY" min="0" max="100" value="50" class="position-slider-compact">
                                </div>
                                <div class="image-buttons-compact">
                                    <button type="button" class="btn-compact" onclick="centerImage()">توسيط</button>
                                    <button type="button" class="btn-compact" onclick="removeImage()">حذف</button>
                                    <button type="button" class="btn-compact" onclick="document.getElementById('fileInput').click()">تغيير</button>
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" name="profile_image" id="fileInput" class="file-input" accept="image/*">
                        <div id="uploadError" class="upload-feedback"></div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" class="mylink2 enhanced-btn pointer mx-auto d-flex align-items-center fs20 Tajawal next-step">
                            <span>التالي</span>
                            <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                        </button>
                    </div>
                </div>

                <!-- Step 2: Professional Information -->
                <div class="form-step" data-step="2" style="display:none">
                    <h2 class="text-center my-4 sc1 step-title">أدخل تفاصيلك المهنية والأكاديمية</h2>
                    
                    <!-- Compact TextAreas -->
                    <div class="form-group-enhanced mb-3 sc1">
                        <label class="enhanced-label-compact sc1 fbold fs18">
                            سيرتك الذاتية الأكاديمية *
                            <span class="info-tooltip-compact" data-tooltip="مثال: حاصل على لقب أول بموضوع @ من جامعة @">ⓘ</span>
                        </label>
                        <textarea name="edu_resume" placeholder="• حاصل على شهادة البكالوريوس في...&#10;• تخرجت من جامعة..." rows="4" required class="form-control enhanced-textarea-compact" data-max="1000"></textarea>
                        
                        <!-- Fixed Word Progress Indicator -->
                        <div class="word-progress-compact">
                            <div class="word-progress-bar-compact">
                                <div class="word-progress-fill" id="edu_resume_progress"></div>
                                <div class="word-progress-markers-compact">
                                    <span class="marker-compact" data-words="5">5</span>
                                    <span class="marker-compact" data-words="20">20</span>
                                    <span class="marker-compact" data-words="40">40</span>
                                    <span class="marker-compact" data-words="60">60</span>
                                </div>
                            </div>
                            <div class="word-counter-compact">
                                <span class="word-count" id="edu_resume_count">0</span> كلمة
                                <span class="character-count">(<span id="edu_resume_chars">0</span>/1000 حرف)</span>
                            </div>
                        </div>
                        <div class="field-feedback" id="edu_resume_feedback"></div>
                    </div>

                    <div class="form-group-enhanced mb-3 sc1">
                        <label class="enhanced-label-compact sc1 fbold fs18">
                            سيرتك الذاتية المهنية *
                            <span class="info-tooltip-compact" data-tooltip="مثال: عملت في شركة @ في منصب @">ⓘ</span>
                        </label>
                        <textarea name="pro_resume" placeholder="• وظيفتي الحالية في شركة...&#10;• خبرة في مجال..." rows="4" required class="form-control enhanced-textarea-compact" data-max="1000"></textarea>
                        
                        <div class="word-progress-compact">
                            <div class="word-progress-bar-compact">
                                <div class="word-progress-fill" id="pro_resume_progress"></div>
                                <div class="word-progress-markers-compact">
                                    <span class="marker-compact" data-words="5">5</span>
                                    <span class="marker-compact" data-words="20">20</span>
                                    <span class="marker-compact" data-words="40">40</span>
                                    <span class="marker-compact" data-words="60">60</span>
                                </div>
                            </div>
                            <div class="word-counter-compact">
                                <span class="word-count" id="pro_resume_count">0</span> كلمة
                                <span class="character-count">(<span id="pro_resume_chars">0</span>/1000 حرف)</span>
                            </div>
                        </div>
                        <div class="field-feedback" id="pro_resume_feedback"></div>
                    </div>

                    <div class="form-group-enhanced mb-3 sc1">
                        <label class="enhanced-label-compact sc1 fbold fs18">
                            سيرتك الذاتية الشخصية *
                            <span class="info-tooltip-compact" data-tooltip="مثال: أحب الرياضة، أتحدث 3 لغات">ⓘ</span>
                        </label>
                        <textarea name="personal_resume" placeholder="• أحب ممارسة...&#10;• أتحدث اللغات...&#10;• مهتم بمجال..." rows="4" required class="form-control enhanced-textarea-compact" data-max="1000"></textarea>
                        
                        <div class="word-progress-compact">
                            <div class="word-progress-bar-compact">
                                <div class="word-progress-fill" id="personal_resume_progress"></div>
                                <div class="word-progress-markers-compact">
                                    <span class="marker-compact" data-words="5">5</span>
                                    <span class="marker-compact" data-words="20">20</span>
                                    <span class="marker-compact" data-words="40">40</span>
                                    <span class="marker-compact" data-words="60">60</span>
                                </div>
                            </div>
                            <div class="word-counter-compact">
                                <span class="word-count" id="personal_resume_count">0</span> كلمة
                                <span class="character-count">(<span id="personal_resume_chars">0</span>/1000 حرف)</span>
                            </div>
                        </div>
                        <div class="field-feedback" id="personal_resume_feedback"></div>
                    </div>

                    <!-- Compact Skills Section -->
                    <div class="form-group-enhanced">
                        <label class="enhanced-label-compact sc1 d-block fbold fs18 text-center">اذكر مهاراتك *</label>
                        <div class="skills-section-compact">
                            <div class="skill-trigger-compact" onclick="openSkillsModal()">
                                <span class="trigger-text">أضف مهارة</span>
                                <span class="plus-icon-compact">+</span>
                            </div>
                            <div id="displaySelectedSkills" class="skills-display-compact mt-3 d-flex flex-wrap justify-content-center" style="gap:8px;"></div>
                            <div class="field-feedback" id="skills_feedback"></div>
                        </div>
                    </div>

                    <input type="hidden" name="selected_skills" id="selected_skills">
                    <input type="hidden" name="new_skills" id="new_skills">

                    <div class="text-center mt-4 d-flex align-items-center justify-content-center" style="gap:10px;">
                        <button type="button" class="mylink3 enhanced-btn pointer d-flex align-items-center fs20 Tajawal prev-step">
                            <span>السابق</span>
                        </button>
                        <button type="button" class="mylink2 enhanced-btn pointer d-flex align-items-center fs20 Tajawal next-step">
                            <span>التالي</span>
                            <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                        </button>
                    </div>
                </div>

                <!-- Step 3: Harmony Experience -->
                <div class="form-step" data-step="3" style="display:none">
                    <h2 class="text-center my-4 sc1 step-title">هل لديك تجربة مع هارموني؟</h2>
                    
                    <div class="form-group text-center mb-3">
                        <div class="toggle-switch-experience">
                            <input type="checkbox" id="experienceSwitch" onchange="toggleExperienceFields(this.checked)">
                            <label for="experienceSwitch">
                                <span class="toggle-option yes">نعم</span>
                                <span class="toggle-option no">لا</span>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div id="experienceDetails" style="display:none">
                        <div class="form-group text-center mb-4">
                            <label class="enhanced-label-compact d-block my-2 sc1 fbold fs18">في أي برامج شاركت؟</label>
                            <div class="projects-grid d-flex flex-wrap mx-auto justify-content-center w-75 mw100 mt-3" style="gap:10px">
                                <?php if (have_rows('projects')): while (have_rows('projects')): the_row();
                                        $project = get_sub_field('project'); ?>
                                        <button type="button" class="btn project-btn enhanced-project-btn sc1" onclick="toggleProject(this)"><?php echo esc_html($project); ?></button>
                                <?php endwhile;
                                endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group-enhanced">
                            <label class="enhanced-label-compact d-block my-2 sc1 fbold fs18 text-center">اترك لنا رسالة</label>
                            <textarea name="harmony_experience" rows="3" class="form-control enhanced-textarea-compact" placeholder="ماذا أضاف لك وجودك في هارموني؟" data-max="500"></textarea>
                            
                            <div class="word-progress-compact">
                                <div class="word-progress-bar-compact">
                                    <div class="word-progress-fill" id="harmony_experience_progress"></div>
                                </div>
                                <div class="word-counter-compact">
                                    <span class="word-count" id="harmony_experience_count">0</span> كلمة
                                    <span class="character-count">(<span id="harmony_experience_chars">0</span>/500 حرف)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4 d-flex align-items-center justify-content-center" style="gap:10px;">
                        <button type="button" class="mylink3 enhanced-btn pointer d-flex align-items-center fs20 Tajawal prev-step">
                            <span>السابق</span>
                        </button>
                        <button type="button" class="mylink2 enhanced-btn pointer d-flex align-items-center fs20 Tajawal next-step">
                            <span>التالي</span>
                            <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                        </button>
                    </div>
                </div>

                <!-- Step 4: Review and Submit -->
                <div class="form-step" data-step="4" style="display:none">
                    <h2 class="text-center my-4 sc1 step-title">مراجعة التفاصيل وإرسالها</h2>
                    <div id="reviewContent" class="review-section p-4 rounded text-center">
                        <p class="review-placeholder">ستظهر تفاصيلك هنا للمراجعة قبل الإرسال.</p>
                    </div>
                    
                    <div class="text-center mt-4">
                        <div class="confirmation-checkbox mb-4">
                            <label class="checkbox-container">
                                <input type="checkbox" id="confirmSubmission" required>
                                <span class="checkmark"></span>
                                <span class="checkbox-text">أؤكد صحة البيانات المدخلة وموافقتي على <a href="#" class="terms-link">شروط الاستخدام</a></span>
                            </label>
                        </div>
                        
                        <div class="text-center mt-4 d-flex align-items-center justify-content-center" style="gap:10px;">
                            <button type="button" class="mylink3 enhanced-btn pointer d-flex align-items-center fs20 Tajawal prev-step">
                                <span>السابق</span>
                            </button>
                            <button type="submit" class="mylink2 enhanced-btn submit-btn pointer d-flex align-items-center fs20 Tajawal">
                                <span>حفظ وإرسال</span>
                                <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Enhanced Success Message -->
        <div id="success_message" style="display:none;" class="success-section text-center Tajawal">
            <div class="success-animation">
                <div class="success-checkmark">
                    <div class="check-icon">
                        <span class="icon-line line-tip"></span>
                        <span class="icon-line line-long"></span>
                        <div class="icon-circle"></div>
                        <div class="icon-fix"></div>
                    </div>
                </div>
                <img src="<?php echo get_field('succ_icon'); ?>" alt="Success Icon" style="width:90px;" class="mb-4 success-icon">
                <h2 class="sc1 fbold fs40 success-title"><?php echo get_field('succ_t'); ?></h2>
                <p class="fs20 sc1 mb-4 success-text">
                    <?php echo get_field('succ_p'); ?>
                </p>
                <div class="d-flex justify-content-center mt-4" style="gap:10px">
                    <a href="/" class="mylink3 enhanced-btn">الصفحة الرئيسية</a>
                    <a href="/الشبكة" class="mylink2 enhanced-btn">تصفح الشبكة 🧠</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hebrew Detection Modal -->
<div class="hebrew-modal" id="hebrewModal">
    <div class="hebrew-modal-content">
        <div class="hebrew-header">
            <h4>تم اكتشاف نص بالعبرية</h4>
            <button type="button" class="close-hebrew" onclick="closeHebrewModal()">×</button>
        </div>
        
        <div class="hebrew-body">
            <p class="hebrew-text">يُفضل استخدام اللغة العربية أو الإنجليزية في النموذج</p>
            
            <div class="hebrew-actions">
                <button type="button" onclick="continueWithHebrew()" class="continue-hebrew-btn">أكمل مع العبري</button>
                <button type="button" onclick="changeToArabicEnglish()" class="change-lang-btn">سأغير إلى العربية/الإنجليزية</button>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Skills Popup Modal -->
<div class="skills-popup" id="skillsPopup">
    <div class="skills-popup-content">
        <div class="popup-header">
            <h4>أضف مهارات</h4>
            <button type="button" class="close-popup" onclick="closeSkillsModal()">×</button>
        </div>
        
        <div class="popup-body">
            <div class="skill-search-section">
                <div class="search-input-group">
                    <input type="text" id="skillSearchInput" placeholder="ابحث عن مهارة...">
                    <span class="search-icon">🔍</span>
                </div>
            </div>
            
            <div class="add-skill-section">
                <div class="d-flex align-items-center">
                    <input type="text" id="newSkillInput" placeholder="أضف مهارة جديدة">
                    <button type="button" onclick="addSkill()" class="add-skill-btn">+</button>
                </div>
            </div>

            <div class="skills-categories">
                <div class="category-tabs">
                    <button class="category-tab active" onclick="showCategory('all')">الكل</button>
                    <button class="category-tab" onclick="showCategory('tech')">تقني</button>
                    <button class="category-tab" onclick="showCategory('business')">إداري</button>
                    <button class="category-tab" onclick="showCategory('creative')">إبداعي</button>
                </div>
                
                <div class="skills-grid" id="skillsGrid">
                    <?php
                    $skills = get_posts([
                        'post_type' => 'skill',
                        'post_status' => 'publish',
                        'numberposts' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ]);
                    foreach ($skills as $skill) {
                        echo '<button type="button" class="skill-btn" onclick="toggleSkill(this)">' . esc_html($skill->post_title) . '</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="popup-actions">
            <button type="button" onclick="clearAllSkills()" class="clear-btn">مسح الكل</button>
            <button type="button" onclick="saveSkills()" class="save-btn">✓ حفظ المهارات</button>
        </div>
    </div>
</div>

<style>
/* Enhanced Global Styles */
* {
    box-sizing: border-box;
}

body {
    overflow-x: hidden;
}

.file-input {
    display: none;
}

.upload-area.drag-over {
    border-color: #c6e5d2;
    background: rgba(198, 229, 210, 0.2);
    transform: scale(1.05);
}

/* Enhanced Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.8) translateY(-50px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes progressFill {
    from { width: 0%; }
    to { width: var(--target-width, 0%); }
}

.fade-in {
    animation: fadeIn 0.8s ease-out;
}

.fade-in-delay-1 {
    animation: fadeIn 0.8s ease-out 0.2s both;
}

.fade-in-delay-2 {
    animation: fadeIn 0.8s ease-out 0.4s both;
}

.fade-in-delay-3 {
    animation: fadeIn 0.8s ease-out 0.6s both;
}

/* Enhanced Loader */
.lottie-loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 99999;
    width: 100vw;
    height: 100vh;
    background: rgba(15, 81, 50, 0.95);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader-content {
    text-align: center;
    color: #F3E5D9;
}

.loader-text {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    animation: pulse 2s infinite;
}

/* Enhanced Progress Bar */
.progress-container {
    position: relative;
    width: 100%;
    margin-bottom: 30px;
}

.progress-line {
    position: absolute;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
    height: 4px;
    background: linear-gradient(90deg, #F3E5D9, #c6e5d2);
    width: 0%;
    transition: width 0.8s ease;
    border-radius: 2px;
    z-index: 1;
}

.stepwrap {
    min-width: 120px;
    position: relative;
    z-index: 2;
}

.stepwrap::before {
    position: absolute;
    top: 15px;
    width: 100%;
    left: 0;
    height: 2px;
    background-color: rgba(243, 229, 217, 0.3);
    content: "";
    z-index: 0;
}

.stepwrap:last-of-type::before {
    display: none;
}

.step-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 3px solid rgba(243, 229, 217, 0.5);
    background-color: #0f5132;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.3s ease;
    cursor: pointer;
}

.step-circle:hover {
    transform: scale(1.1);
}

.step-number {
    color: #F3E5D9;
    font-weight: bold;
    font-size: 14px;
}

.step-check {
    position: absolute;
    color: #F3E5D9;
    font-size: 16px;
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
}

.step-circle.active {
    background-color: #F3E5D9;
    border-color: #F3E5D9;
    transform: scale(1.1);
    box-shadow: 0 0 20px rgba(243, 229, 217, 0.5);
}

.step-circle.active .step-number {
    color: #0f5132;
}

.step-circle.completed .step-number {
    opacity: 0;
}

.step-circle.completed .step-check {
    opacity: 1;
    transform: scale(1);
}

.step-circle.completed {
    background-color: #28a745;
    border-color: #28a745;
}

.step-label {
    max-width: 100px;
    font-size: 14px;
    text-align: center;
    transition: color 0.3s ease;
}

.stepwrap[data-step] .step-label {
    color: rgba(243, 229, 217, 0.7);
}

.stepwrap.active .step-label {
    color: #F3E5D9;
    font-weight: bold;
}

.stepwrap.completed .step-label {
    color: #28a745;
    font-weight: bold;
}

/* Simple Validation Alert */
.simple-validation-alert {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(3px);
}

.simple-validation-alert.show {
    display: flex;
    animation: fadeIn 0.3s ease;
}

.simple-alert-content {
    background: #fff;
    color: #333;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    max-width: 400px;
    width: 90%;
    margin: 20px;
    animation: modalSlideIn 0.4s ease;
}

.alert-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.alert-header .alert-icon {
    font-size: 24px;
    margin-right: 8px;
}

.alert-header strong {
    color: #e74c3c;
    font-size: 16px;
    flex: 1;
}

.simple-close {
    background: #f0f0f0;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 18px;
    cursor: pointer;
    color: #666;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.simple-close:hover {
    background: #e74c3c;
    color: white;
    transform: rotate(90deg);
}

.missing-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.missing-list li {
    padding: 8px 12px;
    margin-bottom: 5px;
    background: #fff5f5;
    border-right: 3px solid #e74c3c;
    border-radius: 5px;
    font-size: 14px;
    color: #666;
}

/* Improved Progress Bar */
.progress-container-new {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

.progress-line-new {
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 3px;
    background: rgba(243, 229, 217, 0.3);
    border-radius: 3px;
    z-index: 1;
}

.progress-line-new::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: linear-gradient(90deg, #F3E5D9, #c6e5d2);
    border-radius: 3px;
    width: 0%;
    transition: width 0.8s ease;
    z-index: 2;
}

.steps-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    position: relative;
    z-index: 3;
}

.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    position: relative;
}

.step-circle-new {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #0f5132;
    border: 3px solid rgba(243, 229, 217, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.4s ease;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.step-circle-new:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.step-number {
    color: #F3E5D9;
    font-weight: bold;
    font-size: 16px;
    z-index: 2;
}

.step-check {
    position: absolute;
    color: #F3E5D9;
    font-size: 18px;
    opacity: 0;
    transform: scale(0);
    transition: all 0.4s ease;
    z-index: 2;
}

.step-item.active .step-circle-new {
    background: linear-gradient(135deg, #F3E5D9, #c6e5d2);
    border-color: #F3E5D9;
    transform: scale(1.15);
    box-shadow: 0 0 20px rgba(243, 229, 217, 0.6);
}

.step-item.active .step-number {
    color: #0f5132;
}

.step-item.completed .step-circle-new {
    background: linear-gradient(135deg, #28a745, #20c997);
    border-color: #28a745;
}

.step-item.completed .step-number {
    opacity: 0;
}

.step-item.completed .step-check {
    opacity: 1;
    transform: scale(1);
}

.step-label-new {
    margin-top: 12px;
    font-size: 13px;
    font-weight: 600;
    color: rgba(243, 229, 217, 0.7);
    text-align: center;
    transition: all 0.3s ease;
    min-height: 32px;
    display: flex;
    align-items: center;
    max-width: 80px;
    line-height: 1.2;
}

.step-item.active .step-label-new {
    color: #F3E5D9;
    font-weight: bold;
}

.step-item.completed .step-label-new {
    color: #28a745;
    font-weight: bold;
}

/* Icon-Only Social Media */
.social-media-icons {
    background: rgba(243, 229, 217, 0.05);
    border-radius: 12px;
    padding: 20px;
}

.social-input-icon {
    position: relative;
    background: rgba(243, 229, 217, 0.1);
    border-radius: 12px;
    padding: 15px;
    text-align: center;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.social-input-icon:hover {
    background: rgba(243, 229, 217, 0.15);
    border-color: rgba(243, 229, 217, 0.3);
    transform: translateY(-2px);
}

.social-icon-wrapper {
    margin-bottom: 12px;
    display: flex;
    justify-content: center;
}

.social-icon-only {
    width: 40px;
    height: 40px;
    transition: all 0.3s ease;
}

.social-icon-only:hover {
    transform: scale(1.1);
}

.social-input-icon .enhanced-input {
    margin-bottom: 10px;
}

.social-option-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 8px;
}

.checkbox-container-icon {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #F3E5D9;
    font-size: 12px;
    gap: 6px;
}

.checkbox-container-icon input {
    display: none;
}

.checkmark-icon {
    width: 16px;
    height: 16px;
    border: 2px solid #F3E5D9;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.checkbox-container-icon input:checked ~ .checkmark-icon {
    background: #F3E5D9;
    color: #0f5132;
}

.checkbox-container-icon input:checked ~ .checkmark-icon::after {
    content: '✓';
    font-weight: bold;
    font-size: 10px;
}

.checkbox-text-icon {
    font-size: 12px;
    font-weight: 500;
}

/* Enhanced Form Inputs */
.form-group-enhanced {
    position: relative;
    margin-bottom: 15px;
}

.enhanced-input {
    background-color: rgba(30, 113, 84, 0.2);
    color: #F3E5D9 !important;
    border: 2px solid rgba(243, 229, 217, 0.3);
    border-radius: 12px;
    font-size: 16px;
    padding: 12px 18px;
    transition: all 0.3s ease;
    width: 100%;
    backdrop-filter: blur(5px);
}

.enhanced-input:focus {
    background-color: rgba(30, 113, 84, 0.4) !important;
    box-shadow: 0 0 20px rgba(243, 229, 217, 0.3);
    color: #F3E5D9 !important;
    border-color: #F3E5D9;
    outline: 0;
    transform: translateY(-2px);
}

.enhanced-input::placeholder {
    color: rgba(243, 229, 217, 0.7) !important;
    transition: all 0.3s ease;
}

.enhanced-input:focus::placeholder {
    opacity: 0.5;
}

.enhanced-textarea-compact {
    background: rgba(30, 113, 84, 0.4);
    color: #F3E5D9 !important;
    border: 2px solid rgba(243, 229, 217, 0.3);
    border-radius: 12px;
    padding: 15px;
    font-size: 15px;
    transition: all 0.3s ease;
    resize: vertical;
    min-height: 90px;
    width: 100%;
    backdrop-filter: blur(5px);
}

.enhanced-textarea-compact:focus {
    border-color: #F3E5D9;
    background: rgba(30, 113, 84, 0.6);
    box-shadow: 0 0 20px rgba(243, 229, 217, 0.2);
    transform: translateY(-2px);
    color: #F3E5D9 !important;
}

.enhanced-textarea-compact::placeholder {
    color: rgba(243, 229, 217, 0.7) !important;
    line-height: 1.6;
}

/* Enhanced Birth Date Input */
.birth-date-input {
    direction: ltr;
    text-align: right;
    letter-spacing: 1px;
    font-family: 'Courier New', monospace;
}

.date-format-helper {
    position: absolute;
    top: -25px;
    right: 0;
    font-size: 12px;
    color: rgba(243, 229, 217, 0.6);
    font-weight: bold;
}

/* Fixed Word Progress Indicator */
.word-progress-compact {
    margin-top: 8px;
    padding: 10px;
    background: rgba(243, 229, 217, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(243, 229, 217, 0.1);
}

.word-progress-bar-compact {
    position: relative;
    height: 6px;
    background: rgba(243, 229, 217, 0.2);
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 8px;
}

.word-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #e74c3c, #f39c12, #f1c40f, #2ecc71, #27ae60);
    border-radius: 8px;
    transition: all 0.5s ease;
    width: 0%;
    position: relative;
}

.word-progress-fill::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.word-progress-markers-compact {
    position: absolute;
    top: -4px;
    left: 0;
    right: 0;
    height: 14px;
    pointer-events: none;
}

.word-progress-markers-compact .marker-compact {
    position: absolute;
    font-size: 9px;
    color: #F3E5D9;
    font-weight: bold;
    transform: translateX(-50%);
    background: rgba(15, 81, 50, 0.9);
    padding: 1px 4px;
    border-radius: 8px;
    border: 1px solid rgba(243, 229, 217, 0.3);
}

/* Fixed positioning: Start from 5 words and go to 60 */
.word-progress-markers-compact .marker-compact[data-words="5"] {
    left: 0%;
}

.word-progress-markers-compact .marker-compact[data-words="20"] {
    left: 27%;
}

.word-progress-markers-compact .marker-compact[data-words="40"] {
    left: 63%;
}

.word-progress-markers-compact .marker-compact[data-words="60"] {
    left: 100%;
}

.word-counter-compact {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #F3E5D9;
    font-size: 12px;
}

.word-count {
    font-weight: bold;
    font-size: 14px;
}

.character-count {
    opacity: 0.7;
    font-size: 11px;
}

/* Compact Social Media Styles */
.social-media-compact {
    background: rgba(243, 229, 217, 0.05);
    border-radius: 12px;
    padding: 15px;
}

.social-input-compact {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.social-icon-small {
    width: 30px;
    height: 30px;
    flex-shrink: 0;
}

.social-input-compact .enhanced-input {
    flex: 1;
    margin-bottom: 0;
}

.social-option-compact {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 5px;
}

.checkbox-container-compact {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #F3E5D9;
    font-size: 12px;
    gap: 5px;
}

.checkbox-container-compact input {
    display: none;
}

.checkmark-compact {
    width: 16px;
    height: 16px;
    border: 2px solid #F3E5D9;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.checkbox-container-compact input:checked ~ .checkmark-compact {
    background: #F3E5D9;
    color: #0f5132;
}

.checkbox-container-compact input:checked ~ .checkmark-compact::after {
    content: '✓';
    font-weight: bold;
    font-size: 10px;
}

.checkbox-text-compact {
    font-size: 12px;
}

/* Compact Image Upload */
.image-upload-compact {
    background: rgba(243, 229, 217, 0.05);
    border-radius: 12px;
    padding: 15px;
}

.upload-label-compact {
    display: block;
    margin-bottom: 10px;
    color: #F3E5D9;
    font-weight: bold;
}

.compact-upload-container {
    max-width: 300px;
    margin: 0 auto;
}

.upload-area-compact {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    border-radius: 12px;
    overflow: hidden;
    border: 3px dashed rgba(243, 229, 217, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: rgba(243, 229, 217, 0.05);
    position: relative;
}

.upload-area-compact:hover {
    border-color: #F3E5D9;
    background: rgba(243, 229, 217, 0.1);
    transform: scale(1.02);
}

.upload-area-compact.has-image {
    border-style: solid;
    border-width: 2px;
    border-color: #F3E5D9;
    cursor: default;
}

.image-preview {
    width: 100%;
    height: 100%;
    position: relative;
}

.image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 9px;
    transition: all 0.3s ease;
}

.upload-placeholder {
    text-align: center;
    color: rgba(243, 229, 217, 0.8);
}

.upload-icon-compact {
    font-size: 32px;
    margin-bottom: 8px;
    display: block;
}

.upload-text-compact {
    font-size: 12px;
    font-weight: bold;
}

.image-controls-compact {
    margin-top: 15px;
    background: rgba(243, 229, 217, 0.1);
    padding: 12px;
    border-radius: 10px;
    border: 1px solid rgba(243, 229, 217, 0.2);
}

.position-controls-compact {
    display: flex;
    gap: 8px;
    margin-bottom: 10px;
}

.position-slider-compact {
    flex: 1;
    height: 4px;
    border-radius: 4px;
    background: rgba(243, 229, 217, 0.3);
    outline: none;
    transition: all 0.3s ease;
}

.position-slider-compact::-webkit-slider-thumb {
    appearance: none;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #F3E5D9;
    cursor: pointer;
    border: 1px solid #0f5132;
    transition: all 0.3s ease;
}

.position-slider-compact::-webkit-slider-thumb:hover {
    background: #c6e5d2;
    transform: scale(1.1);
}

.image-buttons-compact {
    display: flex;
    gap: 6px;
    justify-content: center;
}

.btn-compact {
    background: #F3E5D9;
    color: #0f5132;
    border: none;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
}

.btn-compact:hover {
    background: #c6e5d2;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.upload-feedback {
    margin-top: 8px;
    padding: 6px;
    border-radius: 6px;
    font-size: 12px;
    text-align: center;
}

.upload-feedback.warning {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

/* Enhanced Hebrew Detection Modal */
.hebrew-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 10001;
    display: none;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
}

.hebrew-modal.active {
    display: flex;
    animation: fadeIn 0.3s ease;
}

.hebrew-modal-content {
    background: linear-gradient(135deg, #ffc107, #ffb300);
    color: #0f5132;
    border-radius: 20px;
    width: 90%;
    max-width: 500px;
    animation: modalSlideIn 0.4s ease;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    border: 3px solid rgba(255, 193, 7, 0.8);
}

.hebrew-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    border-bottom: 2px solid rgba(15, 81, 50, 0.1);
    background: linear-gradient(135deg, rgba(15, 81, 50, 0.1), rgba(220, 53, 69, 0.1));
}

.hebrew-header h4 {
    font-size: 20px;
    font-weight: bold;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.hebrew-header h4::before {
    content: '⚠️';
    font-size: 24px;
}

.close-hebrew {
    background: rgba(15, 81, 50, 0.1);
    border: 2px solid rgba(15, 81, 50, 0.3);
    font-size: 20px;
    cursor: pointer;
    color: #0f5132;
    transition: all 0.3s ease;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.close-hebrew:hover {
    background: rgba(220, 53, 69, 0.1);
    border-color: #dc3545;
    color: #dc3545;
    transform: rotate(90deg);
}

.hebrew-body {
    padding: 25px 30px;
    text-align: center;
}

.hebrew-text {
    font-size: 18px;
    margin-bottom: 25px;
    font-weight: bold;
    padding: 15px;
    background: rgba(15, 81, 50, 0.05);
    border-radius: 15px;
    border: 2px dashed rgba(15, 81, 50, 0.2);
}

.hebrew-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    padding-top: 15px;
    border-top: 2px solid rgba(15, 81, 50, 0.1);
}

.continue-hebrew-btn {
    background: rgba(15, 81, 50, 0.1);
    color: #0f5132;
    border: 2px solid #0f5132;
    padding: 12px 25px;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
}

.continue-hebrew-btn::before {
    content: '✅';
    font-size: 16px;
}

.continue-hebrew-btn:hover {
    background: rgba(15, 81, 50, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(15, 81, 50, 0.3);
}

.change-lang-btn {
    background: linear-gradient(135deg, #0f5132, #1E7154);
    color: #F3E5D9;
    border: 2px solid transparent;
    padding: 12px 25px;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
}

.change-lang-btn::before {
    content: '✏️';
    font-size: 16px;
}

.change-lang-btn:hover {
    background: linear-gradient(135deg, #1E7154, #28a745);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(15, 81, 50, 0.4);
    border-color: rgba(15, 81, 50, 0.6);
}

/* Enhanced Feedback System */
.field-feedback {
    font-size: 11px;
    margin-top: 6px;
    padding: 6px 10px;
    border-radius: 6px;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    border-left: 2px solid transparent;
}

.field-feedback.show {
    opacity: 1;
    transform: translateY(0);
}

.field-feedback.success {
    color: #28a745;
    background: rgba(40, 167, 69, 0.1);
    border-left-color: #28a745;
}

.field-feedback.warning {
    color: #ffc107;
    background: rgba(255, 193, 7, 0.1);
    border-left-color: #ffc107;
}

.field-feedback.info {
    color: #17a2b8;
    background: rgba(23, 162, 184, 0.1);
    border-left-color: #17a2b8;
}

.field-feedback.error {
    color: #e3342f;
    background: rgba(227, 52, 47, 0.1);
    border-left-color: #e3342f;
}

/* Enhanced Labels and Tooltips */
.enhanced-label-compact {
    display: block;
    margin-bottom: 8px;
    color: #F3E5D9;
    font-weight: bold;
    position: relative;
}

.info-tooltip-compact {
    position: relative;
    margin-left: 6px;
    cursor: help;
    color: rgba(243, 229, 217, 0.8);
    font-size: 14px;
}

.info-tooltip-compact::before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(15, 81, 50, 0.95);
    color: #F3E5D9;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 11px;
    white-space: nowrap;
    max-width: 250px;
    white-space: normal;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.info-tooltip-compact:hover::before {
    opacity: 1;
    transform: translateX(-50%) translateY(-5px);
}

/* Enhanced Buttons */
.enhanced-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: bold;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border: none;
    cursor: pointer;
}

.enhanced-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.enhanced-btn:hover::before {
    left: 100%;
}

.enhanced-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.enhanced-btn:active {
    transform: translateY(0);
}

.enhanced-btn img {
    transition: transform 0.3s ease;
}

.enhanced-btn:hover img {
    transform: translateX(5px);
}

/* Compact Skills System */
.skills-section-compact {
    text-align: center;
    margin-top: 15px;
}

.skill-trigger-compact {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, rgba(198, 229, 210, 0.8), rgba(243, 229, 217, 0.6));
    border-radius: 12px;
    padding: 10px 18px;
    max-width: 300px;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.skill-trigger-compact:hover {
    background: linear-gradient(135deg, rgba(198, 229, 210, 1), rgba(243, 229, 217, 0.8));
    transform: translateY(-2px);
    border-color: #F3E5D9;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.trigger-text {
    font-size: 14px;
    color: #004c3f;
    font-weight: bold;
    flex: 1;
    text-align: right;
}

.plus-icon-compact {
    font-size: 20px;
    color: #004c3f;
    font-weight: bold;
    cursor: pointer;
    padding: 0 8px;
    transition: transform 0.3s ease;
}

.skill-trigger-compact:hover .plus-icon-compact {
    transform: rotate(180deg);
}

.skills-display-compact {
    margin-top: 15px;
    min-height: 40px;
    padding: 8px;
}

.skill-tag {
    background: linear-gradient(135deg, rgba(243, 229, 217, 0.9), rgba(198, 229, 210, 0.8));
    color: #004c3f;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin: 3px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
    font-weight: bold;
}

.skill-tag:hover {
    background: linear-gradient(135deg, #F3E5D9, #c6e5d2);
    border-color: #004c3f;
    transform: translateY(-1px);
}

.remove-skill {
    font-weight: bold;
    font-size: 14px;
    color: #004c3f;
    cursor: pointer;
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.remove-skill:hover {
    background: #004c3f;
    color: #F3E5D9;
}

/* Enhanced Skills Popup */
.skills-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 10000;
    display: none;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
}

.skills-popup.active {
    display: flex;
}

.skills-popup-content {
    background: linear-gradient(135deg, #F3E5D9, #c6e5d2);
    color: #004c3f;
    border-radius: 20px;
    width: 90%;
    max-width: 700px;
    max-height: 85vh;
    overflow-y: auto;
    animation: slideInRight 0.3s ease;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
}

.popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 25px;
    border-bottom: 2px solid rgba(0, 76, 63, 0.1);
}

.popup-header h4 {
    font-size: 20px;
    font-weight: bold;
    margin: 0;
}

.close-popup {
    background: none;
    border: none;
    font-size: 26px;
    cursor: pointer;
    color: #004c3f;
    transition: all 0.3s ease;
}

.close-popup:hover {
    transform: rotate(90deg);
    color: #dc3545;
}

.popup-body {
    padding: 25px;
}

.skill-search-section {
    margin-bottom: 18px;
}

.search-input-group {
    position: relative;
    width: 100%;
}

.search-input-group input {
    width: 100%;
    border: 2px solid #004c3f;
    border-radius: 12px;
    padding: 10px 40px 10px 12px;
    font-size: 14px;
    direction: rtl;
}

.search-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #004c3f;
}

.add-skill-section {
    margin-bottom: 18px;
}

.add-skill-section .d-flex {
    gap: 8px;
}

.add-skill-section input {
    flex: 1;
    border: 2px solid #004c3f;
    border-radius: 12px;
    padding: 10px 12px;
    font-size: 14px;
    direction: rtl;
}

.add-skill-btn {
    width: 44px;
    height: 44px;
    background: #004c3f;
    color: #F3E5D9;
    border: none;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.add-skill-btn:hover {
    background: #1E7154;
    transform: scale(1.1);
}

.skills-categories {
    margin-top: 18px;
}

.category-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 18px;
    justify-content: center;
    flex-wrap: wrap;
}

.category-tab {
    padding: 6px 14px;
    border: 2px solid #004c3f;
    background: transparent;
    color: #004c3f;
    border-radius: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
    font-size: 13px;
}

.category-tab.active,
.category-tab:hover {
    background: #004c3f;
    color: #F3E5D9;
}

.skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    max-height: 250px;
    overflow-y: auto;
    padding: 8px;
}

.skill-btn {
    border: 2px solid #004c3f;
    background: transparent;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #004c3f;
}

.skill-btn:hover {
    background: rgba(0, 76, 63, 0.1);
    transform: translateY(-1px);
}

.skill-btn.selected {
    background-color: #004c3f;
    color: #F3E5D9;
}

.popup-actions {
    display: flex;
    justify-content: space-between;
    padding: 18px 25px;
    border-top: 2px solid rgba(0, 76, 63, 0.1);
}

.clear-btn {
    background: linear-gradient(135deg, #e3342f, #cc1f1a);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 13px;
}

.clear-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(227, 52, 47, 0.4);
}

.save-btn {
    background: linear-gradient(135deg, #004c3f, #1E7154);
    color: #F3E5D9;
    border: none;
    padding: 10px 25px;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
}

.save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 76, 63, 0.4);
}

/* Enhanced Projects Section */
.projects-grid {
    gap: 12px;
}

.enhanced-project-btn {
    border: 2px solid rgba(243, 229, 217, 0.8);
    background: rgba(243, 229, 217, 0.1);
    color: #F3E5D9;
    border-radius: 18px;
    padding: 8px 16px;
    transition: all 0.3s ease;
    font-weight: bold;
    backdrop-filter: blur(5px);
    font-size: 13px;
}

.enhanced-project-btn:hover {
    background: rgba(243, 229, 217, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.enhanced-project-btn.selected {
    background: linear-gradient(135deg, #F3E5D9, #c6e5d2);
    color: #016d47;
    border-color: #F3E5D9;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(243, 229, 217, 0.4);
}

/* Enhanced Toggle Switch */
.toggle-switch-experience {
    position: relative;
    display: inline-block;
    width: 60%;
    max-width: 280px;
    height: 45px;
    background: linear-gradient(135deg, #0f5132, #1E7154);
    border-radius: 22px;
    direction: rtl;
    box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.3);
}

.toggle-switch-experience input {
    display: none;
}

.toggle-switch-experience label {
    display: block;
    width: 100%;
    height: 100%;
    position: relative;
    cursor: pointer;
    color: #fff;
}

.toggle-switch-experience .toggle-option {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    z-index: 2;
    transition: all 0.3s ease;
    font-size: 14px;
}

.toggle-switch-experience .yes {
    left: 0;
}

.toggle-switch-experience .no {
    right: 0;
}

.toggle-switch-experience .toggle-slider {
    position: absolute;
    top: 3px;
    bottom: 3px;
    right: 3px;
    width: calc(50% - 3px);
    background: linear-gradient(135deg, #c6e5d2, #F3E5D9);
    border-radius: 22px;
    transition: all 0.4s ease;
    z-index: 1;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.toggle-switch-experience input:checked + label .toggle-slider {
    right: auto;
    left: 3px;
}

.toggle-switch-experience input:checked + label .yes {
    color: #0f5132;
}

.toggle-switch-experience input:not(:checked) + label .no {
    color: #0f5132;
}

/* Enhanced Review Section */
.review-section {
    background: linear-gradient(135deg, rgba(243, 229, 217, 0.1), rgba(198, 229, 210, 0.1));
    border: 2px solid rgba(243, 229, 217, 0.2);
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.review-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
    color: #F3E5D9;
    font-size: 14px;
    text-align: right;
}

.review-grid > div {
    padding: 12px 16px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.review-grid > div:hover {
    background: rgba(0, 0, 0, 0.3);
    border-color: rgba(243, 229, 217, 0.3);
    transform: translateX(5px);
}

.value-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    direction: ltr;
}

.value-text {
    direction: rtl;
    text-align: left;
    max-width: 250px;
    word-wrap: break-word;
    font-size: 13px;
}

.edit-icon {
    color: #F3E5D9;
    font-size: 16px;
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.edit-icon:hover {
    background: rgba(243, 229, 217, 0.2);
    transform: scale(1.1);
}

.image-review-wrapper {
    display: flex;
    justify-content: center;
    width: 150px;
    height: 150px;
    margin: 0 auto 15px;
    position: relative;
}

.avatar-container {
    position: relative;
    display: inline-block;
    border-radius: 12px;
    width: 100%;
    height: 100%;
    overflow: hidden;
    border: 2px solid #F3E5D9;
}

.review-avatar {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.edit-avatar-icon {
    position: absolute;
    bottom: -3px;
    right: -3px;
    background: #F3E5D9;
    color: #0f5132;
    border: 2px solid #0f5132;
    border-radius: 50%;
    padding: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
}

.edit-avatar-icon:hover {
    background: #c6e5d2;
    transform: scale(1.1);
}

/* Enhanced Confirmation */
.confirmation-checkbox {
    display: flex;
    justify-content: center;
    align-items: center;
}

.checkbox-container {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #F3E5D9;
    font-size: 14px;
}

.checkbox-container input {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #F3E5D9;
    border-radius: 4px;
    margin-left: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.checkbox-container input:checked ~ .checkmark {
    background: #F3E5D9;
    color: #0f5132;
}

.checkbox-container input:checked ~ .checkmark::after {
    content: '✓';
    font-weight: bold;
    font-size: 12px;
}

.checkbox-text {
    line-height: 1.4;
}

.terms-link {
    color: #c6e5d2;
    text-decoration: underline;
    transition: color 0.3s ease;
}

.terms-link:hover {
    color: #F3E5D9;
}

/* Enhanced Success Section */
.success-section {
    padding: 40px 20px;
}

.success-animation {
    animation: fadeIn 1s ease-out;
}

.success-checkmark {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #28a745;
    stroke-miterlimit: 10;
    margin: 0 auto 18px;
    box-shadow: inset 0px 0px 0px #28a745;
    animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
}

.success-checkmark .check-icon {
    width: 70px;
    height: 70px;
    position: relative;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #fff;
    stroke-miterlimit: 10;
    margin: 0 auto;
    box-shadow: inset 0px 0px 0px #28a745;
}

.success-checkmark .check-icon .icon-line {
    height: 2px;
    background-color: #28a745;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
}

.success-checkmark .check-icon .icon-line.line-tip {
    top: 40px;
    left: 12px;
    width: 22px;
    transform: rotate(45deg);
    animation: icon-line-tip 0.75s;
}

.success-checkmark .check-icon .icon-line.line-long {
    top: 33px;
    right: 7px;
    width: 40px;
    transform: rotate(-45deg);
    animation: icon-line-long 0.75s;
}

.success-checkmark .check-icon .icon-circle {
    top: -2px;
    left: -2px;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    position: absolute;
    border: 2px solid #28a745;
    z-index: 10;
    animation: icon-circle 0.5s;
}

.success-checkmark .check-icon .icon-fix {
    top: 7px;
    width: 4px;
    left: 23px;
    z-index: 1;
    height: 75px;
    position: absolute;
    transform: rotate(-45deg);
}

@keyframes icon-line-tip {
    0% { width: 0; left: 1px; top: 16px; }
    54% { width: 0; left: 1px; top: 16px; }
    70% { width: 45px; left: -7px; top: 32px; }
    84% { width: 15px; left: 18px; top: 42px; }
    100% { width: 22px; left: 12px; top: 39px; }
}

@keyframes icon-line-long {
    0% { width: 0; right: 40px; top: 47px; }
    65% { width: 0; right: 40px; top: 47px; }
    84% { width: 48px; right: 0px; top: 31px; }
    100% { width: 40px; right: 7px; top: 33px; }
}

@keyframes icon-circle {
    0% { transform: scale(0); }
    100% { transform: scale(1); }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 60px #28a745;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

.success-icon {
    animation: bounce 1s ease-in-out infinite;
}

.success-title {
    animation: slideInLeft 0.8s ease-out 0.5s both;
}

.success-text {
    animation: slideInRight 0.8s ease-out 0.7s both;
}

/* Step Titles */
.step-title {
    position: relative;
    padding-bottom: 15px;
}

.step-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #F3E5D9, transparent);
}

/* Enhanced Mobile Responsive */
@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }

    .upload-area-compact {
        width: 120px;
        height: 120px;
    }

    .image-controls-compact {
        padding: 10px;
    }

    .image-buttons-compact {
        flex-direction: column;
        gap: 6px;
    }

    .btn-compact {
        padding: 5px 10px;
        font-size: 10px;
    }

    .step-item {
        margin: 0 5px;
    }

    .step-circle-new {
        width: 32px;
        height: 32px;
    }

    .step-number {
        font-size: 14px;
    }

    .step-label-new {
        font-size: 11px;
        max-width: 70px;
        margin-top: 8px;
    }

    .enhanced-input {
        font-size: 16px;
        padding: 10px 15px;
    }

    .enhanced-textarea-compact {
        font-size: 16px;
        padding: 12px;
        min-height: 80px;
    }

    .enhanced-btn {
        padding: 10px 18px;
        font-size: 14px;
    }

    .social-input-icon {
        padding: 12px;
    }

    .social-icon-only {
        width: 32px;
        height: 32px;
    }

    .skills-popup-content,
    .hebrew-modal-content {
        width: 95%;
        margin: 10px;
    }

    .popup-header,
    .hebrew-header {
        padding: 12px 18px;
    }

    .popup-body,
    .hebrew-body {
        padding: 18px;
    }

    .skills-grid {
        max-height: 180px;
    }

    .review-grid > div {
        padding: 10px 12px;
        font-size: 13px;
    }

    .value-text {
        max-width: 180px;
        font-size: 12px;
    }

    .toggle-switch-experience {
        width: 80%;
        height: 40px;
    }

    .fs60 {
        font-size: 32px !important;
    }

    .fs25 {
        font-size: 18px !important;
    }

    .fs20 {
        font-size: 16px !important;
    }

    .fs18 {
        font-size: 15px !important;
    }

    .simple-alert-content {
        padding: 15px;
        width: 95%;
        max-width: 350px;
    }

    .alert-header strong {
        font-size: 14px;
    }

    .missing-list li {
        padding: 6px 10px;
        font-size: 13px;
    }

    .image-review-wrapper {
        width: 120px;
        height: 120px;
    }

    .hebrew-actions {
        flex-direction: column;
        gap: 8px;
    }

    .continue-hebrew-btn,
    .change-lang-btn {
        width: 100%;
        justify-content: center;
        font-size: 13px;
        padding: 10px 20px;
    }

    .word-progress-compact {
        padding: 8px;
    }

    .word-progress-markers-compact .marker-compact {
        font-size: 8px;
        padding: 1px 3px;
    }

    .word-counter-compact {
        font-size: 11px;
    }

    .word-count {
        font-size: 12px;
    }

    .character-count {
        font-size: 10px;
    }
}

@media (max-width: 480px) {
    .step-item {
        margin: 0 2px;
    }

    .step-circle-new {
        width: 28px;
        height: 28px;
    }

    .step-number {
        font-size: 12px;
    }

    .step-check {
        font-size: 14px;
    }

    .step-label-new {
        font-size: 10px;
        max-width: 60px;
        margin-top: 6px;
    }

    .upload-area-compact {
        width: 100px;
        height: 100px;
    }

    .upload-icon-compact {
        font-size: 24px;
    }

    .upload-text-compact {
        font-size: 10px;
    }

    .social-icon-only {
        width: 28px;
        height: 28px;
    }

    .social-input-icon {
        padding: 10px;
    }

    .skill-trigger-compact {
        max-width: 250px;
        padding: 8px 14px;
    }

    .trigger-text {
        font-size: 13px;
    }

    .plus-icon-compact {
        font-size: 18px;
    }

    .toggle-switch-experience {
        width: 90%;
        height: 36px;
    }

    .toggle-option {
        font-size: 13px;
    }

    .enhanced-btn {
        padding: 8px 14px;
        font-size: 13px;
    }

    .image-review-wrapper {
        width: 100px;
        height: 100px;
    }

    .hebrew-modal-content {
        margin: 5px;
        width: 98%;
    }

    .hebrew-header {
        padding: 10px 12px;
    }

    .hebrew-header h4 {
        font-size: 16px;
    }

    .hebrew-body {
        padding: 12px;
    }

    .close-hebrew {
        width: 28px;
        height: 28px;
        font-size: 16px;
    }

    .continue-hebrew-btn,
    .change-lang-btn {
        padding: 8px 16px;
        font-size: 12px;
    }

    .simple-alert-content {
        padding: 12px;
        margin: 10px;
    }

    .alert-header strong {
        font-size: 13px;
    }

    .missing-list li {
        font-size: 12px;
        padding: 5px 8px;
    }

    .word-progress-bar-compact {
        height: 5px;
    }

    .word-progress-markers-compact .marker-compact {
        font-size: 7px;
        padding: 1px 2px;
    }

    .simple-close {
        width: 26px;
        height: 26px;
        font-size: 16px;
    }
}

/* Animation Performance Optimizations */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Print Styles */
@media print {
    .lottie-loader-overlay,
    .skills-popup,
    .enhanced-btn,
    .validation-alert,
    .hebrew-modal,
    .image-controls-compact {
        display: none !important;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Enhanced Form Variables
    let currentImageFile = null;
    let selectedSkills = new Set();
    let newSkills = [];
    let currentStep = 0;
    let noLinkedIn = false;
    let noInstagram = false;

    // Form Elements
    const startBtn = document.getElementById("start_form");
    const startSection = document.getElementById("start_section");
    const formSection = document.getElementById("form_section");
    const steps = document.querySelectorAll(".form-step");
    const stepItems = document.querySelectorAll(".step-item");
    const nextBtns = document.querySelectorAll(".next-step");
    const prevBtns = document.querySelectorAll(".prev-step");
    const form = document.getElementById("multiStepForm");
    const loadingOverlay = document.getElementById("lottieLoader");
    const progressLine = document.getElementById("progressLine");

    // Image Upload Elements
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const profileImage = document.getElementById('profileImage');
    const placeholder = document.getElementById('placeholder');
    const imagePreview = document.getElementById('imagePreview');
    const imageControls = document.getElementById('imageControls');
    const positionX = document.getElementById('positionX');
    const positionY = document.getElementById('positionY');

    // Enhanced Birth Date Input Handler
    const birthDateInput = document.getElementById('birthDateInput');
    
    birthDateInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
        let formattedValue = '';
        
        if (value.length > 0) {
            formattedValue = value.substring(0, 2); // DD
            if (value.length >= 3) {
                formattedValue += '/' + value.substring(2, 4); // DD/MM
                if (value.length >= 5) {
                    formattedValue += '/' + value.substring(4, 8); // DD/MM/YYYY
                }
            }
        }
        
        e.target.value = formattedValue;
        
        // Validate date format
        if (formattedValue.length === 10) {
            const dateParts = formattedValue.split('/');
            const day = parseInt(dateParts[0]);
            const month = parseInt(dateParts[1]);
            const year = parseInt(dateParts[2]);
            
            const currentYear = new Date().getFullYear();
            const minYear = currentYear - 100;
            const maxYear = currentYear - 13; // Minimum age 13
            
            let isValid = true;
            let feedbackMessage = '';
            let feedbackType = 'success';
            
            if (day < 1 || day > 31) {
                isValid = false;
                feedbackMessage = 'اليوم غير صحيح (1-31)';
                feedbackType = 'warning';
            } else if (month < 1 || month > 12) {
                isValid = false;
                feedbackMessage = 'الشهر غير صحيح (1-12)';
                feedbackType = 'warning';
            } else if (year < minYear || year > maxYear) {
                isValid = false;
                feedbackMessage = `السنة غير صحيحة (${minYear}-${maxYear})`;
                feedbackType = 'warning';
            } else {
                // Check if date exists
                const date = new Date(year, month - 1, day);
                if (date.getFullYear() !== year || date.getMonth() !== month - 1 || date.getDate() !== day) {
                    isValid = false;
                    feedbackMessage = 'التاريخ غير موجود';
                    feedbackType = 'warning';
                } else {
                    feedbackMessage = 'تاريخ صحيح ✓';
                    feedbackType = 'success';
                }
            }
            
            showFieldFeedback(e.target, feedbackMessage, feedbackType);
        } else {
            clearFieldFeedback(e.target);
        }
    });

    // Hebrew Detection Function
    function containsHebrew(text) {
        const hebrewRegex = /[\u0590-\u05FF]/;
        return hebrewRegex.test(text);
    }

    // Fixed Word Count Functions
    function countWords(text) {
        return text.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    function getWordCountFeedback(wordCount) {
        if (wordCount === 0) {
            return {
                message: "يجب أن تملأ هذا الحقل",
                type: "error",
                percentage: 0
            };
        } else if (wordCount >= 1 && wordCount < 5) {
            return {
                message: "يجب أن تذكر المزيد من التفاصيل",
                type: "error", 
                percentage: 0
            };
        } else if (wordCount >= 5 && wordCount < 20) {
            return {
                message: "جيد لكن نفضل أن تكتب أكثر",
                type: "warning",
                percentage: ((wordCount - 5) / 55) * 100 // Start from 5 words = 0%, 20 words = ~27%
            };
        } else if (wordCount >= 20 && wordCount < 40) {
            return {
                message: "جيد جداً! ✓",
                type: "info",
                percentage: 27 + ((wordCount - 20) / 55) * 36 // 20 words = 27%, 40 words = 63%
            };
        } else if (wordCount >= 40 && wordCount < 60) {
            return {
                message: "ممتاز! ✓",
                type: "success",
                percentage: 63 + ((wordCount - 40) / 55) * 37 // 40 words = 63%, 60 words = 100%
            };
        } else if (wordCount >= 60) {
            return {
                message: "ممتاز جداً! 🌟",
                type: "success",
                percentage: 100
            };
        }
    }

    function updateWordProgress(textarea) {
        const text = textarea.value.trim();
        const wordCount = countWords(text);
        const charCount = text.length;
        const maxChars = parseInt(textarea.getAttribute('data-max')) || 1000;
        
        const fieldName = textarea.name;
        const progressFill = document.getElementById(fieldName + '_progress');
        const wordCounter = document.getElementById(fieldName + '_count');
        const charCounter = document.getElementById(fieldName + '_chars');
        
        if (progressFill && wordCounter && charCounter) {
            const feedback = getWordCountFeedback(wordCount);
            
            // Update counters
            wordCounter.textContent = wordCount;
            charCounter.textContent = charCount;
            
            // Update progress bar
            progressFill.style.width = feedback.percentage + '%';
            
            // Update feedback
            if (text.length > 0) {
                showFieldFeedback(textarea, feedback.message, feedback.type);
            } else {
                clearFieldFeedback(textarea);
            }
        }
        
        return feedback;
    }

    function checkWordCount(textarea) {
        const text = textarea.value.trim();
        
        // Check for Hebrew first
        if (containsHebrew(text)) {
            showHebrewModal(textarea);
            return false;
        }
        
        const feedback = updateWordProgress(textarea);
        
        // For required fields, require at least 5 words for progression
        if (textarea.required && countWords(text) < 5) {
            return false;
        }
        
        return true;
    }

    // Hebrew Detection Modal Functions
    function showHebrewModal(textarea) {
        const modal = document.getElementById('hebrewModal');
        modal.classList.add('active');
    }

    window.closeHebrewModal = function() {
        document.getElementById('hebrewModal').classList.remove('active');
    };

    window.continueWithHebrew = function() {
        closeHebrewModal();
    };

    window.changeToArabicEnglish = function() {
        closeHebrewModal();
    };

    // Image Upload Functions
    function handleFileSelect(file) {
        if (!file.type.startsWith('image/')) {
            const errorDiv = document.getElementById('uploadError');
            errorDiv.textContent = 'يرجى اختيار ملف صورة صحيح';
            errorDiv.className = 'upload-feedback warning';
            return;
        }

        if (file.size > 5 * 1024 * 1024) { // 5MB limit
            const errorDiv = document.getElementById('uploadError');
            errorDiv.textContent = 'حجم الملف يجب أن يكون أقل من 5 ميجابايت';
            errorDiv.className = 'upload-feedback warning';
            return;
        }

        currentImageFile = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            profileImage.src = e.target.result;
            placeholder.style.display = 'none';
            imagePreview.style.display = 'block';
            uploadArea.classList.add('has-image');
            imageControls.style.display = 'block';
            
            // Reset position
            positionX.value = 50;
            positionY.value = 50;
            updateImagePosition();
            
            // Clear any errors
            const errorDiv = document.getElementById('uploadError');
            errorDiv.textContent = '';
            errorDiv.className = 'upload-feedback';
            
            // ✅ Update next button state
            if (currentStep === 0) {
                validateStep(0);
            }
        };
        reader.readAsDataURL(file);
    }

    function updateImagePosition() {
        if (profileImage) {
            const x = positionX.value;
            const y = positionY.value;
            profileImage.style.objectPosition = `${x}% ${y}%`;
        }
    }

    // Global Image Functions
    window.removeImage = function() {
        placeholder.style.display = 'block';
        imagePreview.style.display = 'none';
        uploadArea.classList.remove('has-image');
        imageControls.style.display = 'none';
        fileInput.value = '';
        currentImageFile = null;
        document.getElementById('uploadError').textContent = '';
        
        // ✅ Update next button state
        if (currentStep === 0) {
            validateStep(0);
        }
    };

    window.centerImage = function() {
        positionX.value = 50;
        positionY.value = 50;
        updateImagePosition();
    };

    // Image Upload Event Listeners
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('drag-over');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('drag-over');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    });

    uploadArea.addEventListener('click', () => {
        if (!uploadArea.classList.contains('has-image')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    // Position sliders event listeners
    if (positionX) {
        positionX.addEventListener('input', updateImagePosition);
    }
    if (positionY) {
        positionY.addEventListener('input', updateImagePosition);
    }

    // Enhanced Validation Functions
    function showFieldFeedback(field, message, type = 'info') {
        const feedbackId = field.getAttribute('name') + '_feedback';
        const feedbackElement = document.getElementById(feedbackId);
        if (feedbackElement) {
            feedbackElement.textContent = message;
            feedbackElement.className = `field-feedback show ${type}`;
        }
    }

    function clearFieldFeedback(field) {
        const feedbackId = field.getAttribute('name') + '_feedback';
        const feedbackElement = document.getElementById(feedbackId);
        if (feedbackElement) {
            feedbackElement.textContent = '';
            feedbackElement.className = 'field-feedback';
        }
    }

    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let feedbackMessage = '';
        let feedbackType = 'success';

        // Clear previous feedback
        clearFieldFeedback(field);

        // Skip validation if field is not required and empty
        if (!field.required && !value) {
            return true;
        }

        // Required field validation
        if (field.required && !value) {
            isValid = false;
        }

        // Email validation
        if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                feedbackMessage = 'البريد الإلكتروني غير صحيح';
                feedbackType = 'warning';
                isValid = false;
            } else {
                feedbackMessage = 'بريد إلكتروني صحيح ✓';
                feedbackType = 'success';
            }
        }

        // Phone validation
        if (field.name === 'phone' && value) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,15}$/;
            if (!phoneRegex.test(value)) {
                feedbackMessage = 'رقم الهاتف غير صحيح';
                feedbackType = 'warning';
                isValid = false;
            } else {
                feedbackMessage = 'رقم هاتف صحيح ✓';
                feedbackType = 'success';
            }
        }

        // Name validation
        if (field.name === 'full_name' && value) {
            if (value.length < 2) {
                feedbackMessage = 'الاسم قصير جداً';
                feedbackType = 'warning';
                isValid = false;
            } else if (value.length > 50) {
                feedbackMessage = 'الاسم طويل جداً';
                feedbackType = 'warning';
                isValid = false;
            } else {
                feedbackMessage = 'اسم صحيح ✓';
                feedbackType = 'success';
            }
        }

        // LinkedIn validation
        if (field.name === 'linkedin' && value && !noLinkedIn) {
            const linkedinRegex = /^https?:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9\-]+\/?$/;
            if (!linkedinRegex.test(value)) {
                feedbackMessage = 'رابط لينكد إن غير صحيح';
                feedbackType = 'error';
                isValid = false;
            } else {
                feedbackMessage = 'رابط لينكد إن صحيح ✓';
                feedbackType = 'success';
            }
        }

        // Instagram validation
        if (field.name === 'instagram' && value && !noInstagram) {
            // Remove @ if user added it
            const cleanValue = value.replace('@', '');
            field.value = cleanValue;
            
            const instagramRegex = /^[a-zA-Z0-9._]+$/;
            if (!instagramRegex.test(cleanValue)) {
                feedbackMessage = 'اسم المستخدم في إنستغرام غير صحيح';
                feedbackType = 'warning';
                isValid = false;
            } else if (cleanValue.length < 1 || cleanValue.length > 30) {
                feedbackMessage = 'اسم المستخدم يجب أن يكون بين 1-30 حرف';
                feedbackType = 'warning';
                isValid = false;
            } else {
                feedbackMessage = 'اسم مستخدم إنستغرام صحيح ✓';
                feedbackType = 'success';
            }
        }

        if (feedbackMessage) {
            showFieldFeedback(field, feedbackMessage, feedbackType);
        }

        return isValid;
    }

    // LinkedIn Toggle Function
    window.toggleLinkedInField = function(checked) {
        const linkedinInput = document.querySelector('input[name="linkedin"]');
        noLinkedIn = checked;
        
        if (checked) {
            linkedinInput.disabled = true;
            linkedinInput.value = '';
            linkedinInput.style.opacity = '0.5';
            clearFieldFeedback(linkedinInput);
        } else {
            linkedinInput.disabled = false;
            linkedinInput.style.opacity = '1';
        }
    };

    // Instagram Toggle Function
    window.toggleInstagramField = function(checked) {
        const instagramInput = document.querySelector('input[name="instagram"]');
        noInstagram = checked;
        
        if (checked) {
            instagramInput.disabled = true;
            instagramInput.value = '';
            instagramInput.style.opacity = '0.5';
            clearFieldFeedback(instagramInput);
        } else {
            instagramInput.disabled = false;
            instagramInput.style.opacity = '1';
        }
    };

    // Simple step validation (like original code) for enabling/disabling next button
    function validateStep(stepIndex) {
        const step = steps[stepIndex];
        const requiredFields = step.querySelectorAll('[required]');
        let allValid = true;

        requiredFields.forEach(field => {
            // Skip LinkedIn if disabled
            if (field.name === 'linkedin' && noLinkedIn) return;
            // Skip Instagram if disabled  
            if (field.name === 'instagram' && noInstagram) return;
            
            if (!field.value.trim()) {
                allValid = false;
            }
        });
        
        // Check image for step 1
        if (stepIndex === 0 && !currentImageFile) {
            allValid = false;
        }

        const nextButton = step.querySelector('.next-step');
        if (nextButton) {
            nextButton.classList.toggle('disabled', !allValid);
            nextButton.style.pointerEvents = allValid ? 'auto' : 'none';
            nextButton.style.opacity = allValid ? '1' : '0.5';
        }
    }

    function validateCurrentStep() {
        const currentStepElement = steps[currentStep];
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let allValid = true;
        let missingFields = [];

        console.log('=== Validating Step:', currentStep + 1, '===');
        console.log('Required fields found:', requiredFields.length);

        // Simple validation like original code
        requiredFields.forEach((field, index) => {
            const value = field.value.trim();
            
            console.log(`Field ${index + 1}: ${field.name} = "${value}"`);
            
            // For LinkedIn, check if "no LinkedIn" is checked
            if (field.name === 'linkedin' && noLinkedIn) {
                console.log('LinkedIn disabled, skipping validation');
                return;
            }
            
            // For Instagram, check if "no Instagram" is checked
            if (field.name === 'instagram' && noInstagram) {
                console.log('Instagram disabled, skipping validation');
                return;
            }
            
            if (!value) {
                allValid = false;
                const placeholder = field.getAttribute('placeholder') || field.getAttribute('name');
                missingFields.push(placeholder.replace(' *', ''));
                console.log('❌ Field missing:', field.name);
            }
        });

        // Special validation for step 1 (image required)
        if (currentStep === 0) {
            console.log('Checking profile image. Current file:', currentImageFile ? 'exists' : 'missing');
            if (!currentImageFile) {
                allValid = false;
                missingFields.push('الصورة الشخصية');
                const errorDiv = document.getElementById('uploadError');
                if (errorDiv) {
                    errorDiv.textContent = 'الصورة الشخصية مطلوبة';
                    errorDiv.className = 'upload-feedback warning';
                }
            }
        }

        // Simple skills validation for step 2 - don't block if no skills selected
        if (currentStep === 1) {
            console.log('Step 2 - Professional info. Selected skills:', selectedSkills.size);
            // Only add warning, don't block progression
            if (selectedSkills.size === 0) {
                console.log('⚠️ No skills selected (warning only)');
                missingFields.push('المهارات (اختياري)');
            }
        }

        // Special validation for step 4 (confirmation checkbox)
        if (currentStep === 3) {
            const confirmCheckbox = document.getElementById('confirmSubmission');
            if (confirmCheckbox && !confirmCheckbox.checked) {
                allValid = false;
                missingFields.push('تأكيد الموافقة على الشروط');
                console.log('❌ Confirmation checkbox not checked');
            }
        }

        console.log('=== Validation Result ===');
        console.log('Valid:', allValid);
        console.log('Missing fields:', missingFields);
        console.log('========================');

        return { isValid: allValid, missingFields };
    }

    function proceedToNextStep() {
        if (currentStep < steps.length - 1) {
            showLoading(true);
            setTimeout(() => {
                currentStep++;
                showStep(currentStep);
                if (currentStep === 3) populateReviewStep();
                showLoading(false);
            }, 300);
        }
    }

    function showValidationAlert(missingFields) {
        const alertElement = document.getElementById('validationAlert');
        const missingFieldsList = document.getElementById('missingFields');
        
        missingFieldsList.innerHTML = '';
        missingFields.forEach(field => {
            const li = document.createElement('li');
            li.textContent = field;
            missingFieldsList.appendChild(li);
        });
        
        alertElement.classList.add('show');
        
        // Auto hide after 6 seconds
        setTimeout(() => {
            alertElement.classList.remove('show');
        }, 6000);
    }

    window.hideValidationAlert = function() {
        document.getElementById('validationAlert').classList.remove('show');
    };

    // Enhanced Step Navigation
    function updateStepBar(index) {
        stepItems.forEach((item, i) => {
            if (i < index) {
                item.classList.add('completed');
                item.classList.remove('active');
            } else if (i === index) {
                item.classList.add('active');
                item.classList.remove('completed');
            } else {
                item.classList.remove('active', 'completed');
            }
        });

        // Update progress line
        const progressPercentage = (index / (stepItems.length - 1)) * 100;
        const progressLineElement = document.getElementById('progressLine');
        if (progressLineElement) {
            // Create the ::after pseudo-element effect using a child element
            let progressFill = progressLineElement.querySelector('.progress-fill');
            if (!progressFill) {
                progressFill = document.createElement('div');
                progressFill.className = 'progress-fill';
                progressFill.style.cssText = `
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    background: linear-gradient(90deg, #F3E5D9, #c6e5d2);
                    border-radius: 3px;
                    width: 0%;
                    transition: width 0.8s ease;
                    z-index: 2;
                `;
                progressLineElement.appendChild(progressFill);
            }
            progressFill.style.width = progressPercentage + '%';
        }
    }

    function showStep(index) {
        steps.forEach((step, i) => {
            step.style.display = i === index ? "block" : "none";
        });
        updateStepBar(index);
        validateStep(index); // ✅ Enable/disable next button based on current step
        
        // Smooth scroll to top
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }

    function showLoading(show) {
        loadingOverlay.style.display = show ? "flex" : "none";
    }

    window.triggerAvatarUpload = function() {
        fileInput.click();
    };

    // Enhanced Skills Management
    function renderSelectedSkills() {
        const display = document.getElementById('displaySelectedSkills');
        display.innerHTML = '';
        Array.from(selectedSkills).forEach(skill => {
            const div = document.createElement('div');
            div.className = 'skill-tag';
            div.innerHTML = `${skill} <span class="remove-skill" onclick="removeSkill('${skill}')">×</span>`;
            display.appendChild(div);
        });
        
        // Update hidden input
        document.getElementById('selected_skills').value = Array.from(selectedSkills).join(',');
        
        // ✅ Update next button state
        if (currentStep === 1) {
            validateStep(1);
        }
        
        console.log('Skills updated. Total skills:', selectedSkills.size);
        console.log('Hidden field value:', document.getElementById('selected_skills').value);
    }

    window.removeSkill = function(skill) {
        selectedSkills.delete(skill);
        const gridButtons = document.querySelectorAll('#skillsGrid button');
        gridButtons.forEach(btn => {
            if (btn.textContent.trim() === skill) btn.classList.remove('selected');
        });
        renderSelectedSkills();
    };

    window.toggleSkill = function(btn) {
        const skill = btn.textContent.trim();
        if (selectedSkills.has(skill)) {
            selectedSkills.delete(skill);
            btn.classList.remove('selected');
        } else {
            selectedSkills.add(skill);
            btn.classList.add('selected');
        }
        renderSelectedSkills();
    };

    window.addSkill = function() {
        const input = document.getElementById('newSkillInput');
        const val = input.value.trim();
        if (val && !selectedSkills.has(val)) {
            selectedSkills.add(val);
            newSkills.push(val);

            const grid = document.getElementById('skillsGrid');
            const newBtn = document.createElement('button');
            newBtn.textContent = val;
            newBtn.className = 'skill-btn selected';
            newBtn.onclick = function() {
                toggleSkill(newBtn);
            };
            grid.appendChild(newBtn);
            input.value = '';
            renderSelectedSkills();
        }
    };

    window.openSkillsModal = function() {
        document.getElementById('skillsPopup').classList.add('active');
    };

    window.closeSkillsModal = function() {
        document.getElementById('skillsPopup').classList.remove('active');
    };

    window.saveSkills = function() {
        console.log('Saving skills. Current skills:', selectedSkills);
        
        closeSkillsModal();
        
        const selected = Array.from(selectedSkills).join(',');
        const newOnes = newSkills.join(',');
        
        document.getElementById('selected_skills').value = selected;
        document.getElementById('new_skills').value = newOnes;
        
        renderSelectedSkills();
        
        localStorage.setItem('form_selected_skills', selected);
        localStorage.setItem('form_new_skills', newOnes);
        
        console.log('Skills saved successfully:', selected);
    };

    window.clearAllSkills = function() {
        selectedSkills.clear();
        newSkills = [];
        const gridButtons = document.querySelectorAll('#skillsGrid button');
        gridButtons.forEach(btn => btn.classList.remove('selected'));
        renderSelectedSkills();
    };

    window.showCategory = function(category) {
        // Update active tab
        document.querySelectorAll('.category-tab').forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');
        
        // Show/hide skills based on category
        const skillButtons = document.querySelectorAll('.skill-btn');
        skillButtons.forEach(btn => {
            // For demo purposes, show all skills
            // In production, you'd filter based on actual categories
            btn.style.display = 'inline-block';
        });
    };

    // Skills Search Functionality
    document.getElementById('skillSearchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const skillButtons = document.querySelectorAll('.skill-btn');
        
        skillButtons.forEach(btn => {
            const skillName = btn.textContent.toLowerCase();
            btn.style.display = skillName.includes(searchTerm) ? 'inline-block' : 'none';
        });
    });

    // Enter key for adding new skills
    document.getElementById('newSkillInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSkill();
        }
    });

    // Enhanced Character Counters with Word Progress
    function setupWordProgressCounters() {
        const textareas = document.querySelectorAll('textarea[data-max]');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                updateWordProgress(this);
            });

            textarea.addEventListener('blur', function() {
                if (this.value.trim()) {
                    checkWordCount(this);
                }
            });

            textarea.addEventListener('focus', function() {
                clearFieldFeedback(this);
            });
        });
    }

    // Enhanced Harmony Experience
    window.toggleExperienceFields = function(checked) {
        const details = document.getElementById('experienceDetails');
        details.style.display = checked ? 'block' : 'none';
    };

    window.toggleProject = function(button) {
        button.classList.toggle('selected');
    };

    // Enhanced Review Step
    function createReviewRow(label, value, stepIndex) {
        if (!value || value === '—') return '';
        
        return `
            <div>
                <span>${label}</span>
                <div class="value-wrapper">
                    <span class="value-text">${value}</span>
                    <span class="edit-icon" onclick="goToStep(${stepIndex})">🖉</span>
                </div>
            </div>
        `;
    }

    function populateReviewStep() {
        const reviewBox = document.getElementById('reviewContent');
        const formData = new FormData(document.getElementById('multiStepForm'));
        const getVal = (name) => formData.get(name)?.trim() || '—';

        let html = `<div class="review-grid Tajawal text-end">`;

        // Profile Image
        if (currentImageFile) {
            const imgSrc = URL.createObjectURL(currentImageFile);
            html += `
                <span class="mx-auto image-review-wrapper position-relative">
                    <div class="avatar-container">
                        <img src="${imgSrc}" alt="Profile" class="review-avatar" style="object-position: ${profileImage.style.objectPosition || 'center center'};">
                    </div>
                    <span class="edit-avatar-icon" onclick="triggerAvatarUpload()">🖉</span>
                </span>
            `;
        }

        // Personal Information
        html += createReviewRow("الاسم الكامل", getVal('full_name'), 0);
        html += createReviewRow("تاريخ الميلاد", getVal('birth_date'), 0);
        html += createReviewRow("البريد الإلكتروني", getVal('email'), 0);
        html += createReviewRow("رقم الهاتف", getVal('phone'), 0);
        html += createReviewRow("بلد السكن الأصلي", getVal('origin_country'), 0);
        html += createReviewRow("بلد السكن الحالي", getVal('current_country'), 0);
        
        // Instagram with special handling
        if (noInstagram) {
            html += createReviewRow("إنستغرام", "لا يوجد حساب إنستغرام", 0);
        } else {
            html += createReviewRow("إنستغرام", getVal('instagram'), 0);
        }
        
        // LinkedIn with special handling
        if (noLinkedIn) {
            html += createReviewRow("لينكد إن", "لا يوجد حساب لينكد إن", 0);
        } else {
            html += createReviewRow("لينكد إن", getVal('linkedin'), 0);
        }

        // Professional Information
        html += createReviewRow("تعريفك المهني", getVal('job_title'), 1);
        html += createReviewRow("الشركة/الجامعة", getVal('university'), 1);
        html += createReviewRow("السيرة الأكاديمية", getVal('edu_resume').substring(0, 100) + (getVal('edu_resume').length > 100 ? '...' : ''), 1);
        html += createReviewRow("السيرة المهنية", getVal('pro_resume').substring(0, 100) + (getVal('pro_resume').length > 100 ? '...' : ''), 1);
        html += createReviewRow("السيرة الشخصية", getVal('personal_resume').substring(0, 100) + (getVal('personal_resume').length > 100 ? '...' : ''), 1);
        html += createReviewRow("مهارات مختارة", getVal('selected_skills'), 1);
        html += createReviewRow("مهارات جديدة", getVal('new_skills'), 1);

        // Harmony Experience
        const hasExperience = document.getElementById('experienceSwitch').checked;
        html += createReviewRow("هل لديك تجربة مع هارموني؟", hasExperience ? "نعم" : "لا", 2);

        if (hasExperience) {
            const selectedProjects = [];
            document.querySelectorAll('.project-btn.selected').forEach(btn => {
                selectedProjects.push(btn.textContent.trim());
            });
            html += createReviewRow("البرامج التي شاركت بها", selectedProjects.join(', '), 2);
            html += createReviewRow("رسالتك", getVal('harmony_experience'), 2);
        }

        html += `</div>`;
        reviewBox.innerHTML = html;
    }

    window.goToStep = function(index) {
        currentStep = index;
        showStep(currentStep);
    };

    // Enhanced Form Persistence
    function persistFormValues() {
        const inputs = document.querySelectorAll('#multiStepForm input:not([type="file"]), #multiStepForm textarea, #multiStepForm select');
        inputs.forEach(input => {
            const key = `form_${input.name}`;
            
            // Restore saved value
            const savedValue = localStorage.getItem(key);
            if (savedValue && input.type !== 'file') {
                input.value = savedValue;
                // Trigger validation for restored values
                if (savedValue.trim()) {
                    validateField(input);
                    // Update word progress for textareas
                    if (input.tagName === 'TEXTAREA') {
                        updateWordProgress(input);
                    }
                }
            }
            
            // Save on change
            input.addEventListener('input', () => {
                localStorage.setItem(key, input.value);
            });
        });

        // Restore checkbox states
        const experienceSwitch = document.getElementById('experienceSwitch');
        if (localStorage.getItem('form_experienceSwitch') === 'true') {
            experienceSwitch.checked = true;
            toggleExperienceFields(true);
        }
        experienceSwitch.addEventListener('change', () => {
            localStorage.setItem('form_experienceSwitch', experienceSwitch.checked);
        });

        // Restore selected projects
        const savedProjects = JSON.parse(localStorage.getItem('form_selected_projects') || '[]');
        if (savedProjects.length > 0) {
            const buttons = document.querySelectorAll('.project-btn');
            buttons.forEach(btn => {
                if (savedProjects.includes(btn.textContent.trim())) {
                    btn.classList.add('selected');
                }
            });
        }

        // Restore skills
        const savedSelectedSkills = localStorage.getItem('form_selected_skills');
        const savedNewSkills = localStorage.getItem('form_new_skills');

        if (savedSelectedSkills) {
            selectedSkills = new Set(savedSelectedSkills.split(',').filter(s => s));
        }
        if (savedNewSkills) {
            newSkills = savedNewSkills.split(',').filter(s => s);
        }

        if (savedSelectedSkills || savedNewSkills) {
            const gridButtons = document.querySelectorAll('#skillsGrid button');
            gridButtons.forEach(btn => {
                const skill = btn.textContent.trim();
                if (selectedSkills.has(skill)) {
                    btn.classList.add('selected');
                }
            });

            const grid = document.getElementById('skillsGrid');
            newSkills.forEach(skill => {
                if (![...selectedSkills].includes(skill)) return;
                const newBtn = document.createElement('button');
                newBtn.textContent = skill;
                newBtn.className = 'skill-btn selected';
                newBtn.onclick = function() {
                    toggleSkill(newBtn);
                };
                grid.appendChild(newBtn);
            });

            renderSelectedSkills();
        }
    }

    // Auto-save functionality
    function autoSave() {
        const formData = {
            timestamp: Date.now(),
            step: currentStep,
            data: {}
        };
        
        const inputs = document.querySelectorAll('#multiStepForm input:not([type="file"]), #multiStepForm textarea');
        inputs.forEach(input => {
            formData.data[input.name] = input.value;
        });
        
        localStorage.setItem('harmony_form_autosave', JSON.stringify(formData));
    }

    // Setup auto-save every 30 seconds
    setInterval(autoSave, 30000);

    // Enhanced Event Listeners
    function attachEnhancedValidationListeners() {
        steps.forEach((step, index) => {
            const inputs = step.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    validateStep(index); // ✅ Enable/disable next button
                    validateField(input); // ✅ Show field feedback
                });
                
                input.addEventListener('blur', () => {
                    validateField(input);
                });
            });
        });
    }

    // Enhanced Navigation
    startBtn.addEventListener("click", function(e) {
        e.preventDefault();
        showLoading(true);
        
        setTimeout(() => {
            startSection.style.display = "none";
            formSection.style.display = "block";
            showLoading(false);
            
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }, 300);
    });

    nextBtns.forEach(btn =>
        btn.addEventListener("click", () => {
            console.log('🔄 Next button clicked for step:', currentStep + 1);
            console.log('Selected skills before validation:', selectedSkills);
            console.log('Hidden field before validation:', document.getElementById('selected_skills').value);
            
            const validation = validateCurrentStep();
            
            if (!validation.isValid) {
                console.log('❌ Validation failed, showing alert with fields:', validation.missingFields);
                if (validation.missingFields.length > 0) {
                    showValidationAlert(validation.missingFields);
                } else {
                    console.log('No specific missing fields found, checking for general issues');
                    showValidationAlert(['يرجى التحقق من جميع الحقول والتأكد من ملئها بشكل صحيح']);
                }
                
                // Shake effect for invalid form
                btn.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    btn.style.animation = '';
                }, 500);
                return;
            }
            
            console.log('✅ Validation passed, proceeding to next step');
            
            // Save selected projects before moving from step 3
            if (currentStep === 2) {
                const selectedProjects = Array.from(document.querySelectorAll('.project-btn.selected')).map(btn => btn.textContent.trim());
                localStorage.setItem('form_selected_projects', JSON.stringify(selectedProjects));
                console.log('Projects saved:', selectedProjects);
            }

            // Visual feedback for successful validation
            btn.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
            btn.style.transform = 'scale(1.05)';
            
            setTimeout(() => {
                btn.style.background = '';
                btn.style.transform = '';
            }, 200);

            proceedToNextStep();
        })
    );

    prevBtns.forEach(btn =>
        btn.addEventListener("click", () => {
            if (currentStep > 0) {
                showLoading(true);
                setTimeout(() => {
                    currentStep--;
                    showStep(currentStep);
                    showLoading(false);
                }, 300);
            }
        })
    );

    // Enhanced Form Submission
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        
        console.log('Form submission attempted');
        
        const validation = validateCurrentStep();
        if (!validation.isValid) {
            console.log('Form validation failed on submission');
            if (validation.missingFields.length > 0) {
                showValidationAlert(validation.missingFields);
            } else {
                showValidationAlert(['يرجى التحقق من جميع الحقول والتأكد من ملئها بشكل صحيح']);
            }
            return;
        }
        
        console.log('Form validation passed, submitting...');
        
        showLoading(true);
        
        const formData = new FormData(form);
        formData.append('action', 'submit_team_form');

        // Add selected projects
        const selectedProjects = Array.from(document.querySelectorAll('.project-btn.selected')).map(btn => btn.textContent.trim());
        formData.append('projects', selectedProjects.join(','));

        // Add processed image if available
        if (currentImageFile) {
            formData.set('profile_image', currentImageFile);
        }

        // Add LinkedIn status
        formData.append('no_linkedin', noLinkedIn ? '1' : '0');
        
        // Add Instagram status
        formData.append('no_instagram', noInstagram ? '1' : '0');

        console.log('Form data being submitted:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ':', value);
        }

        fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                showLoading(false);
                
                if (data.success) {
                    // Clear all saved data
                    localStorage.clear();
                    
                    // Reset form
                    form.reset();
                    selectedSkills.clear();
                    newSkills = [];
                    currentImageFile = null;
                    noLinkedIn = false;
                    noInstagram = false;
                    
                    // Hide form and show success
                    document.getElementById("form_section").style.display = "none";
                    document.getElementById("success_message").style.display = "block";
                    
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                } else {
                    alert("❌ حدث خطأ أثناء الإرسال: " + (data.data || 'خطأ غير معروف'));
                    console.error(data);
                }
            })
            .catch(error => {
                showLoading(false);
                console.error('AJAX error:', error);
                alert("❌ تعذر الاتصال بالخادم. يرجى المحاولة مرة أخرى.");
            });
    });

    // Prevent Enter key from submitting form
    document.querySelectorAll('#multiStepForm input').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                // Focus next input or trigger next button
                const inputs = Array.from(document.querySelectorAll('#multiStepForm input:not([type="hidden"]), #multiStepForm textarea'));
                const currentIndex = inputs.indexOf(this);
                if (currentIndex < inputs.length - 1) {
                    inputs[currentIndex + 1].focus();
                }
            }
        });
    });

    // Initialize everything
    setupWordProgressCounters();
    persistFormValues();
    attachEnhancedValidationListeners();
    
    console.log("🚀 Enhanced form with FIXED navigation issues initialized successfully");
    console.log("✅ All issues addressed:");
    console.log("  - Fixed step navigation (Step 2 → Step 3)");
    console.log("  - Simplified validation alert (centered)");
    console.log("  - Improved progress bar design");
    console.log("  - Icon-only social media inputs");
    console.log("  - Enhanced debugging logs");
});
</script>

<?php get_footer(); ?>