<?php

/**
 * Template Name: Attendees
 **/
?>

<?php get_header(); ?>

<div class="pb-5 sectionPadding3 bg2">
    <div id="lottieLoader" class="lottie-loader-overlay" style="display:none;">
        <iframe src="https://cdn.lottielab.com/l/AUegnTHZGrJW9z.html" width="212" height="212" frameborder="0"></iframe>
    </div>

    <div class="container c12 py-md-5 py-4">

        <!-- Intro Section -->
        <div id="start_section">
            <h4 class="h1 text-center fs60 Tajawal fbold sc1"><?php echo get_field('main_title'); ?></h4>
            <div class="text-center my-4 sc1 Tajawal fs25">
                <?php echo get_field('main_paragraph'); ?>
            </div>
            <div>
                <a href="#" id="start_form" class="mylink2 mx-auto d-flex align-items-center fs25 Tajawal">
                    <?php echo 'إبدأ التسجيل'; ?>
                    <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                </a>
            </div>
            <div class="text-center mt-5 fs18 Tajawal sc1">
                <?php the_content(); ?>
            </div>
        </div>

        <!-- Multistep Form Section -->
        <div id="form_section" style="display: none;">
            <div class="step-bar text-center mb-4">
                <div class="d-flex justify-content-center gap-4 align-items-start" style="gap:25px;">
                    <div class="stepwrap d-flex flex-column align-items-center">
                        <div class="step-circle active"></div>
                        <span class="step-label mt-2 sc1">البيانات الشخصية</span>
                    </div>
                    <div class="stepwrap d-flex flex-column align-items-center">
                        <div class="step-circle"></div>
                        <span class="step-label mt-2 sc1">المهنية والأكاديمية</span>
                    </div>


                    <div class="stepwrap d-flex flex-column align-items-center">
                        <div class="step-circle"></div>
                        <span class="step-label mt-2 sc1">مراجعة وإرسال</span>
                    </div>
                </div>
            </div>

            <form id="multiStepForm2" novalidate class="Tajawal w-75 mx-auto mw100">
                <input type="hidden" name="attendees_nonce" value="<?php echo wp_create_nonce('attendees_form_nonce'); ?>">

                <div class="form-step" data-step="1">
                    <h2 class="text-center my-5 sc1">أدخل تفاصيلك الشخصية</h2>
                    <div class="text-center mb-5 ">
                        <div class="position-relative mx-auto" style="border-radius:50%;height:144px;width:144px;overflow:hidden;">
                            <img src="<?php echo get_template_directory_uri() . '/images/upload.png'; ?>" class="uploadImage" alt="">
                            <input type="file" name="profile_image" accept="image/*">
                        </div>
                        <label class="d-block my-2 sc1 fbold fs20">صورة شخصية للموقع *</label>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3"><input type="text" name="full_name" placeholder="الاسم الكامل *" required class="form-control"></div>
                        <div class="col-md-6 mb-3"><input type="text" name="job_title" placeholder="تعريفك المهني *" required class="form-control"></div>
                        <div class="col-md-6 mb-3"><input type="text" name="university" placeholder="الشركة/الجامعة" class="form-control"></div>
                        <div class="col-md-6 mb-3 position-relative">
                            <input type="date" name="birth_date" id="birthDateInput" value="1994-10-18" required class="form-control">
                            <span id="birthDatePlaceholder" class="date-placeholder">تاريخ ميلادك *</span>
                        </div>

                        <div class="col-md-6 mb-3"><input type="email" name="email" placeholder="البريد الإلكتروني *" required class="form-control"></div>
                        <div class="col-md-6 mb-3"><input type="text" name="phone" placeholder="رقم الهاتف *" required class="form-control"></div>
                        <div class="col-md-6 mb-3"><input type="text" name="origin_country" placeholder="بلد السكن الأصلي *" required class="form-control"></div>
                        <div class="col-md-6 mb-3"><input type="text" name="current_country" placeholder="بلد السكن الحالي" class="form-control"></div>
                    </div>
                    <!-- <h5 class=" mb-3 text-center sc1 fbold fs20">صفحات التواصل الإجتماعي</h5> -->
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <img class="d-block mb-2 mx-auto imgc" src="<?php echo get_template_directory_uri() . '/images/instagramframe.png'; ?>" alt="Instagram">
                            <input type="text" name="instagram" placeholder="* @Username" class="form-control form-control2">
                        </div>
                        <div class="col-md-6 mb-3">
                            <img class="d-block  mb-2 mx-auto imgc" src="<?php echo get_template_directory_uri() . '/images/linkedinframe.png'; ?>" alt="LinkedIn">
                            <input type="text" name="linkedin" placeholder="* https://www.linkedin.com" class="form-control form-control2">
                        </div>

                    </div>
                    <div class="text-center mt-5">
                        <div style="padding:5px 30px;" class="mylink2 disabled pointer mx-auto d-flex align-items-center fs20 Tajawal next-step">
                            <?php echo 'التالي'; ?>
                            <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                        </div>
                    </div>
                </div>

                <div class="form-step" data-step="2" style="display:none">
                    <h2 class="text-center  my-5 sc1">أدخل تفاصيلك المهنية</h2>
                    <div class="form-group mb-4 sc1">
                        <label class="sc1 fbold fs20">سيرتك الذاتية المهنية *
                            <span class="info-wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/images/info.png'; ?>" alt="Info">
                                <div class="custom-tooltip">
                                    مثال:<br><br>
                                    عملت في السابق بشركة @ في وظيفة/منصب @<br>
                                    اليوم أنا أعمل بشركة @ في وظيفة/منصب @<br>
                                    ساهمت بعملي @ بالاشتراك بتطوير مشروع @
                                </div>
                            </span>

                        </label>
                        <textarea name="pro_resume" placeholder="اكتب بتوسع على شكل نقاط عن كل ما يتعلق بخبراتك المهنية، ما هي وظيفتك في العمل، مع الاختصاصات المختلفة، اسماء الشركات التي عملت او تعمل بها، وأي انجاز مهني اخر خاص بك الذي ترغب في ذكره في الموقع" rows="6" required class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-4 sc1">
                        <label class="sc1 fbold fs20">سيرتك الذاتية الأكاديمية *
                            <span class="info-wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/images/info.png'; ?>" alt="Info">
                                <div class="custom-tooltip">
                                    مثال:<br><br>
                                    حاصل على لقب أول بموضوع @ من جامعة @<br>
                                    حاليًا أتعلم لقب ثاني في موضوع @ في جامعة @<br>
                                    نشرت مقال عن موضوع @<br>
                                    حصلت على منحة @ خلال فترة تعليمي<br>
                                    تعلمت كورس خارجي @ عبر منصّة أو المؤسسة الأكاديمية
                                </div>
                            </span> </label>
                        <textarea name="edu_resume" placeholder="اكتب بتوسع على شكل نقاط عن كل ما يتعلّق بالألقاب والدرجات الاكاديمية، الشهادات والاختصاصات المختلفة، ابحاث اكاديمية، جوائز ومنح، انشطة اكاديمية، وفي أي مؤسسات اكاديمية تمّت هذه الانجازات، وأي انجاز تعليمي آخر خاص بك الذي ترغب في ذكره في الموقع." rows="6" required class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-4 sc1">
                        <label class="sc1 fbold fs20">سيرتك الذاتية الشخصية *
                            <span class="info-wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/images/info.png'; ?>" alt="Info">
                                <div class="custom-tooltip">
                                    مثال:<br><br>
                                    تطوعت في السابق في جمعية @<br>
                                    في الوقت الحالي، أتطوع في @<br>
                                    أحب مشاهدة رياضة كرة القدم<br>
                                    أحب تسلق الجبال<br>
                                    أحب السباحة وتحديدًا نوع سباحة الظهر<br>
                                    أحب قراءة الكتب في مجالات ال@<br>
                                    أحب السفر والتعرف على ثقافات جديدة<br>
                                    هاوي في جمع @ من السفرات<br>
                                    أحب الاستماع لموسيقى من نوع @
                                </div>
                            </span> </label>
                        <textarea name="personal_resume" placeholder="اكتب على شكل نقاط عن سيرتك الذاتية الشخصية متضمناً؛ هواياتك, اهتماماتك, فعاليات لا منهجية تقوم بها, الانشطة التي تستمتع بها, كم لغة تتحدث ودرجة اتقانك لهم, الامور التي تثير فضولك..وأي معلومة تعبر عنك ترغب في ذكرها في الموقع" rows="6" required class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-4 sc1">
                        <label class="sc1 fbold fs20">*معلومة مثيرة للإهتمام عنك رح نستعملها عشان ال Name tag، شوف مثال تحت (حتى 6 كلمات). </label>
                        <textarea name="fun_fact" placeholder="اكتب معلومة غير معتادة أو مفاجئة عن نفسك" required rows="2" class="form-control"></textarea>

                        <img class="d-block imgc" style="max-height:250px;margin:20px auto;" src="<?php echo get_template_directory_uri() . '/images/example.jpeg'; ?>" alt="Example">
                    </div>

                    <div class="form-group text-center mb-4">
                        <label class="sc1 fbold fs20 d-block mb-3">هل بتحب متطوعي هارموني يشبكوك مع شخص معين خلال البرنامج</label>
                        <div class="toggle-switch-experience mx-auto">
                            <input type="checkbox" id="connectSwitch" onchange="toggleConnectField(this.checked)">
                            <label for="connectSwitch">
                                <span class="toggle-option yes">نعم</span>
                                <span class="toggle-option no">لا</span>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div id="connectTextareaWrapper" class="form-group mb-4 sc1" style="display:none;">
                        <label class="sc1 fbold fs20">مع مين بتحب نشبكك</label>
                        <textarea name="connect_with" placeholder="مثال: شريك تكنولوجي, تنفيذي, تجاري/ محامي في مجال معيّن/ محاسب من مجال معيّن، شخص سافر الى الصين، شخص عمل لقب في امريكا والخ... 
** في اخر برنامج الفنجان 5 - قدرنا (1) نعرف شخص يلي طلب من قبل يتعرف على شخص عم ببني الشركة الناشئة الخاصة فيو; (2) شخص يعمل في مجال ال-FoodTech - لهيك جدا مننصح انكو تستغلوا الفرصة وتسجلوا." rows="6" class="form-control"></textarea>
                    </div>



                    <div class="form-group">
                        <label class="sc1 d-block fbold fs20 text-center">اذكر مهاراتك</label>
                        <div class="form-group text-center">
                            <div class="skill-trigger-wrapper">
                                <input type="text" class="styled-trigger" placeholder="أضف مهارة" readonly value="أضف مهارة" onclick="document.getElementById('skillsPopup').classList.add('active')">
                                <span class="plus-icon" onclick="document.getElementById('skillsPopup').classList.add('active')">+</span>
                            </div>
                            <div id="displaySelectedSkills" class="skills-display mt-3 d-flex flex-wrap justify-content-center " style="gap:10px;"></div>

                        </div>

                        <!-- Skills Popup Modal -->
                        <div class="skills-popup" id="skillsPopup">
                            <div class="close-popup" onclick="document.getElementById('skillsPopup').classList.remove('active')">×</div>
                            <h4>أضف مهارات</h4>
                            <div class="d-flex align-items-center">
                                <input type="text" style="margin-bottom:0;" id="newSkillInput" placeholder="أضف مهارة أخرى">
                                <button type="button" onclick="addSkill()" style="height:40px;width:40px;background:none;border:none;font-size:24px;color:#004c3f;">+</button>
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
                                    echo '<button type="button" onclick="toggleSkill(this)">' . esc_html($skill->post_title) . '</button>';
                                }
                                ?>
                            </div>

                            <div class="popup-actions">
                                <button type="button" onclick="saveSkills()">✓ حفظ</button>
                            </div>
                        </div>

                        <input type="hidden" name="selected_skills" id="selected_skills">
                        <input type="hidden" name="new_skills" id="new_skills">

                    </div>


                    <div class="text-center mt-5 d-flex align-items-center justify-content-center" style="gap:10px;">
                        <div style="padding:5px 30px;" class="mylink3 pointer  d-flex align-items-center fs20 Tajawal prev-step">
                            <?php echo 'السابق'; ?>
                        </div>
                        <div style="padding:5px 30px;" class="mylink2 pointer  d-flex align-items-center fs20 Tajawal next-step">
                            <?php echo 'التالي'; ?>
                            <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">
                        </div>
                    </div>
                </div>


                <div class="form-step" data-step="3" style="display:none">
                    <h2 class="text-center my-5 sc1">مراجعة التفاصيل وإرسالها</h2>
                    <div id="reviewContent" class="p-4 rounded text-center">
                        <p>ستظهر تفاصيلك هنا للمراجعة قبل الإرسال.</p>
                    </div>
                    <div class="text-center mt-4">
                        <div class="text-center mt-5 d-flex align-items-center justify-content-center" style="gap:10px;">
                            <div style="padding:5px 30px;" class="mylink3 pointer  d-flex align-items-center fs20 Tajawal prev-step">
                                <?php echo 'السابق'; ?>
                            </div>
                            <button type="submit" class="mylink2 pointer  d-flex align-items-center fs20 Tajawal">حفظ وإرسال
                                <img src="<?php echo get_template_directory_uri() . '/images/Arrow-Right.png'; ?>" alt="Arrow">

                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div id="success_message" style="display:none;" class="text-center Tajawal">
            <img src="<?php echo get_field('succ_icon'); ?>" alt="Success Icon" style="width:90px;" class="mb-4">
            <h2 class="sc1 fbold fs40"><?php echo get_field('succ_t'); ?></h2>
            <p class="fs20 sc1 mb-4">
                <?php echo get_field('succ_p'); ?>
            </p>
            <div class="d-flex justify-content-center mt-4" style="gap:10px">
                <a href="/" class="mylink3 ">الصفحة الرئيسية</a>
                <a href="/الشبكة" class="mylink2 ">تصفح الشبكة 🧠</a>
            </div>
        </div>

    </div>
</div>
<!-- Include Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Form Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let profilePreviewUrl = '';

        const profileInput = document.querySelector('input[name="profile_image"]');
        profileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                profilePreviewUrl = URL.createObjectURL(this.files[0]);
                document.querySelector('.uploadImage').src = profilePreviewUrl;

                // Update review step avatar immediately if already rendered
                const reviewImg = document.querySelector('.review-avatar');
                if (reviewImg) reviewImg.src = profilePreviewUrl;

                profileInput.classList.remove('image-required');
            }
        });

        // ============================
        // Step Navigation
        // ============================
        const startBtn = document.getElementById("start_form");
        const startSection = document.getElementById("start_section");
        const formSection = document.getElementById("form_section");
        const steps = document.querySelectorAll(".form-step");
        const stepCircles = document.querySelectorAll(".step-bar .step-circle");
        const nextBtns = document.querySelectorAll(".next-step");
        const prevBtns = document.querySelectorAll(".prev-step");
        const form = document.getElementById("multiStepForm2");
        let currentStep = 0;

        function updateStepBar(index) {
            stepCircles.forEach((circle, i) => {
                circle.classList.toggle("active", i <= index);
            });
        }

        function showStep(index) {
            steps.forEach((step, i) => {
                step.style.display = i === index ? "block" : "none";
            });
            updateStepBar(index);
            validateStep(index); // ✅ check inputs when moving to this step
        }

        startBtn.addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("lottieLoader").style.display = "flex";

            setTimeout(() => {
                startSection.style.display = "none";
                formSection.style.display = "block";
                document.getElementById("lottieLoader").style.display = "none";

                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            }, 300);
        });

        nextBtns.forEach(btn =>
            btn.addEventListener("click", () => {
                if (currentStep === 2) {
                    const selectedProjects = Array.from(document.querySelectorAll('.project-btn.selected')).map(btn => btn.textContent.trim());
                    localStorage.setItem('form_selected_projects', JSON.stringify(selectedProjects));
                }

                if (currentStep < steps.length - 1) {
                    document.getElementById("lottieLoader").style.display = "flex";
                    setTimeout(() => {
                        currentStep++;
                        showStep(currentStep);
                        if (currentStep === 2) populateReviewStep();
                        document.getElementById("lottieLoader").style.display = "none";
                    }, 300);
                }
            })
        );

        prevBtns.forEach(btn =>
            btn.addEventListener("click", () => {
                if (currentStep > 0) {
                    document.getElementById("lottieLoader").style.display = "flex";
                    setTimeout(() => {
                        currentStep--;
                        showStep(currentStep);
                        document.getElementById("lottieLoader").style.display = "none";
                    }, 300);
                }
            })
        );



        // ============================
        // Skill Popup & Management
        // ============================
        let selectedSkills = new Set();
        let newSkills = [];

        window.toggleSkill = function(btn) {
            const skill = btn.textContent.trim();
            if (selectedSkills.has(skill)) {
                selectedSkills.delete(skill);
                btn.classList.remove('selected');
            } else {
                selectedSkills.add(skill);
                btn.classList.add('selected');
            }
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
                newBtn.classList.add('selected');
                newBtn.onclick = function() {
                    toggleSkill(newBtn);
                };
                grid.appendChild(newBtn);
                input.value = '';
            }
        };


        function setupSkillInputEnterListener() {
            const input = document.getElementById('newSkillInput');
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addSkill();
                }
            });
        }

        function renderSelectedSkills() {
            const display = document.getElementById('displaySelectedSkills');
            display.innerHTML = '';
            Array.from(selectedSkills).forEach(skill => {
                const div = document.createElement('div');
                div.className = 'skill-tag';
                div.innerHTML = `${skill} <span class="remove-skill" onclick="removeSkill('${skill}')">×</span>`;
                display.appendChild(div);
            });
        }

        window.removeSkill = function(skill) {
            selectedSkills.delete(skill);
            const gridButtons = document.querySelectorAll('#skillsGrid button');
            gridButtons.forEach(btn => {
                if (btn.textContent.trim() === skill) btn.classList.remove('selected');
            });
            renderSelectedSkills();
            document.getElementById('selected_skills').value = Array.from(selectedSkills).join(',');
        };

        window.saveSkills = function() {
            // Close popup
            document.getElementById('skillsPopup').classList.remove('active');

            // Prepare values
            const selected = Array.from(selectedSkills).join(',');
            const newOnes = newSkills.join(',');

            // Set hidden fields
            document.getElementById('selected_skills').value = selected;
            document.getElementById('new_skills').value = newOnes;

            // Render skills
            renderSelectedSkills();

            // ✅ Save to localStorage
            localStorage.setItem('form_selected_skills', selected);
            localStorage.setItem('form_new_skills', newOnes);
        };

        window.toggleConnectField = function(checked) {
            const connectWrapper = document.getElementById('connectTextareaWrapper');
            connectWrapper.style.display = checked ? 'block' : 'none';
        };


        // ============================
        // Harmony Experience Toggle
        // ============================
        window.toggleExperienceFields = function(checked) {
            const details = document.getElementById('experienceDetails');
            details.style.display = checked ? 'block' : 'none';
        };

        window.toggleProject = function(button) {
            button.classList.toggle('selected');
        };


        setupSkillInputEnterListener();

        function validateStep(stepIndex) {
            const step = steps[stepIndex];
            const requiredFields = step.querySelectorAll('[required]');
            let allValid = true;


            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allValid = false;
                }
            });
            if (stepIndex === 0 && profileInput.files.length === 0) {
                allValid = false;
                profileInput.classList.add('image-required');
            }

            const nextButton = step.querySelector('.next-step');
            if (nextButton) {
                nextButton.classList.toggle('disabled', !allValid);
                nextButton.style.pointerEvents = allValid ? 'auto' : 'none';
                nextButton.style.opacity = allValid ? '1' : '0.5';
            }
        }

        function attachValidationListeners() {
            steps.forEach((step, index) => {
                const inputs = step.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.addEventListener('input', () => {
                        validateStep(index);
                    });
                });
            });
        }
        persistFormValues();

        attachValidationListeners();


        function createReviewRow(label, value, stepIndex) {
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
            const formData = new FormData(document.getElementById('multiStepForm2'));
            const getVal = (name) => formData.get(name)?.trim() || '—';

            let html = `<div class="review-grid Tajawal text-end">`;

            if (profilePreviewUrl) {
                html += `
        <span class="mx-auto image-review-wrapper position-relative">
            <div class="avatar-container">
                <img src="${profilePreviewUrl}" alt="Profile" class="review-avatar">
            
            </div>
                <span class="edit-avatar-icon" onclick="triggerAvatarUpload(0)">
                   🖉
                </span>
        </span>
    `;
            }




            // 🔹 Basic Fields (Step 1)
            html += createReviewRow("الاسم الكامل", getVal('full_name'), 0);
            html += createReviewRow("تاريخ الميلاد", getVal('birth_date'), 0);
            html += createReviewRow("البريد الإلكتروني", getVal('email'), 0);
            html += createReviewRow("رقم الهاتف", getVal('phone'), 0);
            html += createReviewRow("بلد السكن الأصلي", getVal('origin_country'), 0);
            html += createReviewRow("بلد السكن الحالي", getVal('current_country'), 0);
            html += createReviewRow("انستجرام", getVal('instagram'), 0);
            html += createReviewRow("لينكدإن", getVal('linkedin'), 0);

            // 🔹 Professional / Academic Fields (Step 2)
            html += createReviewRow("تعريفك المهني", getVal('job_title'), 1);
            html += createReviewRow("الشركة/الجامعة", getVal('university'), 1);
            html += createReviewRow("السيرة المهنية", getVal('pro_resume'), 1);
            html += createReviewRow("السيرة الأكاديمية", getVal('edu_resume'), 1);
            html += createReviewRow("السيرة الشخصية", getVal('personal_resume'), 1);
            html += createReviewRow("مهارات مختارة", getVal('selected_skills'), 1);
            html += createReviewRow("مهارات جديدة", getVal('new_skills'), 1);
            html += createReviewRow("معلومة مثيرة عنك", getVal('fun_fact'), 1);
            html += createReviewRow("مع مين بتحب نشبكك", getVal('connect_with'), 1);

            // // 🔹 Harmony Experience (Step 3)
            // const hasExperience = document.getElementById('experienceSwitch').checked;
            // html += createReviewRow("هل لديك تجربة مع هارموني؟", hasExperience ? "نعم" : "لا", 2);

            // if (hasExperience) {
            //     // Get selected projects
            //     const selectedProjects = [];
            //     document.querySelectorAll('.project-btn.selected').forEach(btn => {
            //         selectedProjects.push(btn.textContent.trim());
            //     });
            //     html += createReviewRow("البرامج التي شاركت بها", selectedProjects.join(', '), 2);
            //     html += createReviewRow("رسالتك", getVal('message'), 2);
            // }

            html += `</div>`;
            reviewBox.innerHTML = html;
        }
        window.goToStep = function(index) {
            currentStep = index;
            showStep(currentStep);
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        };

        function persistFormValues() {
            const inputs = document.querySelectorAll('#multiStepForm2 input, #multiStepForm2 textarea, #multiStepForm2 select');
            inputs.forEach(input => {
                const key = `form_${input.name}`;

                // ❌ SKIP FILE INPUTS
                if (input.type === 'file') return;

                input.value = localStorage.getItem(key) || '';
                input.addEventListener('input', () => {
                    localStorage.setItem(key, input.value);
                });
            });



            // Restore selected Harmony projects
            const savedProjects = JSON.parse(localStorage.getItem('form_selected_projects') || '[]');
            if (savedProjects.length > 0) {
                const buttons = document.querySelectorAll('.project-btn');
                buttons.forEach(btn => {
                    if (savedProjects.includes(btn.textContent.trim())) {
                        btn.classList.add('selected');
                    }
                });
            }

            // === Restore Skills ===
            const savedSelectedSkills = localStorage.getItem('form_selected_skills');
            const savedNewSkills = localStorage.getItem('form_new_skills');

            if (savedSelectedSkills) {
                selectedSkills = new Set(savedSelectedSkills.split(','));
            }
            if (savedNewSkills) {
                newSkills = savedNewSkills.split(',');
            }

            // Rebuild UI after restoring sets
            if (savedSelectedSkills || savedNewSkills) {
                // Mark skill buttons as selected
                const gridButtons = document.querySelectorAll('#skillsGrid button');
                gridButtons.forEach(btn => {
                    const skill = btn.textContent.trim();
                    if (selectedSkills.has(skill)) {
                        btn.classList.add('selected');
                    }
                });

                // Add any new skill buttons
                const grid = document.getElementById('skillsGrid');
                newSkills.forEach(skill => {
                    if (![...selectedSkills].includes(skill)) return;
                    const newBtn = document.createElement('button');
                    newBtn.textContent = skill;
                    newBtn.classList.add('selected');
                    newBtn.onclick = function() {
                        toggleSkill(newBtn);
                    };
                    grid.appendChild(newBtn);
                });

                renderSelectedSkills();
            }

        }

        // persistFormValues();
        window.triggerAvatarUpload = function() {
            const fileInput = document.querySelector('input[name="profile_image"]');
            if (fileInput) fileInput.click();
        };


    });

    document.getElementById("multiStepForm2").addEventListener("submit", function(e) {
        e.preventDefault();
        document.getElementById("lottieLoader").style.display = "flex"; // 👈 Show loader

        const form = e.target;
        const formData = new FormData(form);
        formData.append('action', 'submit_attendees_form');

        const selectedProjects = Array.from(document.querySelectorAll('.project-btn.selected')).map(btn => btn.textContent.trim());
        formData.append('projects', selectedProjects.join(','));

        document.querySelectorAll('.form-step').forEach(step => {
            if (step.style.display === 'none') {
                step.querySelectorAll('input, textarea, select').forEach(el => el.disabled = true);
            }
        });

        fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById("lottieLoader").style.display = "none"; // 👈 Hide loader

                if (data.success) {
                    localStorage.clear();
                    form.reset();

                    // Hide form + steps + bar
                    document.getElementById("form_section").style.display = "none";

                    // Show success message
                    document.getElementById("success_message").style.display = "block";

                    // Scroll to message
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                } else {
                    alert("❌ حدث خطأ أثناء الإرسال");
                    console.error(data);
                }
            })
            .catch(error => {
                document.getElementById("lottieLoader").style.display = "none"; // 👈 Hide loader

                console.error('AJAX error:', error);
                alert("❌ تعذر الاتصال بالخادم.");
            });
    });

    document.querySelectorAll('#multiStepForm2 input').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    });
</script>

<style>
    .info-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .custom-tooltip {
        display: none;
        position: absolute;
        top: 120%;
        right: 0;
        background-color: #333;
        color: #fff;
        padding: 12px;
        border-radius: 8px;
        width: 320px;
        font-size: 14px;
        line-height: 1.6;
        z-index: 10;
        direction: rtl;
        text-align: right;
        white-space: normal;
    }

    .info-wrapper:hover .custom-tooltip {
        display: block;
    }


    .date-placeholder {
        position: absolute;
        top: 5px;
        right: 65px;
        color: #efddce;
        pointer-events: none;
        transition: 0.2s;
        z-index: 1000;
    }



    .step-bar .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #F3E5D9;
        background-color: #0f5132;
        line-height: 30px;
        text-align: center;
        position: relative;
    }

    .stepwrap {
        min-width: 120px;
        position: relative;
    }

    .stepwrap::before {
        position: absolute;
        top: 15px;
        width: 120%;
        left: -80px;
        height: 3px;
        background-color: #F3E5D9;
        content: "";
        z-index: 0;
    }

    .step-label {
        max-width: 80px;
    }

    .stepwrap:last-of-type::before {
        display: none;
    }

    .step-bar .step-circle.active {

        font-weight: bold;
        background-color: #F3E5D9;
    }

    .step-bar .step-line {
        width: 30px;
        height: 2px;
        background: #ccc;
    }

    input.form-control,
    textarea.form-control {
        background-color: transparent;
        color: #F3E5D9;
        border: 0;
        border-radius: 0;
        font-size: 16px;
        margin-bottom: 10px;

        border-bottom: 2px solid #F3E5D9;
    }

    textarea.form-control {
        border-radius: 15px;
        background-color: #1E7154;
        color: #F3E5D9;
    }

    input.form-control2 {
        border: 2px solid #F3E5D9;
        border-radius: 14px;
    }

    input.form-control:focus,
    textarea.form-control:focus {
        background-color: transparent;
        box-shadow: none;
        color: #F3E5D9;
        border-color: rgba(243, 229, 217, 0.51);
        border: 1px solid !important;
        outline: 0;
        border-radius: 14px;
    }

    input.form-control::placeholder,
    textarea.form-control::placeholder {
        color: #F3E5D9;
        opacity: 0.4;
    }

    @media (min-width: 575px) and (max-width: 1100px) {

        input.form-control::placeholder,
        textarea.form-control::placeholder {
            font-size: 14px;
        }
    }

    input[type="file"] {
        opacity: 0;
        height: 100%;
        cursor: pointer;
    }

    .uploadImage {
        position: absolute;
        left: 0;
        right: 0;
        /* margin: 0 auto; */
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        margin: 0;
        width: 100%;
        height: 100%;

    }

    /* Skill Popup Styling */
    .skills-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #F3E5D9;
        color: #004c3f;
        border-radius: 20px;
        padding: 30px;
        width: 90%;
        max-width: 680px;
        z-index: 9999;
        display: none;
    }

    .skills-popup.active {
        display: block;
    }

    .skills-popup h4 {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .skills-popup input[type="text"] {
        width: 100%;
        border: 2px solid #004c3f;
        border-radius: 15px;
        padding: 8px 12px;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .skills-popup .skills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 20px 0;
        justify-content: center;
    }

    .skills-popup .skills-grid button {
        border: 2px solid #004c3f;
        background: transparent;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 14px;
        cursor: pointer;
    }

    .skills-popup .skills-grid button.selected {
        background-color: #004c3f;
        color: #fff;
    }

    .skills-popup .popup-actions {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .skills-popup .popup-actions button {
        background-color: #004c3f;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 16px;
        cursor: pointer;
    }

    .skills-popup .close-popup {
        position: absolute;
        top: 10px;
        left: 15px;
        font-size: 20px;
        cursor: pointer;
    }

    .skill-trigger-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #c6e5d2;
        border-radius: 12px;
        padding: 6px 10px;
        max-width: 400px;
        margin: 0 auto;
    }

    .styled-trigger {
        border: none;
        background: transparent;
        font-size: 16px;
        color: #004c3f;
        flex: 1;
        padding: 6px;
        cursor: pointer;
        text-align: right;
    }

    .plus-icon {
        font-size: 20px;
        color: #004c3f;
        font-weight: bold;
        cursor: pointer;
        padding: 0 10px;
    }

    .styled-trigger:focus {
        outline: none;
    }

    .skills-display .skill-tag {
        border: 2px solid #004c3f;
        background-color: #f3e5d9;
        border-radius: 15px;
        padding: 5px 10px;
        font-size: 14px;
        color: #004c3f;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .skills-display .skill-tag .remove-skill {
        font-weight: bold;
        font-size: 16px;
        color: #004c3f;
        cursor: pointer;
    }

    .toggle-switch-experience {
        position: relative;
        display: inline-block;
        width: 50%;
        height: 40px;
        background-color: #0f5132;
        border-radius: 20px;
        direction: rtl;
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
        font-weight: 400;
        z-index: 2;
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
        width: 50%;
        background-color: #c6e5d2;
        border-radius: 20px;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .toggle-switch-experience input:checked+label .toggle-slider {
        right: auto;
        left: 3px;
    }

    .toggle-switch-experience input:checked+label .yes {
        color: #0f5132;
    }

    .toggle-switch-experience input:not(:checked)+label .no {
        color: #0f5132;
    }

    .project-btn.selected {
        background-color: #F3E5D9 !important;
        color: #016d47 !important;
        border-color: #F3E5D9 !important;
    }

    .next-step.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    .review-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;


        color: #fff;
        font-size: 18px;
        text-align: right;
    }

    .review-grid>div {
        padding: 10px;
        margin-bottom: 5px;
        background-color: rgba(0, 0, 0, 0.10);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .value-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: ltr;
    }

    .value-text {
        direction: rtl;
        text-align: left;
    }

    .edit-icon {
        color: #fff;
        font-size: 20px;
        cursor: pointer;
    }

    .image-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #004c3f;
        padding: 15px;
        border-radius: 20px;
        margin-bottom: 10px;
        color: #fff;
    }



    .image-required {
        outline: 2px solid red;
        border-radius: 10px;
    }

    .image-review-wrapper {
        display: flex;
        justify-content: center;

        width: 120px;
        height: 120px;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    .avatar-container {
        position: relative;
        display: inline-block;
        border-radius: 50%;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .review-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;


    }

    .edit-avatar-icon {
        position: absolute;
        bottom: -15px;
        right: 0;
        border: 1px solid #ffffff;
        border-radius: 50%;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        cursor: pointer;

    }

    .edit-avatar-icon img {
        width: 16px;
        height: 16px;
    }

    .lottie-loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 99999;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.65);
        display: flex;
        align-items: center;
        justify-content: center;
    }


    @media (max-width: 575px) {
        .custom-tooltip {
            right: -40vw;
        }

        .stepwrap {
            min-width: auto;
        }

        .stepwrap::before {
            left: -55px
        }

        .skills-popup .skills-grid {
            max-height: 65vh;
            overflow: scroll;
        }

        .skills-popup {
            width: 100%;
            height: 100%;
            border-radius: 0;
        }
    }
</style>



<?php get_footer(); ?>